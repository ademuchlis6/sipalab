<?php defined('BASEPATH') or exit('No direct script access allowed');

class Param extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function paramList()
    {
        $this->load->model('m_param', 'param');
        $list = $this->param->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $list_param) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_param->nama_param;
            $row[] = $list_param->tipe_param;
            $row[] = 'Rp. ' . number_format($list_param->harga, 0, ",", ".");
            $user = $this->ion_auth->user()->row()->wilayah;
            if($user=='ADMIN'){
                $row[] = '
                <a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="editParam(' . "'" . $list_param->id_param . "'" . ')"><i class="fa fa-edit"></i></a>
                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteParam(' . "'" . $list_param->id_param . "'" . ')"><i class="fa fa-trash-o"></i></a>			
                ';
            }
            else{
                $row[]='';
            }
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->param->count_all(),
            "recordsFiltered" => $this->param->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function addParam()
    {
        $this->load->model('m_param', 'param');

        $data = array(
            'nama_param' => $this->input->post('namaParameter'),
            'tipe_param' => $this->input->post('tipeParameter'),
            'harga' => $this->input->post('harga'),
        );

        $insert = $this->param->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function deleteParam($idParam)
    {
        //delete file
        $this->load->model('m_param', 'param');

        $this->param->delete_by_id($idParam);
        echo json_encode(array("status" => TRUE));
    }

    public function editParam($idParam)
    {
        $this->load->model('m_param', 'param');
        $data = $this->param->get_by_id($idParam);
        echo json_encode($data);
    }

    public function updateParam()
    {
        $this->load->model('m_param', 'param');

        $data = array(
            'nama_param' => $this->input->post('namaParameter'),
            'tipe_param' => $this->input->post('tipeParameter'),
            'harga' => $this->input->post('harga'),
        );

        $this->param->update(array('id_param' => $this->input->post('id_param')), $data);
        echo json_encode(array("status" => TRUE));
    }
}
