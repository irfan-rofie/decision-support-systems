<?php
include '../../../template/lib/MPDF54/mpdf.php';
include '../../function/grade_convert.php';
include '../../koneksi.php';
$mpdf=new mPDF('c','A4'); 
function format_bulan($bulan){
    if ($bulan==1) {
        $bln="Januari";
    }elseif ($bulan==2) {
        $bln="Februari";
    }elseif ($bulan==3) {
        $bln="Maret";
    }elseif ($bulan==4) {
       $bln="April";
    }elseif ($bulan==5) {
       $bln="Mei";
    }elseif ($bulan==6) {
       $bln="Juni";
    }elseif ($bulan==7) {
        $bln="Juli";
    }elseif ($bulan==8) {
        $bln="Agustus";
    }elseif ($bulan==9) {
        $bln="September";
    }elseif ($bulan==10) {
        $bln="Oktober";
    }elseif ($bulan==11) {
        $bln="November)";
    }elseif ($bulan==12){
        $bln="Desember";
    }else {
        $bln="";
    }
        return $bln;
    }

function format_hari($hari){
	if ($hari==1) {
		return "Senin";
	}elseif ($hari==2) {
		return "Selasa";
	}elseif ($hari==3) {
		return "Rabu";
	}elseif ($hari==4) {
		return "Kamis";
	}elseif ($hari==5) {
		return "Jum'at";
	}elseif ($hari==6) {
		return "Sabtu";
	}else{
		return "Minggu";
	}
}	
	
function tgl($tgl){
    $date = array();
    $date = explode("-", $tgl);
    $hari = $date[3];
    $tanggal = $date[2];
    $bulan = $date[1];
    $tahun = $date[0];
    return format_hari($hari)." ".$tanggal . " " . format_bulan($bulan) . " " . $tahun;
}
//$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
// $mpdf->defaultheaderfontsize = 10;  /* in pts */
// $mpdf->defaultheaderfontstyle = B;  /* blank, B, I, or BI */
// $mpdf->defaultheaderline = 1;   /* 1 to include line below header/above footer */
// $mpdf->defaultfooterfontsize = 8;   /* in pts */
// $mpdf->defaultfooterfontstyle = ''; /* blank, B, I, or BI */
// $mpdf->defaultfooterline = 0;   /* 1 to include line below header/above footer */
//$mpdf->SetHeader('{DATE j-m-Y}|{PAGENO}/{nb}|udayana');
//$mpdf->SetFooter('{PAGENO}'); /* defines footer for Odd and Even Pages - placed at Outer margin */

$mpdf->SetFooter(tgl(date('Y-m-d-N')).'||Halaman {PAGENO} dari {nb}');
$html = '
<html>
    <head>
        <title>SPK PROSIA | PRINT</title>
    </head>
    <body>
    <table>
    <tr>
      <td>
         <img src="../../../template/dist/img/prosia.png" width="100px" height="100px">
      </td>
      <td>
            &nbsp;&nbsp;&nbsp;&nbsp;PT. Pro Sistimatika Automasi (PROSIA)<br>
            &nbsp;&nbsp;&nbsp;&nbsp;Ruko Roxy Mas Blok D2 No. 28<br>
            &nbsp;&nbsp;&nbsp;&nbsp;Kelurahan Cideng, Gambir, Jakarta Pusat<br>
            &nbsp;&nbsp;&nbsp;&nbsp;Jalan Tanjung Selor, Jakarta 10150<br>
            &nbsp;&nbsp;&nbsp;&nbsp;Telp. (021) 63860306<br>
      </td>
    </tr>
    </table>
    <hr/>    
    <h4 align="center">Proses Penilaian Kinerja Karyawan PT. PROSIA</h4>
    <h4 align="center">Metode <i>Simple Additive Weighting</i> (SAW)</h4><br/><br/> 
    <h4>1. Matrik Penilaian</h4> 
    <table width="1000px" border="1" cellpadding="10" cellspacing="10" style="border-collapse:collapse" bordercolor="#CCCCCC">
          <tr>
            <th>No</th>
            <th>Alternatif / Kriteria</th>';
            $krt = mysql_query("SELECT k.* FROM t_kriteria k WHERE k.status='Y' ORDER BY nama");
            while ($grd = mysql_fetch_array($krt)) {
                $html.='<th>' . $grd['nama'] . '</th>';
            }            
$html.='</tr>';
                        $q="SELECT k.* FROM t_karyawan k, t_nilai n "
                                    . "WHERE k.nik = n.nik and k.status='Y' and n.status='Y' "
                                    . "GROUP BY n.nik ORDER BY k.nama";
                        $sql = mysql_query($q);
                        $no=1;
                        while ($row = mysql_fetch_array($sql)) {                            
                            $html.='<tr>
                                <td align="center">'.$no++.'</td>
                                <td align="center">'.$row['nama'].'</td>';
                                $y = mysql_query("select n.*,s.*,k.* from t_nilai n, t_standar s, t_kriteria k "
                                            . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria and "
                                            . "n.nik='".$row['nik']."' and n.status='Y' and s.status='Y' and k.status='Y' "
                                            . "order by k.nama");
                                        while ($yy = mysql_fetch_array($y)){
                                             $html.='<td>'.$yy['nilai'].'</td>';
                                        }
                            $html.='</tr>';
                        } 
$html.='
        </table>        
        <h4>2. Nilai Pembagi Kriteria</h4>
        <table width="50%" border="1" cellpadding="10" cellspacing="10" style="border-collapse:collapse;" bordercolor="#CCCCCC">
            <tr>
                <th>No</th>
                <th>Kriteria</th>
                <th>Atribut</th>
                <th>Nilai Pembagi</th>                                                
            </tr>';
            $no = 1;
            $sql = mysql_query("SELECT k.nama,k.id_kriteria,k.atribut FROM t_kriteria k "
                    . "left join t_bobot t on k.id_kriteria=t.id_kriteria "
                    . "where k.status='Y' ORDER BY k.nama");
            while ($row = mysql_fetch_array($sql)) {
                $html.='<tr>
                            <td>'.$no++.'</td>
                            <td>'.$row['nama'].'</td>
                            <td>'.$row['atribut'].'</td>';
                if ($row['atribut'] == 'C') {
                    $m = mysql_query("select min(s.nilai) as nilai "
                            . "from t_nilai n, t_standar s, t_kriteria k "
                            . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                            . "and n.status='Y' and s.status='Y' and k.status='Y' "
                            . "and n.id_kriteria='".$row['id_kriteria']."'");
                    $min = mysql_fetch_array($m);
                    $html.='<td>'.$min['nilai'].'</td>';
                } else {
                    $m = mysql_query("select max(s.nilai) as nilai "
                            . "from t_nilai n, t_standar s, t_kriteria k "
                            . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                            . "and n.status='Y' and s.status='Y' and k.status='Y' "
                            . "and n.id_kriteria='".$row['id_kriteria']."'");
                    $max = mysql_fetch_array($m);
                    $html.='<td>'.$max['nilai'].'</td>';                    
                }
                $html.='</tr>';
            }
$html.='</table>
        <h4>3. Matrik Normalisasi</h4>
        <table width="1000px" border="1" cellpadding="10" cellspacing="10" style="border-collapse:collapse" bordercolor="#CCCCCC">
          <tr>
            <th>No</th>
            <th>Alternatif / Kriteria</th>';
            $krtn = mysql_query("SELECT k.* FROM t_kriteria k WHERE k.status='Y' ORDER BY nama");
            while ($grds = mysql_fetch_array($krtn)) {
                $html.='<th>' . $grds['nama'] . '</th>';
            }            
    $html.='</tr>';      
    $no = 1;
    $sqls = mysql_query("SELECT k.* FROM t_karyawan k, t_nilai n "
            . "WHERE k.nik = n.nik and k.status='Y' and n.status='Y' GROUP BY n.nik ORDER BY k.nama");
    while ($rows = mysql_fetch_array($sqls)) {
           $html.='<tr>
                <td>'.$no++.'</td>
                <td>'.$rows['nama'].'</td>';
                $ys = mysql_query("select n.*,s.*,k.* from t_nilai n, t_standar s, t_kriteria k "
                        . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                        . "and n.nik='" . $rows['nik'] . "' and n.status='Y' and s.status='Y' "
                        . "and k.status='Y' order by k.nama");
            while ($yy = mysql_fetch_array($ys)) {
                if ($yy['atribut'] == 'C'){
                    $m = mysql_query("select min(s.nilai) as nilai from t_nilai n, t_standar s, "
                            . "t_kriteria k where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                            . "and n.status='Y' and s.status='Y' and k.status='Y' and n.id_kriteria='".$yy['id_kriteria']."'");
                    $min = mysql_fetch_array($m);
                    $val = $min['nilai'] / $yy['nilai'];
                } else {
                    $m = mysql_query("select max(s.nilai) as nilai from t_nilai n, t_standar s, "
                            . "t_kriteria k where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                            . "and n.status='Y' and s.status='Y' and k.status='Y' and n.id_kriteria='".$yy['id_kriteria']."'");
                    $max = mysql_fetch_array($m);                                            
                    $val = $yy['nilai'] / $max['nilai'];
                } 
                $html.='<td>'.$val.'</td>';   
            }
        $html.='</tr>';    
    }
$html.='</table>
        <h4>4. Bobot Kriteria</h4>
        <table width="50%" border="1" cellpadding="10" cellspacing="10" style="border-collapse:collapse;" bordercolor="#CCCCCC">
            <tr>
                <th>No</th>
                <th>Kriteria</th>
                <th>Atribut</th>
                <th>Bobot</th>
            </tr>';
            $no = 1;
            $sql = mysql_query("SELECT k.nama,k.id_kriteria,k.atribut,t.bobot "
                    . "FROM t_kriteria k left join t_bobot t on k.id_kriteria=t.id_kriteria "
                    . "where k.status='Y' ORDER BY k.nama");
            $to = 0;
            while ($row = mysql_fetch_array($sql)) {
                $to = $to + ($row['bobot']/100);
                $html.='<tr>
                            <td>'.$no++.'</td>
                            <td>'.$row['nama'].'</td>
                            <td>'.$row['atribut'].'</td>           
                            <td>'.($row['bobot']/100).'</td> 
                        </tr>';
            }
$html.='<tr>
            <td colspan="3" align="center">Total Bobot</td>
            <td colspan="3" align="center">'.$to.'</td>            
        </tr>';            
$html.='</table>
        <h4>5. Perankingan</h4>
        <table width="50%" border="1" cellpadding="10" cellspacing="10" style="border-collapse:collapse;" bordercolor="#CCCCCC">
            <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>Ranking</th>
                <th>Grade</th>                
            </tr>';
        $no = 1;
        $sqlr = mysql_query("SELECT k.* FROM t_karyawan k, t_nilai n "
                . "WHERE k.nik = n.nik and k.status='Y' and n.status='Y' "
                . "GROUP BY n.nik ORDER BY k.nama");
        while ($rowr = mysql_fetch_array($sqlr)) {
            $html.='<tr>
                        <td>'.$no++.'</td>
                        <td>'.$rowr['nama'].'</td>';
            $yr = mysql_query("select n.*,s.*,k.* from t_nilai n, t_standar s, t_kriteria k "
                    . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                    . "and n.nik='" . $rowr['nik'] . "' and n.status='Y' and s.status='Y' "
                    . "and k.status='Y' order by k.nama");
            $ranking = 0;
            while ($yyr = mysql_fetch_array($yr)) {
                if ($yyr['atribut'] == 'C') {
                    $mr = mysql_query("select min(s.nilai) as nilai "
                            . "from t_nilai n, t_standar s, t_kriteria k "
                            . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                            . "and n.status='Y' and s.status='Y' and k.status='Y' "
                            . "and n.id_kriteria='" . $yyr['id_kriteria'] . "'");
                    $minr = mysql_fetch_array($mr);
                    $valr = $minr['nilai'] / $yyr['nilai'];
                } else {
                    $mr = mysql_query("select max(s.nilai) as nilai from t_nilai n, t_standar s, "
                            . "t_kriteria k where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                            . "and n.status='Y' and s.status='Y' and k.status='Y' "
                            . "and n.id_kriteria='" . $yyr['id_kriteria'] . "'");
                    $maxr = mysql_fetch_array($mr);
                    $valr = $yyr['nilai'] / $maxr['nilai'];
                }
                $cx =mysql_query("select * from t_bobot where id_kriteria = '" . $yyr['id_kriteria'] . "'");
                $bot = mysql_fetch_array($cx);
                $ranking = $ranking + (($bot['bobot'] / 100) * $valr);
            }
            $html.='    <td>'.$ranking.'</td>
                        <td>'.grade_convert($ranking).'</td>
                    </tr>';   
        }
$html.='</table>
<br/><br/><br/><br/><br/><br/><br/>
		<div style="margin-left:450px;text-align:center;">
		Jakarta, '.tgl(date('Y-m-d-N')).'<br/>
		Supervisor<br/><br/><br/><br/><br/>Adri P Manik Sihotang
		</div>
    </body>
</html>';

$mpdf->WriteHTML($html);

$mpdf->Output("laporan-penilaian.pdf",'I');
exit;
?>