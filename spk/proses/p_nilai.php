<?php

include '../koneksi.php';
$act = $_GET['act'];
$id_kriteria = $_POST['id_kriteria'];
$id_standar = $_POST['id_standar'];
switch ($act) {
    case "save":
        $nik = $_POST['nik'];
        foreach ($id_kriteria as $key => $id) {
            mysql_query("INSERT INTO t_nilai(nik,id_kriteria,id_standar) VALUES('" . $nik . "','" . $id_kriteria[$key] . "','" . $id_standar[$key] . "')");
        }
        header("location:../../spk/index.php?menu=pnl&action=save&status=succes");
        break;
    case "update":
        $id_nilai = array();
        $nik_ = $_POST['nik_'];
        $v = mysql_query("select * from t_nilai where nik='" . $nik_ . "' and status='Y'");
        while ($d = mysql_fetch_array($v)) {
            $id_nilai[] = $d['id_nilai'];
        }
        foreach ($id_kriteria as $key => $id) {
            mysql_query("UPDATE t_nilai set nik='" . $nik_ . "', id_kriteria='" . $id_kriteria[$key] . "', "
                    . "id_standar='" . $id_standar[$key] . "' where id_nilai='".$id_nilai[$key]."'");
        }
        header("location:../../spk/index.php?menu=pnl&action=update&status=succes");
        break;
}
?>