<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$this->load->view('cetak');
	}
	function do_cetak()
	{
		$nomor_order = $_GET['nomor_order'];
		$tahun_order = $_GET['tahun_order'];



		$this->load->library('pdf');
		$options = $this->pdf->getOptions();
		$options->set(array('isRemoteEnabled' => true));
		$this->pdf->setOptions($options);

		$this->pdf->setPaper('A4', 'potrait');
		//$customPaper = array(0, 0, 360, 360);
		//$this->pdf->set_paper($customPaper);
		$this->pdf->filename = "laporan.pdf";
		$this->pdf->load_view('cetakPdf');
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
}
