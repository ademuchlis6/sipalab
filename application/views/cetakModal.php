<?php
defined('BASEPATH') or exit('No direct script access allowed');

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}


$listid = $this->input->post('listid');
$tahun = $this->input->post('tahun');

$array = implode("','", $listid);

$this->appdb = $this->load->database('default', true);
$data = $this->appdb->query("
			select 
			a.nomor_order,a.tahun_order,a.nama_pemohon,a.nama_perusahaan,a.alamat_perusahaan,a.telp_perusahaan,a.fax_perusahaan
			,b.nomor_sample,b.tahun_sample,b.kode_uji,b.unit,b.jumlah
			from tbl_order a
			left join tbl_sample b
			on a.nomor_order = b.nomor_sample
			and a.tahun_order = b.tahun_sample
			where a.nomor_order in ('$array')
			and a.tahun_order in($tahun)
			;
            ");
$hasil = $data->result_array();
//var_dump($hasil);

$this->load->library('HtmlTable');


$tglISO = $this->appdb->query("
            select value_config from tbl_config
            where id = 1
			;");
$hasilTglISO = $tglISO->row()->value_config;

$formISO = $this->appdb->query("
            select value_config from tbl_config
            where id = 2
			;");
$hasilFormIso = $formISO->row()->value_config;

$terbitanIso = $this->appdb->query("
            select value_config from tbl_config
            where id = 3
			;");
$hasilTerbitanIso = $terbitanIso->row()->value_config;

$bml = $this->appdb->query("
            select value_config from tbl_config
            where id = 4
			;");
$hasilBML = $bml->row()->value_config;



$arraybln = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
$bln = $arraybln[date('n') - 1];
$thn = date('Y');
$tgl = date('d');

$pdf = new PDF_MC_Table('L', 'mm', 'A4');

$num = 2;

//var_dump($hasil);

foreach ($hasil as $list) {
    // for ($i = 0; $i < 2; $i++) {
    $pdf->AddPage('P', 'A4');
    //meletakkan gambar
    $pdf->Image('assets/img/bogor.png',  10, 10, 20, 25);
    // //meletakkan judul disamping logo diatas

    $pdf->Cell(5);
    $pdf->SetFont('Times', 'B', '12');
    $pdf->Cell(0, 5, 'PEMERINTAH KABUPATEN BOGOR', 0, 1, 'C');
    $pdf->Cell(5);
    $pdf->Cell(0, 5, 'DINAS LINGKUNGAN HIDUP', 0, 1, 'C');
    $pdf->Cell(5);
    $pdf->SetFont('Times', 'B', '15');
    $pdf->Cell(0, 5, 'UNIT PELAKSANA TEKNIS LABORATORIUM LINGKUNGAN', 0, 1, 'C');
    $pdf->Cell(5);
    $pdf->SetFont('Times', 'I', '8');
    $pdf->Cell(0, 5, 'jl. H. Jairan Kelurahan Pakansari Kecamatan Cibinong Kabupaten Bogor, Cibinong - 16915', 0, 1, 'C');
    $pdf->Cell(5);
    $pdf->Cell(0, 2, 'Telp./Fax. (021) 8765124, e-mail : lablingkkabbogor@yahoo.co.id', 0, 1, 'C');
    //membuat garis ganda tebal dan tipis
    $pdf->SetLineWidth(1);
    $pdf->Line(10, 36, 200, 36);
    $pdf->SetLineWidth(0);
    $pdf->Line(10, 37, 200, 37);

    $pdf->SetFont('Times', 'B', '9');
    $pdf->Cell(0, 16, $hasilFormIso, 0, 1, 'R');
    $pdf->Cell(25);
    $pdf->Cell(0, -7, $hasilTerbitanIso, 0, 1, 'R');

    $pdf->SetFont('Times', 'B', '12');
    $pdf->Cell(0, 16, 'LEMBAR PERMOHONAN', 0, 1, 'C');
    $pdf->Cell(0, -3, 'PEMERIKSAAN CONTOH UJI', 0, 1, 'C');

    $pdf->SetFont('Times', '', '10');
    $pdf->Cell(0, 20, 'Nomor Order', 0, 1, 'L');
    $pdf->Cell(23);
    $pdf->Cell(0, -20, ': ' . $list['nomor_order'], 0, 1, 'L');
    $pdf->Cell(0, 30, 'Nama', 0, 1, 'L');
    $pdf->Cell(23);
    $pdf->Cell(0, -30, ': ' . $list['nama_pemohon'], 0, 1, 'L');
    $pdf->Cell(0, 40, 'Perusahaan', 0, 1, 'L');
    $pdf->Cell(23);
    $pdf->Cell(0, -40, ': ' . $list['nama_perusahaan'], 0, 1, 'L');
    $pdf->Cell(0, 50, 'Alamat', 0, 1, 'L');
    $pdf->GetY();
    $pdf->SetY($pdf->GetY()-28);
    $pdf->Cell(23);
   // $pdf->Cell(0, -50, ': ' . $list['alamat_perusahaan'], 0, 1, 'L');
    $pdf->MultiCell(0, 6, ': ' . $list['alamat_perusahaan'], 0, 'L',false); //vertically merged cell     
    $pdf->GetY();
    $pdf->SetY($pdf->GetY()-28);
    $pdf->Cell(0, 60, 'Telepon', 0, 1, 'L');
    $pdf->Cell(23);
    $pdf->Cell(0, -60, ': ' . $list['telp_perusahaan'], 0, 1, 'L');
    $pdf->Cell(60);
    $pdf->Cell(0, 60, 'Fax : ' . $list['fax_perusahaan'], 0, 1, 'L');
    $pdf->SetFont('Times', 'B', '10');
    $pdf->Ln(1);
    $pdf->Cell(0, -50, 'Bersama ini mengajukan permohonan untuk pemeriksaan contoh uji berikut :', 0, 1, 'L');

    $pdf->Cell(0, 30, '', 0, 1, 'L');

    $pdf->SetLeftMargin(17);

    $pdf->SetWidths(array(20, 40, 38, 25, 52));
    $pdf->SetLineHeight(5);
    $pdf->SetLineWidth(0.2);
    $pdf->SetAligns(array('L', 'L', 'L', 'L', 'L', 'L'));

    $pdf->SetFont('Times', 'B', '9');

    $pdf->Cell(20, 10, 'NO', 1, 0, 'C'); //vertically merged cell, height=2x row height=2x5=10
    $pdf->Cell(40, 10, 'KODE CONTOH UJI', 1, 0, 'C'); //vertically merged cell
    $pdf->Cell(38, 10, 'UNIT/KEMASAN', 1, 0, 'C'); //normal height, but occupy 4 columns (horizontally merged)
    $pdf->Cell(25, 10, 'JUMLAH (Ml)', 1, 0, 'C'); //vertically merged cell
    $pdf->Cell(52, 10, 'PERMINTAAN PARAMETER UJI', 1, 0, 'C'); //vertically merged cell

    //add a new line
    $pdf->Ln();
    //reset font

    //loop the data
    $data2 = $this->appdb->query("
                select x.*,
                GROUP_CONCAT(nama_param SEPARATOR ', ') param,
                sum(harga) harga_total 
                from (
                select b.nomor_order,b.tahun_order,a.nomor_sample,a.tahun_sample,a.kode_uji,a.unit,a.jumlah,c.nama_param,c.harga from tbl_sample a
                left join tbl_sample_param b
                on a.nomor_sample= b.nomor_sample
                and a.tahun_sample = b.tahun_sample
                and a.nomor_order = b.nomor_order
                and a.tahun_order = b.tahun_order
                left join tbl_param c
                on b.id_parameter = c.id_param
                ) x
                WHERE nomor_order in (" . $list['nomor_order'] . ")
                and tahun_order in (" . $list['tahun_order'] . ")
                GROUP BY nomor_sample,tahun_sample    
            ");
    $hasil2 = $data2->result_array();
    foreach ($hasil2 as $list2) {
        $pdf->Row(array(
            $list2['nomor_sample'],
            $list2['kode_uji'],
            $list2['unit'],
            number_format($list2['jumlah'], 0, ",", "."),
            $list2['param'],
        ));
    }
    // for ($x = 0; $x < 3; $x++) {
    //     //write data using Row() method containing array of values.
    //     $pdf->Row(array(
    //         '',
    //         '',
    //         '',
    //         '',
    //         '',
    //     ));
    // }
    $data3 = $this->appdb->query("
                select * from tbl_catatan
                WHERE nomor_order in (" . $list['nomor_order'] . ")
                and tahun_order in (" . $list['tahun_order'] . ")                    
            ");
    $hasil3 = $data3->result_array();
    foreach ($hasil3 as $list3) {
        $tgl_ambil_samplex = $list3['tgl_ambil_sample'];
        $transport = $list3['transport'];
        $pengawetan = $list3['pengawetan'];
        $paramlap = $list3['paramlap'];
        $bml = $list3['bml'];
    }

    if($tgl_ambil_samplex){
        $tgl_ambil_sampley = strtotime($tgl_ambil_samplex);
        $tglx = date('Y-m-d',$tgl_ambil_sampley);
        $tgl_ambil_sample = tgl_indo($tglx);            
    }
    

    if($pdf->GetY()>210){
        $pdf->Ln();  
        $pdf->Ln();     
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
    }

    $pdf->Ln();
    //    $pdf->SetY(165);
    //    $pdf->SetX(17);
    $pdf->SetFont('Times', 'B', '10');
    // $pdf->SetFont('Times', 'B', '10');
    // $pdf->SetLineHeight(10);
    // $pdf->SetLineWidth(0.2);
    // $pdf->SetAligns(array('L', 'L'));
    // $pdf->SetWidths(array(65, 110));
    
    // $pdf->Row(array(
    //     'Dengan Baku Mutu Lingkungan (BML) :',
    //     $bml,
    // ));


    $pdf->MultiCell(175, 10, 'Dengan Baku Mutu Lingkungan (BML) : ' . $bml, 1, 'L',false); //vertically merged cell     
    $pdf->Cell(150, 30, '', 1, 0, 'L'); //vertically merged cell  
    $pdf->SetX($pdf->GetX() - 150);
    //$pdf->Cell(0, 5, 'Text inside second column ', 1, 0, 'L');
    $pdf->Cell(0, 5, 'Catatan Abnormalitas :', 0, 1, 'L');
    $pdf->Cell(55);
    $pdf->Cell(0, -5, '', 0, 1, 'L');
    $pdf->Cell(0, 20, 'Tanggal Pengambilan sampel', 0, 1, 'L');
    $pdf->Cell(55);
    $pdf->Cell(0, -20, ': ' . $tgl_ambil_sample, 0, 1, 'L');
    $pdf->Cell(0, 30, 'Transportasi/pengamanan sampel', 0, 1, 'L');
    $pdf->Cell(55);
    $pdf->Cell(0, -30, ': ' . $transport, 0, 1, 'L');
    $pdf->Cell(0, 40, 'Pengawetan sample', 0, 1, 'L');
    $pdf->Cell(55);
    $pdf->Cell(0, -40, ': ' . $pengawetan, 0, 1, 'L');
    $pdf->Cell(0, 50, 'Parameter lapangan yang diukur', 0, 1, 'L');
    $pdf->Cell(55);
    $pdf->Cell(0, -50, ': ' . $paramlap, 0, 1, 'L');

    // $pdf->SetX($pdf->GetX() + 150);
    $pdf->Cell(150, 30, '', 1, 0, 'L'); //vertically merged cell
    // $pdf->SetX($pdf->GetX() - 25);
    $pdf->Cell(25, 5, 'Paraf *', 'R', 0, 'L'); //vertically merged cell
    $pdf->Ln();
    $pdf->Cell(150, 30, '', 0, 0, 'L'); //vertically merged cell
    $pdf->Cell(25, 25, '', 'R,B', 0, 'L'); //vertically merged cell


    //$pdf->SetY(210);
    //$pdf->SetX(175);
    //    $pdf->Cell(140, 60, 'Paraf *', 0, 1, 'L');
  //  $pdf->SetY(190);
    $pdf->Ln();  

    if($pdf->GetY()>220){
        $pdf->Ln();  
        $pdf->Ln();   
        $pdf->Ln();          
        $pdf->Ln();
    }

    $pdf->Cell(130);

    $pdf->Cell(0, 10, 'Cibinong, ' . $tgl . ' ' . $bln . ' ' . $tahun, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Catatan : * paraf pelanggan/pengirim contoh uji', 0, 1, 'L');
    $pdf->Cell(10);
    $pdf->Cell(0, 10, 'Penerima contoh uji', 0, 1, 'L');
    $pdf->Cell(140);
    $pdf->Cell(0, -10, 'Pengirim contoh uji', 0, 1, 'L');
    $pdf->Cell(0,10);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(10);
    $pdf->Cell(0, 10, '....................................', 0, 1, 'L');
    $pdf->Cell(140);
    $pdf->Cell(0, -10, '....................................', 0, 1, 'L');
    
    $pdf->Cell(0,10);
    $pdf->Ln();

    $pdf->Cell(0, 10, 'Keterangan lembar putih : Manajer Teknis, lembar kuning : Costumer, lembar biru : Manager Administrasi', 0, 1, 'L');
    $pdf->Cell(0, 10, 'Tanggal : ' . $hasilTglISO, 0, 1, 'L');
}
$output = $pdf->Output('', 'S');
$output = base64_encode($output);


?>

<iframe src="data:application/pdf;base64,<?php echo $output ?>" type='application/pdf' width="100%" height="500px">
</iframe>