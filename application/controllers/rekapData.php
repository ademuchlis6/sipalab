<?php defined('BASEPATH') or exit('No direct script access allowed');

class RekapData extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->view('viewRekap');
    }

    public function listDataYearRekap()
    {
        $tahun_order =  $_GET['tahun_order'];
        $this->load->model('m_rekap', 'rekap');
        $list = $this->rekap->get_datatables($tahun_order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $list_rekap) {
            $no++;
            $row = array();
            //            $row[] = $no;
            $row[] = $list_rekap->nomor_order;
            $row[] = $list_rekap->tahun_order;
            $row[] = $list_rekap->nomor_sample;
            $row[] = $list_rekap->tahun_sample;
            $row[] = $list_rekap->nama_perusahaan;
            $row[] = $list_rekap->nama_pemohon;
            $row[] = $list_rekap->telp_perusahaan;
            $row[] = $list_rekap->kode_uji;
            $row[] = $list_rekap->unit;
            $row[] = $list_rekap->jumlah;
            $row[] = $list_rekap->param;
            $row[] = $list_rekap->harga_total;
            $row[] = $list_rekap->created_date;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rekap->count_all($tahun_order),
            "recordsFiltered" => $this->rekap->count_filtered($tahun_order),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
