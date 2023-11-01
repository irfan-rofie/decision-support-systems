<?php
$path_content = '../spk/module/';
if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
    switch ($menu) {
        default :$content = $path_content . 'beranda.php';
            break;
        case "kyw" :$content = $path_content . 'karyawan.php';
            break;
        case "alt" :$content = $path_content . 'alternatif.php';
            break;
        case "krt" :$content = $path_content . 'kriteria.php';
            break;                        
        case "std" :$content = $path_content . 'standar.php';
            break;                                    
        case "bbt" :$content = $path_content . 'bobot.php';
            break;                                    
        case "pnl" :$content = $path_content . 'matrik.php';
            break;                                    
        case "nrm" :$content = $path_content . 'normalisasi.php';
            break;                                    
        case "rkg" :$content = $path_content . 'perankingan.php';
            break;                                    
        case "usr" :$content = $path_content . 'user.php';
            break;                                               
        case "lap" :$content = $path_content . 'laporan.php';
            break;                                                       
    }
} else {
    $content = $path_content . 'beranda.php';
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php include $content; ?>
</div>
<!-- /.content-wrapper -->