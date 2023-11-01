<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php
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
                    <h3 class="box-title">Data Alternatif</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Alternatif</th>
                                <th>Periode</th>
                                <th>Tanggal Penilaian</th>
                                <th><a href="#modal-default-1" data-toggle="modal" class="add-alt" id="0"><span class="label label-success">Tambah</span></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../spk/koneksi.php';
                            include '../spk/function/date_convert.php';
                            $no = 1;
                            $sql = mysql_query("SELECT k.*,a.* FROM t_karyawan k, t_alternatif a WHERE a.nik=k.nik AND a.aktif='Y'");
                            while ($row = mysql_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['periode']; ?></td>
                                    <td><?php echo tgl_($row['tgl_penilaian']); ?></td>
                                    <td>
                                        <a href="#modal-default-1" data-toggle="modal" class="edit-alt" id="<?php echo $row['id_alternatif']; ?>"><span class="label label-warning">Ubah</span></a>  
                                        <a href="#" onclick="yes('../spk/proses/p_alternatif.php?act=delete&id=<?php echo $row['id_alternatif']?>')"> <span class="label label-danger">Hapus</span></a>
                                    </td>
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