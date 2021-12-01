<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_sample extends CI_Model
{
    var $table = 'v_sample';
    var $column_order = array(null, 'nomor_order', 'tahun_order'); //set column field database for datatable orderable 
    var $column_search = array('nomor_order', 'tahun_order'); //set column field database for datatable searchable 
    var $order = array('nomor_sample' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

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

    function get_datatables($nomor_order, $tahun_order)
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where('nomor_order', $nomor_order);
        $this->db->where('tahun_order', $tahun_order);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($nomor_order, $tahun_order)
    {
        $this->_get_datatables_query();
        $this->db->where('nomor_order', $nomor_order);
        $this->db->where('tahun_order', $tahun_order);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($nomor_order, $tahun_order)
    {
        $this->db->where('nomor_order', $nomor_order);
        $this->db->where('tahun_order', $tahun_order);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function saveSample($kodeUji, $unit, $jumlah, $nomor_order, $tahun_order)
    {
        $this->db->query(
            "insert into tbl_sample (kode_uji,unit,jumlah,nomor_order,tahun_order,created_date) values(
            '$kodeUji', '$unit', '$jumlah', '$nomor_order', '$tahun_order',now())"
        );
    }

    function saveSampleParam($param, $nomor_sample, $tahun_sample, $nomor_order, $tahun_order)
    {
        foreach ($param as $paramList) {
            $this->db->query(
                "insert into tbl_sample_param (id_parameter,nomor_sample,tahun_sample,nomor_order,tahun_order) values(
                '$paramList', '$nomor_sample', '$tahun_sample', '$nomor_order', '$tahun_order')"
            );
        }
    }

    public function delete_by_id($nomor_order, $tahun_order, $nomor_sample, $tahun_sample)
    {
        $this->db->where('nomor_order', $nomor_order);
        $this->db->where('tahun_order', $tahun_order);
        $this->db->where('nomor_sample', $nomor_sample);
        $this->db->where('tahun_sample', $tahun_sample);
        $this->db->delete('tbl_sample');

        $this->db->where('nomor_order', $nomor_order);
        $this->db->where('tahun_order', $tahun_order);
        $this->db->where('nomor_sample', $nomor_sample);
        $this->db->where('tahun_sample', $tahun_sample);
        $this->db->delete('tbl_sample_param');
    }
}
