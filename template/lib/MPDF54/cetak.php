<?php
include("mpdf.php");

$mpdf=new mPDF('c','A4-L'); 

//$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins

$mpdf->defaultheaderfontsize = 10;	/* in pts */
$mpdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
$mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

$mpdf->defaultfooterfontsize = 8;	/* in pts */
$mpdf->defaultfooterfontstyle = '';	/* blank, B, I, or BI */
$mpdf->defaultfooterline = 0; 	/* 1 to include line below header/above footer */


//$mpdf->SetHeader('{DATE j-m-Y}|{PAGENO}/{nb}|udayana');
$mpdf->SetFooter(date('d - m - Y').'||Halaman {PAGENO} dari {nb}');
//$mpdf->SetFooter('{PAGENO}');	/* defines footer for Odd and Even Pages - placed at Outer margin */
$judul = "PENGGUNAAN SESUATU";
$tahun = "2013";
$judul_tengah = "MAKAN MAKAN";
$html = '
<style>
	.kop{
		width:20%;	
		font-family:Arial, Helvetica, sans-serif;
		font-size:9px;
	}
	#hed{
		font-family:"Arial";
		font-size:15px;
		border : 1nm solid #000;
		border-collapse : collapse; 
	}
	#hed1{
		margin-left:0px;
		font-family:"Arial";
		font-size:12px;
		border : 1nm solid #000;
		border-collapse : collapse; 
	}
	#foot{
		margin-top:40px;
		font-family:"Arial";
		font-size:15px;
	}
	#isi{
		font-family:"Arial";
		font-size:12px;
	}
	.judul{
		width:100%;	
		left:3px;
		font-family:"Arial";
		font-size:15px;
	}
</style>
<div class="kop" align="center" align="center">
	TENTARA NASIONAL INDONESIA ANGKATAN DARAT
    <p style="margin-top:5px; margin-bottom:1px" align="center">STAFF PENGAMANAN TNI AD</p>
    <hr width="90%" />
</div><br />
<div class="judul" align="center">
    	<strong>'.$judul.'</strong>
        <p style="margin-top:5px;" align="center"><strong>'.$judul_tengah.' '.$tahun.'</strong></p>
        
</div><br />
<table border="1" align="center" id="hed" bgcolor="#C6C6C6" height="60px">
	<tr>
    	<th rowspan="2" width="50px" >NO</th>
        <th rowspan="2" width="200px" >KOTAMA</th>
		<th width="200px" rowspan="2" height="40px"  >JUMLAH BIDANG</th>
		<th width="150" rowspan="2"  height="40px"  >LUAS (m2)</th>
        <th width="200px" rowspan="2" height="40px"  >NILAI (Rp)</th>
		<th colspan="2" width="400px" >SUDAH TERSERTIFIKASI</th>
		<th colspan="2" width="400px" >BELUM TERSERTIFIKASI</th>
    </tr>
	<tr>
		<th width="200px" height="20px" >BIDANG</th>
		<th width="200px" >LUAS</th>
		<th width="200px" height="20px" >BIDANG</th>
		<th width="200px" >LUAS</th>
		
    </tr>
</table>
<table align="center" id="hed1" border="1">
	<thead>
		<tr bgcolor="#DAD8D8">
		<th width="50px" height="20px" >1</th>
			<th width="200px" >2</th>
			<th width="200px" >3</th>
			<th width="150px" >4</th>
			<th width="200px" >5</th>
			<th width="200px" >6</th>
			<th width="200px" >7</th>
			<th width="200px" >8</th>
			<th width="200px" >9</th>
		</tr>
	</thead>
	<tbody>';
	//QUERY
	$sqlquery = "SELECT * FROM ( SELECT ROW_NUMBER() OVER (ORDER BY DB2ADMIN.TAMPIL_PAMMAT_PAMSTAL_SERTIFIKASI_PAM.KD_KTM  ) AS nourut, DB2ADMIN.TAMPIL_PAMMAT_PAMSTAL_SERTIFIKASI_PAM.* FROM DB2ADMIN.TAMPIL_PAMMAT_PAMSTAL_SERTIFIKASI_PAM where KD_KTM like '%$_GET[kotama]%'
 ORDER BY DB2ADMIN.TAMPIL_PAMMAT_PAMSTAL_SERTIFIKASI_PAM.ID desc)";  
					$hasil = db2_exec($conn,$sqlquery);
					$no=0;
		while($row = db2_fetch_both($hasil)){
			$no++;
			$html .= '
			<tr bgcolor="#FFFFFF" align="center">
				<td  height="50px" align="center" style="font-size:15px"></td>
				<td  align="center" style="font-size:12px">1</td>		
				<td  align="center" style="font-size:12px">2</td>
				<td  align="center" style="font-size:12px">3</td>
				<td  align="center" style="font-size:12px">4</td>
				<td  align="center" style="font-size:12px">5</td>
				<td  align="center" style="font-size:12px">6</td>
				<td  align="center" style="font-size:12px">7</td>
				<td  align="center" style="font-size:12px">8</td>
			</tr>';
		}
$html .='
	</tbody>
</table>
';

$mpdf->WriteHTML($html);

$mpdf->Output();
exit;

?>