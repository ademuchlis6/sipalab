<?php defined('BASEPATH') or exit('No direct script access allowed');

class ListData extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$this->load->view('v_listData');
	}

	function showModal()
	{

		// $hasil = 'sdasd';
		$this->load->view('cetakModal');
	}
	function showModalKwi()
	{

		// $hasil = 'sdasd';
		$this->load->view('cetakModalKwi');
	}

	public function listDataYear()
	{
		$tahun_order =  $_GET['tahun_order'];
		$this->load->model('m_order', 'order');
		$list = $this->order->get_datatables($tahun_order);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $list_sample) {
			$no++;
			$row = array();
			//			$row[] = $no;
			$row[] = $list_sample->nomor_order;
			$row[] = $list_sample->tahun_order;
			$row[] = $list_sample->nama_perusahaan;
			$row[] = $list_sample->telp_perusahaan;
			$row[] = '<input type="checkbox" id="nomor_order" class="custom-control-input data-check" value ="' . "" . $list_sample->nomor_order . "" . '">';
			$row[] = '
			<a title="Detail/Edit" href=' . "'" . site_url('inputData/editData?nomor_order=') . $list_sample->nomor_order . "&tahun_order=" . $list_sample->tahun_order . "'" . ' onclick="" class="btn btn-sm btn-primary edit-record ajaxify"><i class="fa fa-search"></i></a>
			';

			$user = $this->ion_auth->user()->row()->wilayah;
			if($user=='ADMIN'){
				$row[] = '
				<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteOrder(' . "'" . $list_sample->nomor_order . "'" . ',' . "'" . $list_sample->tahun_order . "'" . ')"><i class="fa fa-trash-o"></i></a>			
				';
			}else{
				$row[]='';
			}
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->order->count_all($tahun_order),
			"recordsFiltered" => $this->order->count_filtered($tahun_order),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function deleteOrder()
	{
		//delete file
		$nomor_order = $_GET['nomor_order'];
		$tahun_order = $_GET['tahun_order'];
		$this->load->model('m_order', 'order');
		$this->order->delete_by_id($nomor_order, $tahun_order);
		echo json_encode(array("status" => TRUE));
	}
}
