<?php
include '../koneksi.php';
$query = mysql_query("SELECT a.* FROM t_kriteria a WHERE a.id_kriteria='" . $_POST['id'] . "'");
$row = mysql_num_rows($query);
if ($row > 0) {
    $sql = mysql_fetch_array($query);
    $title = 'Ubah Data Kriteria';
    $submit = 'Ubah';
    $act = 'update';
    $readonly = 'readonly';
} else {
    $sql['nama'] = '';
    $sql['atribut'] = '';
    $title = 'Tambah Data Kriteria';
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
<form class="form-horizontal" method="post" action="proses/p_kriteria.php?act=<?php echo $act; ?>">
    <div class="modal-body">
        <div class="box-body">
            <input type="hidden" name="id_kriteria" value="<?php echo $sql['id_kriteria'];?>">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Kriteria</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control pull-right" name="nama" value="<?php echo $sql['nama'] ?>" required maxlength="50">
                </div>
            </div>            
            <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Attribut</label>
                <div class="col-sm-9">
                    <select name="atribut" class="form-control select2" style="width: 100%;" required>
                        <option value="pilih" selected disabled="disabled">- Pilih -</option>
                        <option value="C" <?php echo $sql['atribut'] == 'C' ? 'selected' : '';?>>Cost (Biaya)</option>
                        <option value="B" <?php echo $sql['atribut'] == 'B' ? 'selected' : '';?>>Benefit (Keuntungan)</option>                        
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