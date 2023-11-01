<?php
include '../spk/koneksi.php';
include '../spk/function/grade_convert.php';
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Perangkingan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Alternatif</th>
                                <th>Ranking</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysql_query("SELECT k.* FROM t_karyawan k, t_nilai n "
                                    . "WHERE k.nik = n.nik and k.status='Y' and n.status='Y' "
                                    . "GROUP BY n.nik ORDER BY k.nama");
                            while ($row = mysql_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <?php
                                    $y = mysql_query("select n.*,s.*,k.* from t_nilai n, t_standar s, t_kriteria k "
                                            . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria and "
                                            . "n.nik='" . $row['nik'] . "' and n.status='Y' and s.status='Y' and k.status='Y' "
                                            . "order by k.nama");
                                    $ranking = 0;
                                    while ($yy = mysql_fetch_array($y)) {
                                        if ($yy['atribut'] == 'C') {
                                            $m = mysql_query("select min(s.nilai) as nilai from t_nilai n, t_standar s, t_kriteria k "
                                                    . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                                                    . "and n.status='Y' and s.status='Y' and k.status='Y' "
                                                    . "and n.id_kriteria='" . $yy['id_kriteria'] . "'");
                                            $min = mysql_fetch_array($m);
                                            $val = $min['nilai'] / $yy['nilai'];
                                        } else {
                                            $m = mysql_query("select max(s.nilai) as nilai from t_nilai n, t_standar s, t_kriteria k "
                                                    . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                                                    . "and n.status='Y' and s.status='Y' and k.status='Y' "
                                                    . "and n.id_kriteria='" . $yy['id_kriteria'] . "'");
                                            $max = mysql_fetch_array($m);
                                            $val = $yy['nilai'] / $max['nilai'];
                                        }
                                        $cx = mysql_query("select * from t_bobot where id_kriteria = '" . $yy['id_kriteria'] . "'");
                                        $bot = mysql_fetch_array($cx);
                                        $ranking = $ranking + (($bot['bobot'] / 100) * $val);
                                    }
                                    ?>
                                    <td><?php echo $ranking; ?></td>
                                    <td><?php echo grade_convert($ranking); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>