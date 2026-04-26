<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Services\SaveDocument;
use Illuminate\Http\Request;

class CetakSuratController extends Controller
{
    protected $documentService;

    public function __construct(SaveDocument $documentService)
    {
        $this->documentService = $documentService;
    }

    public function cetak($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        // Pengecekan hak akses tetap di Controller
        if (auth()->user()->role === 'mahasiswa' && $pengajuan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        try {
            $pdfData = $this->documentService->generatePdf($id);

            return response($pdfData['content'], 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $pdfData['filename'] . '"'
            ]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}