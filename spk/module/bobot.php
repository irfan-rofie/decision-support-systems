<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (isset($_GET['status'])) {
                $param = $_GET['status'];
                if ($param == 'succes') { ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                        Data berhasil disimpan.
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
                    <h3 class="box-title">Data Bobot Kriteria</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th style="width: 150px;">
                                    <?php if ($_SESSION['level'] == "Supervisor") { ?>
                                    <a href="#modal-default-1" data-toggle="modal" class="add-bbt" id="0" onclick="calculates();">
                                        <span class="label label-primary">Atur Bobot Kriteria</span>
                                    </a>
                                    <?php } ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../spk/koneksi.php';
                            $no = 1;
                            $sql = mysql_query("SELECT k.nama,t.bobot FROM t_kriteria k left join t_bobot t on k.id_kriteria=t.id_kriteria where k.status='Y'");
                            while ($row = mysql_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['bobot'] == null ? 0 : $row['bobot']; ?>%</td>                                   
                                    <td>
                                        <span class="badge bg-green"><?php echo $row['bobot']/100; ?></span>
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