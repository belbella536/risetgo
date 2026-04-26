<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antigravity Agent - Sistem Izin Penelitian FTIK UIN Sunan Kudus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Latar belakang gradasi hijau muda yang sangat halus */
            background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 100%);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-slate-800 selection:bg-emerald-200">

    <nav class="w-full px-6 py-4 md:px-12 flex items-center justify-between bg-white/70 backdrop-blur-md fixed top-0 z-50 border-b border-emerald-100">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white">
                <img src="{{ asset('images/logo/uin.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="font-bold text-lg text-emerald-900 leading-tight">Riset Go</h1>
                <p class="text-xs text-emerald-600 font-medium">FTIK UIN Sunan Kudus</p>
            </div>
        </div>
        <div class="hidden md:flex items-center gap-4">
            <a href="#" class="text-slate-600 hover:text-emerald-600 font-medium transition-colors">Masuk</a>
            <a href="#" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-full font-medium transition-all shadow-md shadow-emerald-200">Daftar Akun</a>
        </div>
    </nav>

    <main class="flex-1 container mx-auto px-6 md:px-12 pt-32 pb-16 flex flex-col lg:flex-row items-center justify-center gap-16">
        
        <div class="lg:w-1/2 space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm font-semibold">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-500 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Sistem Terintegrasi
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 leading-tight">
                Kemudahan Pengajuan <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-400">Izin Penelitian</span>
            </h2>
            <p class="text-lg text-slate-600 leading-relaxed max-w-lg">
                Digitalisasi layanan administrasi yang memudahkan mahasiswa dalam memproses surat izin penelitian secara efektif, cepat, dan tervalidasi.
            </p>
            
            <div class="flex flex-wrap items-center gap-4 pt-4">
                <a href="#" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3.5 rounded-full font-medium transition-all shadow-lg shadow-emerald-200 flex items-center gap-2">
                    Mulai Pengajuan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="#" class="md:hidden bg-white text-emerald-600 border border-emerald-200 hover:border-emerald-500 px-8 py-3.5 rounded-full font-medium transition-all">
                    Masuk
                </a>
            </div>
        </div>

        <div class="lg:w-5/12 w-full max-w-md">
            <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-emerald-100/50 border border-emerald-50">
                <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Verifikasi Dokumen</h3>
                <p class="text-slate-500 text-sm mb-8">Unggah file PDF surat izin untuk mengecek keaslian dokumen melalui pemindaian barcode.</p>

                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    
                    <div class="relative group">
                        <label for="pdf-upload" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-emerald-200 rounded-2xl bg-emerald-50/50 cursor-pointer group-hover:bg-emerald-50 group-hover:border-emerald-400 transition-all">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-emerald-400 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p class="mb-1 text-sm text-slate-600"><span class="font-semibold text-emerald-600">Klik untuk unggah</span> atau seret file ke sini</p>
                                <p class="text-xs text-slate-400">PDF (Maks. 2MB)</p>
                            </div>
                            <input id="pdf-upload" name="document_pdf" type="file" class="hidden" accept="application/pdf" required />
                        </label>
                    </div>

                    <div id="file-indicator" class="hidden flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-200">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                            <span id="file-name" class="text-sm font-medium text-slate-700 truncate">namafile.pdf</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white py-3.5 rounded-xl font-semibold transition-all flex items-center justify-center gap-2">
                        Pindai Barcode
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer class="py-6 text-center text-sm text-slate-500">
        <p>&copy; {{ date('Y') }} FTIK UIN Sunan Kudus. Semua hak cipta dilindungi.</p>
    </footer>

    <script>
        document.getElementById('pdf-upload').addEventListener('change', function(e) {
            const fileIndicator = document.getElementById('file-indicator');
            const fileNameDisplay = document.getElementById('file-name');
            
            if (e.target.files.length > 0) {
                fileNameDisplay.textContent = e.target.files[0].name;
                fileIndicator.classList.remove('hidden');
            } else {
                fileIndicator.classList.add('hidden');
            }
        });
    </script>
</body>
</html>