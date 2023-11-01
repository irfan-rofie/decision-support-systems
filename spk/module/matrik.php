<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php
            include '../spk/koneksi.php';
            if (isset($_GET['status'])) {
                $param = $_GET['status'];
                if ($param == 'succes') {
                    if ($_GET['action'] == 'save') {
                        $action = 'disimpan.';
                    } else if ($_GET['action'] == 'update') {
                        $action = 'diubah.';
                    } else {
                        $action = 'dihapus.';
                    }
                    ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                        Data berhasil <?php echo $action; ?>
                    </div>
                <?php } else if ($param == 'danger') { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
                        Data Gagal disimpan.
                    </div>
                    <?php
                }
            }
            ?>
        </div>        
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Matrik Penilaian</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Alternatif / Kriteria</th>
                                <?php
                                $krt = mysql_query("SELECT k.* FROM t_kriteria k WHERE k.status='Y' and k.id_kriteria IN(select DISTINCT(n.id_kriteria) from t_nilai n WHERE status='Y') ORDER BY nama");
                                while ($grd = mysql_fetch_array($krt)) {
                                    echo '<th>' . $grd['nama'] . '</th>';
                                } ?>
                                <?php if ($_SESSION['level'] == "Supervisor") { ?>
                                <th><a href="#modal-default-1" data-toggle="modal" class="add-pnl" id="0"><span class="label label-success">Tambah</span></a></th>
                                <?php } ?>
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
                                    <?php $y = mysql_query("select n.*,s.*,k.* from t_nilai n, t_standar s, t_kriteria k "
                                            . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria and "
                                            . "n.nik='".$row['nik']."' and n.status='Y' and s.status='Y' and k.status='Y' "
                                            . "order by k.nama");
                                        while ($yy = mysql_fetch_array($y)){
                                             echo '<td>'.$yy['nilai'].'</td>';
                                        }
                                    ?>
                                    <?php if ($_SESSION['level'] == "Supervisor") { ?>
                                    <td>
                                        <a href="#modal-default-1" data-toggle="modal" class="edit-pnl" id="<?php echo $row['nik']; ?>"><span class="label label-warning">Ubah</span></a>  
                                        <a href="#" onclick="yes('../spk/proses/p_standar.php?act=delete&id=<?php echo $row['id_standar']?>')"> <span class="label label-danger">Hapus</span></a>                                    
                                    </td>                                    
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-default-1">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
</section>