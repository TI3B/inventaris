<?php
class Barang extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
        $this->load->model('model_app');
        $this->load->helper('currency_format_helper');
    }

    function index(){
        $data=array(
            'title'=>'Barang Kamar',
            'active_barang'=>'active',
            'kd_barang'=>$this->model_app->getKodeBarang(),
            'kd_pelanggan'=>$this->model_app->getKodePelanggan(),
            'kd_pegawai'=>$this->model_app->getKodePegawai(),
            'data_barang'=>$this->model_app->getAllData('tbl_barang'),
            'data_pelanggan'=>$this->model_app->getAllData('tbl_pelanggan'),
            'data_contact'=>$this->model_app->getAllData('tbl_contact'),
            'data_pegawai'=>$this->model_app->getAllData('tbl_pegawai'),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_barang');
        $this->load->view('element/v_footer');
    }

//
//    ===================== INSERT =====================
    function tambah_barang(){
        $data=array(
            'kd_barang'=>$this->input->post('kd_barang'),
            'nm_barang'=>$this->input->post('nm_barang'),
            'stok'=>$this->input->post('stok'),
            'harga'=>$this->input->post('harga'),
        );
        $this->model_app->insertData('tbl_barang',$data);
        redirect("barang");
    }
    
//    ======================== EDIT =======================
    function edit_barang(){
        $id['kd_barang'] = $this->input->post('kd_barang');
        $data=array(
            'nm_barang'=>$this->input->post('nm_barang'),
            'stok'=>$this->input->post('stok'),
            'harga'=>$this->input->post('harga'),
        );
        $this->model_app->updateData('tbl_barang',$data,$id);
        redirect("barang");
    }
   

//    ========================== DELETE =======================
    function hapus_barang(){
        $id['kd_barang'] = $this->uri->segment(3);
        $this->model_app->deleteData('tbl_barang',$id);
        redirect("barang");
    }
    
}


