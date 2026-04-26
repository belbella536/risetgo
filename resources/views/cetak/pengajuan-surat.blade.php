<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; margin: 2cm; }
        .header { text-align: center; border-bottom: 2px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .content { line-height: 1.5; }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>KOP SURAT FAKULTAS</h2>
        <p>Alamat Lengkap Institusi</p>
    </div>

    <div class="content">
        <p>Nomor: {{ $pengajuan->no_surat->nomor ?? '-' }}</p>
        <p>Hal: Permohonan Izin Penelitian</p>
        
        <p>Kepada Yth.<br>
        Kepala {{ $pengajuan->instansi_tujuan }}</p>

        <p>Dengan hormat, kami sampaikan bahwa mahasiswa di bawah ini akan melaksanakan penelitian dari tanggal {{ $pengajuan->tanggal_mulai }} sampai dengan {{ $pengajuan->tanggal_selesai }}.</p>
        
        </div>
</body>
</html>