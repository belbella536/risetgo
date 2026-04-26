<?php

namespace App\Services;

use App\Models\PengajuanSurat;
use App\Models\NoSurat;
use App\Models\DocumentSignature;
use App\Models\PimpinanSetting;
use App\Models\User;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SaveDocument
{
    /**
     * Generate PDF untuk Pengajuan Surat.
     *
     * @param int $id
     * @return array
     */
    public function generatePdf($id)
    {
        // 1. Ambil data pengajuan dan format surat yang aktif
        $pengajuan = PengajuanSurat::with(['no_surat', 'mahasiswa', 'fakultas', 'prodi', 'user'])->findOrFail($id);
        $formatSuratAktif = NoSurat::where('is_active', true)->first();

        // 2. Inisiasi FPDI
        $pdf = new Fpdi();
        $f4_size = [215.9, 330.2]; // Ukuran F4
        $pdf->AddPage('P', $f4_size);
        
        // 3. Setup Template PDF
        $pathTemplate = storage_path('app/public/template-izin-penelitian.pdf');

        if (!File::exists($pathTemplate)) {
            throw new \Exception('File template PDF tidak ditemukan.');
        }

        $pdf->setSourceFile($pathTemplate);
        $tplId = $pdf->importPage(1);
        $pdf->useTemplate($tplId, 0, 0, 215.9);
        
        // 4. Konfigurasi Font
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(0, 0, 0);
        
        // 5. Isi Data Mahasiswa & Surat
        $this->fillStudentData($pdf, $pengajuan, $formatSuratAktif);

        // 6. Area Tanda Tangan Elektronik (TTE)
        $this->applySignature($pdf, $pengajuan);
        
        // 7. Siapkan Output
        $namaFile = 'Surat_Izin_Penelitian_' . $pengajuan->id . '.pdf';
        $content = $pdf->Output('S', $namaFile);

        return [
            'content' => $content,
            'filename' => $namaFile
        ];
    }

    private function fillStudentData($pdf, $pengajuan, $formatSuratAktif)
    {
        // Nomor Surat
        $pdf->SetXY(45.5, 47); 
        $nomorUrut = $pengajuan->nomor_surat ?? '-'; 
        $kodeFormat = $formatSuratAktif ? $formatSuratAktif->nomor : 'KODE/BELUM/DISET';
        $pdf->Write(0, $nomorUrut . '/' . $kodeFormat);

        // Tanggal Pengajuan
        $pdf->SetXY(175, 47);
        $pdf->Write(0, $pengajuan->updated_at->format('d F Y'));

        // Instansi Tujuan
        $pdf->SetXY(45.5, 72);
        $pdf->Write(0, $pengajuan->instansi_tujuan);
        
        // Nama Mahasiswa
        $pdf->SetXY(77, 117);
        $namaMahasiswa = $pengajuan->user ? strtoupper($pengajuan->user->name) : 'NAMA BELUM DIISI'; 
        $pdf->Write(0, $namaMahasiswa);
        
        // NIM
        $pdf->SetXY(77, 121.7);
        $nimMahasiswa = $pengajuan->user ? $pengajuan->user->username : 'NIM BELUM DIISI';
        $pdf->Write(0, $nimMahasiswa);

        // Fakultas
        $pdf->SetXY(77, 126.5);
        $fakultasMahasiswa = $pengajuan->fakultas ? $pengajuan->fakultas->nama_fakultas : 'FAKULTAS BELUM DIISI';
        $pdf->Write(0, $fakultasMahasiswa);

        // Prodi
        $pdf->SetXY(77, 132);
        $prodiMahasiswa = $pengajuan->prodi ? $pengajuan->prodi->nama_prodi : 'PRODI BELUM DIISI';
        $pdf->Write(0, $prodiMahasiswa);
        
        // Judul Skripsi (MultiCell)
        $judul = $pengajuan->judul_skripsi ? strtoupper($pengajuan->judul_skripsi) : 'JUDUL PENELITIAN BELUM DIISI';
        $judulBersih = trim(preg_replace('/\s+/', ' ', $judul));
        $pdf->SetXY(77, 134.6);
        $pdf->MultiCell(123, 4.5, $judulBersih, 0, 'J');

        // Rentang Tanggal
        $tanggalMulai = Carbon::parse($pengajuan->tanggal_mulai)->locale('id')->translatedFormat('d F Y');
        $tanggalSelesai = Carbon::parse($pengajuan->tanggal_selesai)->locale('id')->translatedFormat('d F Y');
        $pdf->SetFont('Arial', 'B', 11); 
        $pdf->SetXY(100, 171.5);
        $pdf->Write(0, $tanggalMulai . ' s/d ' . $tanggalSelesai . '.');
    }

    private function applySignature($pdf, $pengajuan)
    {
        $tte = DocumentSignature::where('pengajuan_surat_id', $pengajuan->id)->first();

        if ($tte) {
            $pimpinanUser = User::find($tte->user_id);
            $pimpinanSetting = PimpinanSetting::where('user_id', $tte->user_id)->first();

            $namaPimpinan = $pimpinanUser ? $pimpinanUser->name : 'NAMA PIMPINAN';
            $nipMentah = $pimpinanSetting ? $pimpinanSetting->nip : '0';
            $nipPimpinan = number_format((float)$nipMentah, 0, '', '');

            $urlVerifikasi = url('/verifikasi-surat/' . $tte->verification_code);
            $qrPath = storage_path('app/public/qr_' . $tte->verification_code . '.png');
            
            // Ambil gambar QR (Saran: Sebaiknya gunakan library QR lokal seperti simplesoftwareio/simple-qrcode)
            $apiUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($urlVerifikasi);
            File::put($qrPath, file_get_contents($apiUrl));

            // Tempel QR Code
            $pdf->Image($qrPath, 125, 210, 22, 22);

            // Nama Pimpinan
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetXY(124, 235); 
            $pdf->Write(0, $namaPimpinan);

            // NIP
            $pdf->SetFont('Arial', '', 11);
            $pdf->SetXY(124, 240); 
            $pdf->Write(0, 'NIP. ' . $nipPimpinan);

            // Hapus QR temporary
            if (File::exists($qrPath)) {
                File::delete($qrPath);
            }
        }
    }

    public function saveToStorage($id)
    {
        // Gunakan logika yang sudah ada untuk generate content
        $pdfData = $this->generatePdf($id);
        
        // Tentukan folder dan nama file
        // Contoh: surat_selesai/Surat_Izin_Penelitian_123_168234.pdf
        $fileName = 'surat_selesai/Surat_Izin_' . $id . '_' . time() . '.pdf';
        
        // Simpan ke disk 'public' agar bisa diakses jika diperlukan
        Storage::disk('public')->put($fileName, $pdfData['content']);
        
        return $fileName;
    }
}