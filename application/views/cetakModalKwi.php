<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->library('HtmlTable');


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
$tahunx = $this->input->post('tahun');

$array = implode("','", $listid);

$this->appdb = $this->load->database('default', true);
$data = $this->appdb->query("
                select nama_perusahaan,nomor_order, tahun_order, sum(harga_total) tot_harga,catatan_kwi,tgl_kwi from (
                    select x.*,
                    GROUP_CONCAT(nama_param SEPARATOR ', ') param,
                    sum(harga) harga_total 
                    from (
                    select d.nama_perusahaan,b.nomor_order,b.tahun_order,a.nomor_sample,a.tahun_sample,a.kode_uji,a.unit,a.jumlah,c.nama_param,c.harga,e.catatan_kwi,e.tgl_kwi from tbl_sample a
                    left join tbl_sample_param b
                    on a.nomor_sample= b.nomor_sample
                    and a.tahun_sample = b.tahun_sample
                    and a.nomor_order = b.nomor_order
                    and a.tahun_order = b.tahun_order
                    left join tbl_param c
                    on b.id_parameter = c.id_param
                                    left join tbl_order d
                                    on a.nomor_order = d.nomor_order
                    and a.tahun_order = d.tahun_order
                                    left join tbl_catatan e
                                    on a.nomor_order = e.nomor_order
                    and a.tahun_order = e.tahun_order
                                    ) x
                    WHERE nomor_order in ('$array')
                    and tahun_order in ($tahunx)
                    GROUP BY nomor_sample,tahun_sample               
                                ) 
                                    xx
                    GROUP BY nomor_order
            ");
$hasil = $data->result_array();

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

//$angka = 323256532;


//$pdf = new FPDF('L', 'mm', 'A5');/*L untuk tampilan Landscape, A5 adalah ukuran kertasnya*/
$pdf = new PDF_MC_Table('P', 'mm', 'A5');
//$pdf->SetTopMargin(2);

$arraybln = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
$bln = $arraybln[date('n') - 1];
$thn = date('Y');
$tgl = date('d');
/*membuat file PDF untuk dicetak*/
//$pdf->setMargins(10, 6, 10);
foreach ($hasil as $list) {
    $pdf->AddPage();
    $pdf->Image('assets/img/bogor.png',  9, 9, 18, 18);
    // //meletakkan judul disamping logo diatas

    $pdf->Cell(8);
    $pdf->SetFont('Times', 'B', '10');
    $pdf->Cell(0, 5, 'PEMERINTAH KABUPATEN BOGOR', 0, 1, 'C');
    $pdf->Cell(8);
    $pdf->Cell(0, 5, 'DINAS LINGKUNGAN HIDUP', 0, 1, 'C');
    $pdf->Cell(8);
    $pdf->SetFont('Times', 'B', '10');
    $pdf->Cell(0, 5, 'UNIT PELAKSANA TEKNIS LABORATORIUM LINGKUNGAN', 0, 1, 'C');
    $pdf->Cell(8);
    $pdf->SetFont('Times', 'I', '8');
    $pdf->Cell(0, 5, 'jl. H. Jairan Kelurahan Pakansari Kecamatan Cibinong Kabupaten Bogor, Cibinong - 16915', 0, 1, 'C');
    $pdf->Cell(8);
    $pdf->Cell(0, 2, 'Telp./Fax. (021) 8765124, e-mail : lablingkkabbogor@yahoo.co.id', 0, 1, 'C');
    $pdf->SetX(30);

    $pdf->SetLineWidth(1);
    $pdf->Line(10, 35, 138, 35);
    $pdf->SetLineWidth(0);
    $pdf->Line(10, 36, 138, 36);

    $pdf->SetFont('Times', 'B', '12');
    $pdf->Cell(50);


    $pdf->Ln(6);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25);
    $pdf->SetLineWidth(0.2);
    $pdf->Cell(90, 7, 'TANDA BUKTI PEMBAYARAN', 1, 1, 'C');
    //$pdf->SetLineWidth(0.4);
    //$pdf->Rect(60, 30, 80, 13);/*ubah ukuran Kotak Judul -> Rect(sumbu x, sumbu y, lebar kotak,tinggi kotak)*/
    $pdf->SetFont('Arial', '', 11);
    $pdf->Ln(3);

    $pdf->Cell(45, 5, 'Nomor Order : ' . $list['nomor_order'] . ' Tahun Order : ' . $list['tahun_order'], 0, 0, 'L');
    $pdf->Ln(8);

    $pdf->Cell(40, 5, 'Telah Terima Dari', 0, 0, 'L');
    $pdf->Cell(5, 5, ':', 0, 0, 'L');
    $pdf->Cell(50, 5, $list['nama_perusahaan'], 0, 1, 'L');
    $pdf->Ln(1);

    $pdf->Cell(40, 5, 'Uang sejumlah', 0, 0, 'L');
    $pdf->Cell(5, 5, ':', 0, 0, 'L');
    $pdf->MultiCell(78, 5, strtoupper(terbilang($list['tot_harga'])) . " RUPIAH", 1, 'L', false);

    
    $catatanKwi = '';
    if($list['catatan_kwi'])
    {
        $catatanKwi = $list['catatan_kwi'];
    }else{ 
        $catatanKwi = '.......................................................................';
    }

    if($list['tgl_kwi']){
        $tgl_kwiy = strtotime($list['tgl_kwi']);
        $tgl_kwix = date('Y-m-d',$tgl_kwiy);
        $tgl_kwi = tgl_indo($tgl_kwix);    
    }else{
        $tgl_kwi = '.................';    
    }


    $pdf->Cell(40, 5, 'Catatan', 0, 0, 'L');
    $pdf->Cell(5, 5, ':', 0, 0, 'L');
    $pdf->Cell(50, 5, $catatanKwi, 0, 1, 'L');
    $pdf->Ln();
    $pdf->Cell(150);
    $pdf->Cell(0, 5, 'Cibinong' . ', ' . $tgl_kwi, 0, 1, 'R');
    $pdf->Cell(45, 10, 'Rp. ' . number_format($list['tot_harga'], 0, ",", ".") . ', -', 1, 0, 'C');
    $pdf->Ln(10);
    $pdf->Cell(100);
    $pdf->Cell(0, 5, '..........................', 0, 1, 'C');
}


$output = $pdf->Output('', 'S');
$output = base64_encode($output);
?>



<iframe src="data:application/pdf;base64,<?php echo $output ?>" type='application/pdf' width="100%" height="500px">
</iframe>