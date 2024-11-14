<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Search_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function search($keyword){
    $this->db->like('id_buku', $keyword);
    $this->db->or_like('buku_id', $keyword);
    $this->db->or_like('id_kategori', $keyword);
    $this->db->or_like('id_rak', $keyword);
    $this->db->or_like('sampul', $keyword);
    $this->db->or_like('isbn', $keyword);
    $this->db->or_like('lampiran', $keyword);
    $this->db->or_like('title', $keyword);
    $this->db->or_like('penerbit', $keyword);
    $this->db->or_like('pengarang', $keyword);
    $this->db->or_like('thn_buku', $keyword);
    $this->db->or_like('isi', $keyword);
    $this->db->or_like('jml', $keyword);
    $this->db->or_like('tgl_masuk', $keyword);
    return $this->db->get('tbl_buku');
  }
}