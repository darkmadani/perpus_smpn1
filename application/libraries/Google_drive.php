<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Mengimpor kelas dari Google API
require_once FCPATH . 'vendor/autoload.php';  // Pastikan Anda sudah menginstal Google API via composer

class Google_drive {

    private $client;
    private $service;

    public function __construct() {
        // Membuat instance Google Client
        $this->client = new Google_Client();
        $this->client->setClientId('YOUR_GOOGLE_CLIENT_ID');
        $this->client->setClientSecret('YOUR_GOOGLE_CLIENT_SECRET');
        $this->client->setRedirectUri('YOUR_REDIRECT_URI');
        $this->client->addScope(Google_Service_Drive::DRIVE_FILE);

        // Setup token jika sudah ada
        $this->client->setAccessToken('YOUR_ACCESS_TOKEN');  // Token yang sudah didapatkan setelah OAuth

        // Membuat instance Google Drive service
        $this->service = new Google_Service_Drive($this->client);
    }

    public function upload_file($file_path) {
        try {
            // Set metadata untuk file
            $file = new Google_Service_Drive_DriveFile();
            $file->setName(basename($file_path));
            $file->setMimeType('application/sql');  // Pastikan ini sesuai dengan jenis file

            // Membaca konten file untuk di-upload
            $data = file_get_contents($file_path);
            $created_file = $this->service->files->create($file, [
                'data' => $data,
                'mimeType' => 'application/sql',
                'uploadType' => 'multipart'
            ]);

            return $created_file ? true : false;
        } catch (Exception $e) {
            log_message('error', 'Google Drive upload failed: ' . $e->getMessage());
            return false;
        }
    }
}
