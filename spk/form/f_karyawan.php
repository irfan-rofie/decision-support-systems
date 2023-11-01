<?php
include '../koneksi.php';
$query = mysql_query("SELECT * FROM t_karyawan WHERE nik='" . $_POST['id'] . "'");
$row = mysql_num_rows($query);
if ($row > 0) {
    $sql = mysql_fetch_array($query);
    $title = 'Ubah Data Karyawan';
    $submit = 'Ubah';
    $act = 'update';
    $readonly = 'readonly';
} else {
    $sql['nik'] = '';
    $sql['no_ktp'] = '';
    $sql['nama'] = '';
    $sql['jk'] = '';
    $sql['tempat'] = '';
    $sql['tgl_lahir'] = '';
    $sql['alamat'] = '';
    $sql['no_tlp'] = '';
    $sql['jabatan'] = '';
    $sql['tgl_masuk'] = '';
    $title = 'Tambah Data Karyawan';
    $submit = 'Simpan';
    $act = 'save';
    $readonly = '';
}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?php echo $title; ?></h4>
</div>
<form class="form-horizontal" method="post" action="proses/p_karyawan.php?act=<?php echo $act; ?>">
    <div class="modal-body">
        <div class="box-body">
            <div class="form-group">
                <label for="nik" class="col-sm-3 control-label">NIK</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" 
                           onkeypress="javascript:return isNumber(event)" required maxlength="15" 
                           value="<?php echo $sql['nik'] ?>" <?php echo $readonly; ?>>
                </div>
            </div>
            <div class="form-group">
                <label for="no_ktp" class="col-sm-3 control-label">No. KTP</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="No. KTP" 
                           onkeypress="javascript:return isNumber(event)" required maxlength="16" 
                           value="<?php echo $sql['no_ktp'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Karyawan" required maxlength="25" value="<?php echo $sql['nama'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="jk" class="col-sm-3 control-label">Jenis Kelamin</label>
                <div class="col-sm-9">
                    <div class="radio">
                        <label>
                            <input type="radio" name="jk" id="jk" value="0" <?php echo $sql['jk'] == 0 ? 'checked' : '';?>>Laki-laki
                        </label>
                        <label>
                            <input type="radio" name="jk" id="jk" value="1" <?php echo $sql['jk'] == 1 ? 'checked' : '';?>>Perempuan
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Tempat Lahir</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat Lahir" required maxlength="25" value="<?php echo $sql['tempat'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="tgl_lahir" id="datepicker" value="<?php echo $sql['tgl_lahir'] ?>" required>
                    </div>
                </div>
            </div>            
            <div class="form-group">
                <label for="alamat" class="col-sm-3 control-label">Alamat</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="3" placeholder="Alamat" name="alamat"><?php echo $sql['alamat']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="no_tlp" class="col-sm-3 control-label">No. Telepon</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="No. Telepon" 
                           onkeypress="javascript:return isNumber(event)" required maxlength="12" 
                           value="<?php echo $sql['no_tlp'] ?>">
                </div>
            </div>            
            <div class="form-group">
                <label for="jabatan" class="col-sm-3 control-label">Jabatan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" required maxlength="25" value="<?php echo $sql['jabatan'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal Masuk</label>
                <div class="col-sm-9">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="tgl_masuk" id="datepicker" value="<?php echo $sql['tgl_masuk'] ?>" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default pull-right-container" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary"><?php echo $submit; ?></button>
    </div>
</form>
<script type="text/javascript">
    $(function () {
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
    })
</script>