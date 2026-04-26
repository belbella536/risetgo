<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Keaslian Surat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 text-center border-t-8 border-green-500">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
            <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Dokumen Valid</h2>
        <p class="text-gray-600 text-sm mb-6">Surat Izin Penelitian ini adalah dokumen resmi yang sah dan terdaftar di sistem FTIK UIN Sunan Kudus.</p>

        <div class="text-left bg-gray-50 rounded-lg p-4 mb-6 space-y-3 text-sm">
            <div>
                <span class="block text-gray-500 text-xs font-semibold">Tanda Tangan Elektronik Oleh:</span>
                <span class="block text-gray-800 font-bold">{{ $signature->user->name }}</span>
            </div>
            <div>
                <span class="block text-gray-500 text-xs font-semibold">Waktu Pengesahan:</span>
                <span class="block text-gray-800 font-medium">{{ \Carbon\Carbon::parse($signature->signed_at)->locale('id')->translatedFormat('l, d F Y - H:i') }} WIB</span>
            </div>
            <hr class="border-gray-200">
            <div>
                <span class="block text-gray-500 text-xs font-semibold">Perihal Surat:</span>
                <span class="block text-gray-800 font-medium">Izin Penelitian Mahasiswa</span>
            </div>
            <div>
                <span class="block text-gray-500 text-xs font-semibold">ID Verifikasi:</span>
                <span class="block text-gray-400 text-xs break-all">{{ $signature->verification_code }}</span>
            </div>
        </div>

        <p class="text-xs text-gray-400">
            Sistem Layanan Administrasi Digital<br>
            Antigravity Agent - UIN Sunan Kudus
        </p>
    </div>

</body>
</html>