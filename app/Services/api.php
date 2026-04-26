<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Api
{
    protected $secretKey;
    protected $baseUrl;

    public function __construct()
    {
        // Mengambil secret key dari env
        $this->secretKey = env('SIDOBE_API_KEY');
        $this->baseUrl = 'https://api.sidobe.com/wa/v1/';
    }

    /**
     * Handle pengiriman dokumen sesuai format cURL Sidobe
     * * @param string $phone Nomor tujuan (e.g. +628xxx)
     * @param string $message Pesan teks
     * @param string $fileUrl URL dokumen publik
     * @param string $fileName Nama file saat diterima (e.g. Surat_Izin.pdf)
     */
    public function sendDocument($phone, $message, $fileUrl, $fileName)
    {
        try {
            $endpoint = $this->baseUrl . 'send-message-doc';

            $response = Http::withHeaders([
                'X-Secret-Key' => $this->secretKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->post($endpoint, [
                'phone'         => $phone,
                'message'       => $message,
                'document_url'  => $fileUrl,
                'document_name' => $fileName,
            ]);
            
            return $response->successful();


        } catch (\Exception $e) {
            Log::error('Sidobe Service Error: ' . $e->getMessage());
            return false;
        }
    }
}