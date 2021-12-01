<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_order extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'tbl_order';
    var $column_order = array(null, 'created_date', 'nama_perusahaan'); //set column field database for datatable orderable 
    var $column_search = array('nama_perusahaan', 'nomor_order'); //set column field database for datatable searchable 
    var $order = array('created_date' => 'desc'); // default order 


    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($tahun_order)
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where('tahun_order', $tahun_order);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($tahun_order)
    {
        $this->_get_datatables_query();
        $this->db->where('tahun_order', $tahun_order);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($tahun_order)
    {
        $this->db->where('tahun_order', $tahun_order);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    public function delete_by_id($nomor_order, $tahun_order)
    {
        $this->db->where('nomor_order', $nomor_order);
        $this->db->where('tahun_order', $tahun_order);
        $this->db->delete('tbl_order');

        $this->db->where('nomor_order', $nomor_order);
        $this->db->where('tahun_order', $tahun_order);
        $this->db->delete('tbl_sample');

        $this->db->where('nomor_order', $nomor_order);
        $this->db->where('tahun_order', $tahun_order);
        $this->db->delete('tbl_sample_param');

        $this->db->where('nomor_order', $nomor_order);
        $this->db->where('tahun_order', $tahun_order);
        $this->db->delete('tbl_catatan');
    }

    public function save_pengajuan(
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

    ) {
        if($tgl_ambil_sample==null){
            $tglSample = 'null,'; 
        }else{
            $tglSample = "STR_TO_DATE('".$tgl_ambil_sample."','%d-%m-%y'),"; 
        }

        if($tgl_kwi == null){
            $tglKwi = 'null'; 
        }else{        
            $tglKwi = "STR_TO_DATE('".$tgl_kwi."','%d-%m-%y')"; 
        }
        
            $queryCatatan = "INSERT INTO tbl_catatan
            (tgl_ambil_sample,transport, pengawetan, paramlap,nomor_order,tahun_order,catatan_kwi,bml,tgl_kwi
            )
            VALUES 
            (
                $tglSample
                '$transportasi',
                '$pengawetan',
                '$paramlap',
                '$nomor_order',
                '$tahun_order',
                '$catatanKwi',
                '$bml',
                 $tglKwi
            )";
            $this->db->query($queryCatatan);
        
        $queryOrder = "INSERT INTO tbl_order
			(nama_pemohon,nama_perusahaan,alamat_perusahaan, telp_perusahaan, fax_perusahaan,created_date
			)
			VALUES 
			(
                '$nama_pemohon',
                '$nama_perusahaan',
                '$alamat_perusahaan',
                '$telp_perusahaan',
                '$fax_perusahaan',
                now()
			)";
        $this->db->query($queryOrder);
    }

    public function edit_pengajuan(
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
    ) {
        $queryOrder = "UPDATE tbl_order
        set nama_pemohon = '$nama_pemohon'
        ,nama_perusahaan ='$nama_perusahaan'
        ,alamat_perusahaan = '$alamat_perusahaan'
        , telp_perusahaan = '$telp_perusahaan'
        , fax_perusahaan = '$fax_perusahaan'                
        where nomor_order ='$nomor_order'
        and tahun_order = '$tahun_order'
        ";
        $this->db->query($queryOrder);

        if ($tgl_ambil_sample == null) {
            $queryCatatan = "UPDATE tbl_catatan
            set transport = '$transportasi'
            , pengawetan ='$pengawetan'
            , paramlap= '$paramlap'
            , catatan_kwi = '$catatanKwi'
            , bml = '$bml'
            , tgl_kwi ='$tgl_kwi'
            where nomor_order = '$nomor_order'
            and tahun_order = '$tahun_order'
            ";
            $this->db->query($queryCatatan);
        } else {
            $queryCatatan = "UPDATE tbl_catatan
            set 
            tgl_ambil_sample = '$tgl_ambil_sample'
            ,transport = '$transportasi'
            , pengawetan ='$pengawetan'
            , paramlap= '$paramlap'
            , catatan_kwi = '$catatanKwi'
            , bml = '$bml'
            , tgl_kwi ='$tgl_kwi'
            where nomor_order = '$nomor_order'
            and tahun_order = '$tahun_order'
            ";
            $this->db->query($queryCatatan);
        }
    }
}
