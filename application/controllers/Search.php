<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
      public function __construct() {
          parent::__construct();
          $this->load->helper('url');
          $this->load->model('Search_model');

}
      public function index() {
        $keyword= $this->input->post('keyword');

        $data['title_web'] = 'Data Buku';
        $data['buku'] = $this->Search_model->search($keyword);

      if (!empty($data['buku']) && $data['buku']->num_rows() > 0) {
         redirect('data');

      } else {
          $data['message'] = 'Tidak ada buku yang ditemukan untuk kata kunci tersebut.';
          $this->load->view('buku/buku_view', $data);
      }
    }
}