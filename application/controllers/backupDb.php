<?php defined('BASEPATH') or exit('No direct script access allowed');

class BackupDb extends CI_Controller
{
	public function index()
	{
		$this->load->dbutil();
		date_default_timezone_set('Asia/Jakarta');

		$config = array(
			'format'	=> 'zip',
			'filename'	=> 'database.sql'
		);

		$backup = &$this->dbutil->backup($config);

		$namaDatabase = 'backup-on_' . date("Y-m-d_H_i_s") . '.zip';

		$save = './backup/' . $namaDatabase;

		$this->load->helper('file');

		if (!write_file($save, $backup)) {
			//			echo 'Unable to write the file';
			echo json_encode(array("status" => 'notOk'));
		} else {
			//			echo 'File written!';
			echo json_encode(array("status" => 'ok'));
		}
		//		$this->load->helper('download');
		//		force_download($namaDatabase, $backup);
	}

	function downloadDb()
	{
		$this->load->dbutil();
		date_default_timezone_set('Asia/Jakarta');

		$config = array(
			'format'	=> 'zip',
			'filename'	=> 'database.sql'
		);

		$backup = &$this->dbutil->backup($config);

		$namaDatabase = 'backup-on_' . date("Y-m-d_H_i_s") . '.zip';

		$save = './backup/' . $namaDatabase;

		$this->load->helper('file');

		if (!write_file($save, $backup)) {
			echo 'Unable to write the file';
		} else {
			echo 'File written!';
		}
		$this->load->helper('download');
		force_download($namaDatabase, $backup);
	}
}
