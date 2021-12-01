<?php

/**
 * Author Imam Teguh
 */
class Profile extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('Apps');
		//	$this->load->model('lahir_model');
		// if($this->session->userdata('userid')=="") {
		// 	$alert = get_alert('Warning', 'Maaf anda harus login lebih dahulu', 'danger');
		// 	$this->session->set_flashdata('pesan', $alert);
		// 	redirect('welcome');
		// }
	}


	function profileInfo()
	{
		$this->load->view('profile/profileInfo');
	}

	public function settingprofile()
	{

		if (!$this->ion_auth->logged_in()) {
			//redirect them to the login page
			redirect('auth/login');
		} else {
			$this->appdb = $this->load->database('default', true);
			$configTglIso = $this->appdb->query("
			select * from tbl_config where id =1
			;");
			$configDataTglIso = $configTglIso->row()->value_config;

			$configFormIso = $this->appdb->query("
			select * from tbl_config where id =2
			;");
			$configDataFormIso = $configFormIso->row()->value_config;

			$configTerbitan = $this->appdb->query("
			select * from tbl_config where id =3
			;");
			$configDataTerbitan = $configTerbitan->row()->value_config;

			$configBml = $this->appdb->query("
			select * from tbl_config where id =4
			;");
			$configDataBml = $configBml->row()->value_config;

			$data = array(
				'configDataTglIso' => $configDataTglIso,
				'configDataFormIso' => $configDataFormIso,
				'configDataTerbitan' => $configDataTerbitan,
				'configDataBml' => $configDataBml,
				'username' => $this->ion_auth->user()->row()->username,
				'company' => $this->ion_auth->user()->row()->company,
				'wilayah' => $this->ion_auth->user()->row()->wilayah,
			);
			$this->load->view('profile/settingprofile', $data);
		}
	}



	public function changepass()
	{
		$user_id = $this->ion_auth->user()->row()->id;
		$passbaru1 = $this->input->post('passbaru1');
		$passbaru2 = $this->input->post('passbaru2');
		if ($passbaru1 == $passbaru2) {
			$data['password'] = $passbaru1;
			$this->ion_auth->update($user_id, $data);
			$stat = array('status' => 'ok');
			echo json_encode($stat);
		}
	}

	public function saveConfig()
	{

		$tglIso = $this->input->post('tglIso');
		$formIso = $this->input->post('formIso');
		$terbitan = $this->input->post('terbitan');
		$bml = $this->input->post('bml');

		$this->appdb = $this->load->database('default', true);
		$configTglIso = $this->appdb->query("
			update tbl_config set value_config='$tglIso' where id =1
			;");
		$configFormIso = $this->appdb->query("
			update tbl_config set value_config='$formIso' where id =2
			;");

		$configTerbitan = $this->appdb->query("
			update tbl_config set value_config='$terbitan' where id =3
			;");

		$configBml = $this->appdb->query("
			update tbl_config set value_config='$bml' where id =4
			;");
		$stat = array('status' => 'ok');
		echo json_encode($stat);
	}
}
