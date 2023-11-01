<?php

function format_bulan($bulan) {
    if ($bulan == 1) {
        $bln = "Januari";
    } elseif ($bulan == 2) {
        $bln = "Februari";
    } elseif ($bulan == 3) {
        $bln = "Maret";
    } elseif ($bulan == 4) {
        $bln = "April";
    } elseif ($bulan == 5) {
        $bln = "Mei";
    } elseif ($bulan == 6) {
        $bln = "Juni";
    } elseif ($bulan == 7) {
        $bln = "Juli";
    } elseif ($bulan == 8) {
        $bln = "Agustus";
    } elseif ($bulan == 9) {
        $bln = "September";
    } elseif ($bulan == 10) {
        $bln = "Oktober";
    } elseif ($bulan == 11) {
        $bln = "November)";
    } elseif ($bulan == 12) {
        $bln = "Desember";
    } else {
        $bln = "";
    }
    return $bln;
}

function tgl_($tgl) {
    $date = array();
    $date = explode("-", $tgl);
    $tanggal = $date[2];
    $bulan = $date[1];
    $tahun = $date[0];
    return $tanggal . " " . format_bulan($bulan) . " " . $tahun;
}
?>

