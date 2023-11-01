<?php
include '../koneksi.php';
$query = mysql_query("SELECT a.* FROM t_alternatif a WHERE a.id_alternatif='" . $_POST['id'] . "'");
$row = mysql_num_rows($query);
if ($row > 0) {
    $sql = mysql_fetch_array($query);
    $title = 'Ubah Data Alternatif';
    $submit = 'Ubah';
    $act = 'update';
    $readonly = 'readonly';
} else {
    $sql['nik'] = '';
    $sql['periode'] = '';
    $sql['tgl_penilaian'] = '';
    $title = 'Tambah Data Alternatif';
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
<form class="form-horizontal" method="post" action="proses/p_alternatif.php?act=<?php echo $act; ?>">
    <div class="modal-body">
        <div class="box-body">
            <div class="form-group">
                <input type="hidden" name="id_alternatif" value="<?php echo $sql['id_alternatif']; ?>">
                <label for="nama" class="col-sm-3 control-label">Nama Alternatif</label>
                <div class="col-sm-9">
                    <select name="nik" class="form-control select2" style="width: 100%;" required>
                        <option value="pilih" selected disabled="disabled">- Pilih -</option>
                        <?php
                        $x = mysql_query("select * from t_karyawan where status='Y' and nik not in(select nik from t_alternatif where nik <> '" . $sql['nik'] . "' and aktif='Y')");
                        while ($obj = mysql_fetch_object($x)) {
                            if ($obj->nik == $sql['nik']) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $obj->nik; ?>" <?php echo $selected; ?>><?php echo $obj->nama; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Periode</label>
                <div class="col-sm-9">
                    <select name="periode" class="form-control select2" style="width: 100%;" required>
                        <option value="pilih" selected disabled="disabled">- Pilih -</option>
                        <?php
                            for($x=2001; $x<=2099; $x++){ 
                                if ($x == $sql['periode']) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';                                    
                                }   
                         ?>
                            <option value="<?php echo $x; ?>" <?php echo $selected; ?>><?php echo $x; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal Penilaian</label>
                <div class="col-sm-9">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="tgl_penilaian" id="datepicker" value="<?php echo $sql['tgl_penilaian'] ?>" required>
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