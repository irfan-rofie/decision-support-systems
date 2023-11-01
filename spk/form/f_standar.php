<?php
include '../koneksi.php';
$query = mysql_query("SELECT a.* FROM t_standar a WHERE a.id_standar='" . $_POST['id'] . "'");
$row = mysql_num_rows($query);
if ($row > 0) {
    $sql = mysql_fetch_array($query);
    $title = 'Ubah Standar Kriteria';
    $submit = 'Ubah';
    $act = 'update';
    $readonly = 'readonly';
} else {
    $sql['id_standar'] = '';    
    $sql['id_kriteria'] = '';
    $sql['standar'] = '';
    $sql['nilai'] = '';    
    $title = 'Tambah Standar Kriteria';
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
<form class="form-horizontal" method="post" action="proses/p_standar.php?act=<?php echo $act; ?>">
    <div class="modal-body">
        <div class="box-body">
            <input type="hidden" name="id_standar" value="<?php echo $sql['id_standar'];?>">
            <div class="form-group">
                <label class="col-sm-3 control-label">Standar</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control pull-right" name="standar" value="<?php echo $sql['standar'] ?>" required maxlength="50" required>
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-3 control-label">Nilai</label>
                <div class="col-sm-9">
                    <select name="nilai" class="form-control select2" style="width: 100%;" required>
                        <option value="pilih" selected disabled="disabled">- Pilih -</option>
                        <option value="5" <?php echo $sql['nilai'] == 5 ? 'selected' : '';?>>5</option>
                        <option value="4" <?php echo $sql['nilai'] == 4 ? 'selected' : '';?>>4</option>
                        <option value="3" <?php echo $sql['nilai'] == 3 ? 'selected' : '';?>>3</option>
                        <option value="2" <?php echo $sql['nilai'] == 2 ? 'selected' : '';?>>2</option>
                        <option value="1" <?php echo $sql['nilai'] == 1 ? 'selected' : '';?>>1</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default pull-right-container" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary"><?php echo $submit; ?></button>
    </div>
</form>