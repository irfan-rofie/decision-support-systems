<?php
    include '../koneksi.php';
    include '../function/date_convert.php';
    $act = $_GET['act'];
    switch ($act) {
        case "save":
            mysql_query("INSERT INTO t_karyawan VALUES('" . $_POST['nik'] . "','" . $_POST['nama'] . "','" . $_POST['jabatan'] . "','" . $_POST['tgl_masuk'] . "','" . $_POST['no_ktp'] . "','" . $_POST['jk'] . "','" . $_POST['tempat'] . "','" . $_POST['tgl_lahir'] . "','" . $_POST['alamat'] . "','" . $_POST['no_tlp'] . "','Y')");
//            $z = mysql_query("SELECT * FROM t_alternatif WHERE nik='". $_POST['nik'] ."'");
//            $row = mysql_num_rows($z);
//            if ($row == 0) {
//                mysql_query("INSERT INTO t_alternatif (nik,periode,tgl_penilaian) VALUES('" . $_POST['nik'] . "','" . date('Y') . "','" . date('Y-m-d') . "')");                
//            }
            header("location:../../spk/index.php?menu=kyw&status=succes&action=save");
            break;
        case "update":
            mysql_query("UPDATE t_karyawan SET nama='" . $_POST['nama'] . "',jabatan='" . $_POST['jabatan'] . "',tgl_masuk='" . $_POST['tgl_masuk'] . "',no_ktp='" . $_POST['no_ktp'] . "',jk='" . $_POST['jk'] . "',tempat='" . $_POST['tempat'] . "',tgl_lahir='" . $_POST['tgl_lahir'] . "',alamat='" . $_POST['alamat'] . "',no_tlp='" . $_POST['no_tlp'] . "' WHERE nik='".$_POST['nik']."'");
            header("location:../../spk/index.php?menu=kyw&status=succes&action=update");
            break;
        case "delete":
            mysql_query("UPDATE t_karyawan SET status='N' WHERE nik='".$_GET['id']."'");
            header("location:../../spk/index.php?menu=kyw&status=succes&action=delete");
            break;
    }
?>