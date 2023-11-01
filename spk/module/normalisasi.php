<?php include '../spk/koneksi.php'; ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Matrik Normalisasi</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Alternatif / Kriteria</th>
                                <?php
                                $krt = mysql_query("SELECT k.* FROM t_kriteria k WHERE k.status='Y' ORDER BY nama");
                                while ($grd = mysql_fetch_array($krt)) {
                                    echo '<th>' . $grd['nama'] . '('. $grd['atribut'] .')</th>';
                                }
                                ?>
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
                                    while ($yy = mysql_fetch_array($y)) {
                                        if ($yy['atribut'] == 'C'){
                                            $m = mysql_query("select min(s.nilai) as nilai from t_nilai n, t_standar s, t_kriteria k "
                                                    . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                                                    . "and n.status='Y' and s.status='Y' and k.status='Y' "
                                                    . "and n.id_kriteria='".$yy['id_kriteria']."'");
                                            $min = mysql_fetch_array($m);
                                            $val = $min['nilai'] / $yy['nilai'];
                                        } else {
                                            $m = mysql_query("select max(s.nilai) as nilai from t_nilai n, t_standar s, t_kriteria k "
                                                    . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                                                    . "and n.status='Y' and s.status='Y' and k.status='Y' "
                                                    . "and n.id_kriteria='".$yy['id_kriteria']."'");
                                            $max = mysql_fetch_array($m);                                            
                                            $val = $yy['nilai'] / $max['nilai'];
                                        }
                                        echo '<td>' . $val . '</td>';
                                    }
                                    ?>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>
				<div class="box-footer">
                    <h5 class="box-title"><i>Keterangan : </i></h5>
                    <h5 class="box-title">C : Cost</h5>					
                    <h5 class="box-title">B : Benefeit</h5>					
                </div>
            </div>
        </div>
    </div>
</section>