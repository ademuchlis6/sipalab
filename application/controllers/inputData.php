<?php defined('BASEPATH') or exit('No direct script access allowed');

class inputData extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->appdb = $this->load->database('default', true);
		$tahunq =  date("Y");
        $maxNomorOrder = $this->appdb->query("
            select max(nomor_order) nomor_max from tbl_order where tahun_order = $tahunq
			;");
        $maxno = $maxNomorOrder->row()->nomor_max;
        $nowno = $maxno + 1;

        $maxNomorSample = $this->appdb->query("
            select max(nomor_sample) nomor_maxSample from tbl_sample where tahun_sample = $tahunq
			;");
        $maxnoSample = $maxNomorSample->row()->nomor_maxSample;
        $nownoSample = $maxnoSample + 1;


        $param = $this->appdb->query("
        select * from tbl_param
        ;");
        $paramData = $param->result_array();

        $data = array(
            'maxno' => $maxno,
            'nowno' => $nowno,
            'maxnoSample' => $maxnoSample,
            'nownoSample' => $nownoSample,
            'paramData' => $paramData
        );

        $this->load->view('viewInputData', $data);
    }

    public function sample_list()
    {
        $nomor_order =  $_GET['nomor_order'];
        $tahun_order =  $_GET['tahun_order'];

        $this->load->model('m_sample', 'sample');
        $list = $this->sample->get_datatables($nomor_order, $tahun_order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $list_sample) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_sample->nomor_order;
            $row[] = $list_sample->tahun_order;
            $row[] = $list_sample->nomor_sample;
            $row[] = $list_sample->tahun_sample;
            $row[] = $list_sample->param;
            $row[] = 'Rp. ' . number_format($list_sample->harga_total, 0, ",", ".");
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sample->count_all($nomor_order, $tahun_order),
            "recordsFiltered" => $this->sample->count_filtered($nomor_order, $tahun_order),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function getNomorSample()
    {
        $this->appdb = $this->load->database('default', true);

		$tahunq =  date("Y");
        $maxNomorSample = $this->appdb->query("
            select max(nomor_sample) nomor_maxSample from tbl_sample where tahun_sample = $tahunq
			;");
        $maxnoSample = $maxNomorSample->row()->nomor_maxSample;
        $nownoSample = $maxnoSample + 1;

        echo json_encode(array("maxnoSample" => $maxnoSample, "nownoSample" => $nownoSample));
    }

    function saveData()
    {
        $this->load->model('m_order', 'order');

        $nama_pemohon = $this->input->post('nama_pemohon');
        $nama_perusahaan = $this->input->post('nama_perusahaan');
        $alamat_perusahaan  = $this->input->post('alamat_perusahaan');
        $telp_perusahaan  = $this->input->post('telp_perusahaan');
        $fax_perusahaan  = $this->input->post('fax_perusahaan');

        $tgl_ambil_sample = $this->input->post('tgl_ambil_sample');
        $transportasi = $this->input->post('transportasi');
        $pengawetan = $this->input->post('pengawetan');
        $paramlap = $this->input->post('paramlap');
        $nomor_order = $this->input->post('nomor_order');
        $tahun_order = $this->input->post('tahun_order');    
        $catatanKwi = $this->input->post('catatanKwi');
        $bml = $this->input->post('bml');
        $tgl_kwi = $this->input->post('tgl_kwi');

        $this->order->save_pengajuan(
            $nama_pemohon,
            $nama_perusahaan,
            $alamat_perusahaan,
            $telp_perusahaan,
            $fax_perusahaan,

            $tgl_ambil_sample,
            $transportasi,
            $pengawetan,
            $paramlap,
            $nomor_order,
            $tahun_order,
            $catatanKwi,
            $bml,
            $tgl_kwi

        );
        echo json_encode(array("status" => TRUE));
    }

    public function sampleAdd()
    {
        $this->load->model('m_sample', 'sample');


        $kodeUji = $this->input->post('kodeUji');
        $unit = $this->input->post('unit');
        $jumlah = $this->input->post('jumlah');
        $nomor_order =  $this->input->post('nomor_order');
        $tahun_order = $this->input->post('tahun_order');
        $nomor_sample =  $this->input->post('nomor_sample');
        $tahun_sample = $this->input->post('tahun_sample');

        $param = $this->input->post('check');

        //        var_dump($jumlah);

        $insert = $this->sample->saveSample($kodeUji, $unit, $jumlah, $nomor_order, $tahun_order);

        $insertSampleParam = $this->sample->saveSampleParam($param,  $nomor_sample, $tahun_sample, $nomor_order, $tahun_order);

        echo json_encode(array("status" => TRUE));
    }


    function editData()
    {
        $nomor_order = $_GET['nomor_order'];
        $tahun_order = $_GET['tahun_order'];
        $this->appdb = $this->load->database('default', true);
        $order = $this->appdb->query("
            select * from tbl_order where nomor_order = '$nomor_order' and tahun_order = '$tahun_order'
			;");
        $dataOrder = $order->result_array();

        $catatan = $this->appdb->query("
        select * from tbl_catatan where nomor_order = '$nomor_order' and tahun_order = '$tahun_order'
        ;");
        $dataCatatan = $catatan->result_array();


        $sample = $this->appdb->query("
        select * from tbl_sample where nomor_order = '$nomor_order' and tahun_order = '$tahun_order'
        ;");
        $dataSample = $sample->result_array();

        $sampleParam = $this->appdb->query("
        select * from tbl_sample_param where nomor_order = '$nomor_order' and tahun_order = '$tahun_order'
        ;");
        $dataSampleParam = $sampleParam->result_array();


        $param = $this->appdb->query("
        select * from tbl_param
        ;");
        $paramData = $param->result_array();

        $data = array(
            'dataOrder' => $dataOrder,
            'dataCatatan' => $dataCatatan,
            'dataSample' => $dataSample,
            'dataSampleParam' => $dataSampleParam,
            'paramData' => $paramData
        );

        $this->load->view('viewEditData', $data);
    }

    function saveDataEdit()
    {
        $this->load->model('m_order', 'order');

        $nama_pemohon = $this->input->post('nama_pemohon');
        $nama_perusahaan = $this->input->post('nama_perusahaan');
        $alamat_perusahaan  = $this->input->post('alamat_perusahaan');
        $telp_perusahaan  = $this->input->post('telp_perusahaan');
        $fax_perusahaan  = $this->input->post('fax_perusahaan');

        $tgl_ambil_sample = $this->input->post('tgl_ambil_sample');
        $transportasi = $this->input->post('transportasi');
        $pengawetan = $this->input->post('pengawetan');
        $paramlap = $this->input->post('paramlap');
        $nomor_order = $this->input->post('nomor_order');
        $tahun_order = $this->input->post('tahun_order');
        $catatanKwi = $this->input->post('catatanKwi');
        $bml = $this->input->post('bml');
        $tgl_kwi = $this->input->post('tgl_kwi');

        $this->order->edit_pengajuan(
            $nama_pemohon,
            $nama_perusahaan,
            $alamat_perusahaan,
            $telp_perusahaan,
            $fax_perusahaan,

            $tgl_ambil_sample,
            $transportasi,
            $pengawetan,
            $paramlap,
            $nomor_order,
            $tahun_order,
            $catatanKwi,
            $bml,
            $tgl_kwi
        );
        echo json_encode(array("status" => TRUE));
    }

    function getNomorSampleEdit()
    {
        $this->appdb = $this->load->database('default', true);

        $maxNomorSample = $this->appdb->query("
            select max(nomor_sample) nomor_maxSample from tbl_sample
			;");
        $maxnoSample = $maxNomorSample->row()->nomor_maxSample;
        $nownoSample = $maxnoSample + 1;

        echo json_encode(array("maxnoSample" => $maxnoSample, "nownoSample" => $nownoSample));
    }
    public function sample_listEdit()
    {
        $nomor_order =  $_GET['nomor_order'];
        $tahun_order =  $_GET['tahun_order'];

        $this->load->model('m_sample', 'sample');
        $list = $this->sample->get_datatables($nomor_order, $tahun_order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $list_sample) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_sample->nomor_order;
            $row[] = $list_sample->tahun_order;
            $row[] = $list_sample->nomor_sample;
            $row[] = $list_sample->tahun_sample;
            $row[] = $list_sample->param;
            $row[] = 'Rp. ' . number_format($list_sample->harga_total, 0, ",", ".");
            
            $user = $this->ion_auth->user()->row()->wilayah;
			if($user=='ADMIN'){
                $row[] = '
                <a class="btn btn-sm btn-warning" href="javascript:void(0)" title="edit" onclick="editSample('
                    . "'" . $list_sample->nomor_order . "'" . ','
                    . "'" . $list_sample->tahun_order . "'" . ','
                    . "'" . $list_sample->nomor_sample . "'" . ','
                    . "'" . $list_sample->tahun_sample . "'" .
                    ')">
                <i class="fa fa-edit"></i></a>			
                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteSample('
                    . "'" . $list_sample->nomor_order . "'" . ','
                    . "'" . $list_sample->tahun_order . "'" . ','
                    . "'" . $list_sample->nomor_sample . "'" . ','
                    . "'" . $list_sample->tahun_sample . "'" .
                    ')">
                <i class="fa fa-trash-o"></i></a>			
                ';
            }
            else{
            $row[] = '';
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sample->count_all($nomor_order, $tahun_order),
            "recordsFiltered" => $this->sample->count_filtered($nomor_order, $tahun_order),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function sampleEditModal()
    {
        $nomor_order =  $_GET['nomor_order'];
        $tahun_order =  $_GET['tahun_order'];
        $nomor_sample =  $_GET['nomor_sample'];
        $tahun_sample =  $_GET['tahun_sample'];

        $this->appdb = $this->load->database('default', true);

        $sample = $this->appdb->query("
            select * from tbl_sample where
            nomor_order = '$nomor_order'
            and tahun_order = '$tahun_order'
            and nomor_sample = '$nomor_sample'
            and tahun_sample = '$tahun_sample'
        ;");
        $dataSample = $sample->result_array();

        $sampleParam = $this->appdb->query("
            select id_parameter from tbl_sample_param where
            nomor_order = '$nomor_order'
            and tahun_order = '$tahun_order'
            and nomor_sample = '$nomor_sample'
            and tahun_sample = '$tahun_sample'
        ;");
        $dataSampleParam = $sampleParam->result_array();

        $listDataSampleParamArray = array();
        foreach ($dataSampleParam as $listDataSampleParam) {
            array_push($listDataSampleParamArray, $listDataSampleParam['id_parameter']);
        }

        //var_dump($listDataSampleParamArray);

        $data = array(
            'sample' => $dataSample,
            'dataSampleParam' => $listDataSampleParamArray
        );
        echo json_encode($data);
    }

    function sampleEdit()
    {
        $this->appdb = $this->load->database('default', true);

        $kodeUji = $this->input->post('kodeUji');
        $unit = $this->input->post('unit');
        $jumlah = $this->input->post('jumlah');
        $nomor_order =  $this->input->post('nomor_order');
        $tahun_order = $this->input->post('tahun_order');
        $nomor_sample =  $this->input->post('nomor_sample');
        $tahun_sample = $this->input->post('tahun_sample');

        $updateSample = $this->appdb->query("
        update tbl_sample
        set kode_uji = '$kodeUji'
        , unit = '$unit'
        , jumlah = '$jumlah'
        where nomor_order = '$nomor_order'
        and tahun_order = '$tahun_order'
        and nomor_sample = '$nomor_sample'
        and tahun_sample = '$tahun_sample'
        ;");

        $param = $this->input->post('check');

        $updateSample = $this->appdb->query("
        delete from tbl_sample_param
        where nomor_order = '$nomor_order'
        and tahun_order = '$tahun_order'
        and nomor_sample = '$nomor_sample'
        and tahun_sample = '$tahun_sample'
        ;");

        $this->load->model('m_sample', 'sample');

        $insertSampleParam = $this->sample->saveSampleParam($param,  $nomor_sample, $tahun_sample, $nomor_order, $tahun_order);

        echo json_encode(array("status" => TRUE));
    }

    public function deleteSample()
    {
        //delete file
        $nomor_order = $_GET['nomor_order'];
        $tahun_order = $_GET['tahun_order'];
        $nomor_sample = $_GET['nomor_sample'];
        $tahun_sample = $_GET['tahun_sample'];

        $this->load->model('m_sample', 'sample');
        $this->sample->delete_by_id($nomor_order, $tahun_order, $nomor_sample, $tahun_sample);
        echo json_encode(array("status" => TRUE));
    }
}
