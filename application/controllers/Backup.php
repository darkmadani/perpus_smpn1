<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

    // Konstruktor untuk validasi login dan loading helper serta model yang diperlukan
    function __construct(){
        parent::__construct();
        // Validasi jika user belum login
        $this->data['CI'] =& get_instance();
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_Admin');
		$this->load->library('google_drive'); // pastikan library google_drive sudah terinstal

        // Cek apakah user sudah login
        if($this->session->userdata('masuk_perpus') != TRUE){
            $url = base_url('login');
            redirect($url); // Redirect ke halaman login jika belum login
        }
    }

    /**
     * Menampilkan halaman backup
     */
    public function index() {  
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Backup Database MySQL';

        // Menampilkan halaman backup dengan pesan yang mungkin ada
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('backup_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }

    /**
     * Menangani proses backup database
     */
	public function manual_backup() {
		// Cek jika tombol backup ditekan
		if ($this->input->post('backup') == 'true') {
			// Kredensial database
			$host = 'localhost';
			$username = 'root'; // Ganti dengan username MySQL Anda
			$password = '';     // Ganti dengan password MySQL Anda
			$dbname = 'projek_perpus'; // Ganti dengan nama database Anda
	
			// Nama file backup, formatnya: backup_nama_database_YYYYMMDD_HHMMSS.sql
			$backupFile = 'backup_' . $dbname . '_' . date('H-i_d-m-Y') . '.sql';
			$backupPath = FCPATH . "backup/$backupFile";
	
			// Path lengkap ke mysqldump
			$mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump.exe'; // Ubah sesuai dengan lokasi mysqldump Anda
	
			// Perintah untuk mysqldump
			$command = "$mysqldumpPath --opt --host=$host --user=$username --password=$password $dbname > $backupPath";
	
			// Menjalankan perintah shell untuk melakukan backup
			$output = null;
			$resultCode = null;
			exec($command, $output, $resultCode);
	
			// Log untuk debug
			log_message('error', 'Backup command result: ' . $resultCode);
			log_message('error', 'Backup command output: ' . implode("\n", $output));
	
			// Menyiapkan pesan untuk feedback ke pengguna
			if ($resultCode === 0) {
				$message = "Backup berhasil! File disimpan di root folder perpus_smpn1/backup $backupFile";
			} else {
				$message = "Terjadi kesalahan saat melakukan backup. Error code: $resultCode";
				// Menambahkan detail kesalahan dari exec
				$message .= "<br>Output: " . implode("\n", $output);
			}
	
			// Menampilkan pesan dan halaman backup setelah proses selesai
			$this->data['idbo'] = $this->session->userdata('ses_id');
			$this->data['message'] = $message;
			$this->data['title_web'] = 'Backup Database MySQL';
			$this->load->view('header_view', $this->data);
			$this->load->view('sidebar_view', $this->data);
			$this->load->view('backup_view', $this->data);
			$this->load->view('footer_view', $this->data);
		}
	}

    public function google_backup() {
        // Tentukan nama file backup
        $host = 'localhost';
        $username = 'root'; // Ganti dengan username MySQL Anda
        $password = '';     // Ganti dengan password MySQL Anda
        $dbname = 'projek_perpus'; // Ganti dengan nama database Anda

        // Nama file backup berdasarkan tanggal saat ini
        $backup_file = 'backup_' . date('d-m-Y') . '.sql';
        $backup_path = FCPATH . 'backup/' . $backup_file; // Simpan di folder 'backup' di root proyek

        // Tentukan path untuk mysqldump (lokasi aplikasi MySQL)
        $mysqldumpPath = 'C:\\xampp\\mysql\\bin\\mysqldump.exe'; // Ubah sesuai dengan lokasi mysqldump Anda

        // Menjalankan mysqldump untuk backup database
        $command = "$mysqldumpPath --opt --host=$host --user=$username --password=$password $dbname > $backup_path";
        $output = shell_exec($command);

        if ($output === null) {
            // Backup berhasil, kirim ke Google Drive
            if ($this->send_to_google_drive($backup_path)) {
                // Hapus file backup setelah berhasil dikirim ke Google Drive
                if (file_exists($backup_path)) {
                    unlink($backup_path); // Hapus file backup
                }
                $this->session->set_flashdata('message', 'Backup berhasil dilakukan dan dikirim ke Google Drive!');
            } else {
                $this->session->set_flashdata('message', 'Gagal mengirim file backup ke Google Drive.');
            }
        } else {
            $this->session->set_flashdata('message', 'Backup database gagal.');
        }

        // Menampilkan pesan dan halaman backup setelah proses selesai
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['title_web'] = 'Backup Database MySQL';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('backup_view', $this->data); // Pastikan backup_view memuat $backup_file
        $this->load->view('footer_view', $this->data);
    }

    // Fungsi untuk mengirim file backup ke Google Drive
    public function send_to_google_drive($backup_path) {
        // Pastikan library Google Drive sudah terinstal dan terkonfigurasi dengan benar
        return $this->google_drive->upload_file($backup_path);
    }
}
		
?>
