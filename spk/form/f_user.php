<?php
include '../koneksi.php';
$query = mysql_query("SELECT * FROM t_user WHERE user_id='" . $_POST['id'] . "'");
$row = mysql_num_rows($query);
if ($row > 0) {
    $sql = mysql_fetch_array($query);
    $title = 'Ubah Data User';
    $submit = 'Ubah';
    $act = 'update';
    $readonly = 'readonly';
} else {
    $sql['user_id'] = '';
    $sql['username'] = '';
    $sql['level'] = '';
    $title = 'Tambah Data User';
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
<form class="form-horizontal" method="post" action="proses/p_user.php?act=<?php echo $act; ?>">
    <input type="hidden" name="user_id" value="<?php echo $sql['user_id']; ?>">
    <div class="modal-body">
        <div class="box-body">            
            <div class="form-group">
                <label class="col-sm-3 control-label">Username</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control pull-right" name="username" value="<?php echo $sql['username'] ?>" required maxlength="10">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control pull-right" name="password" required maxlength="10">
                </div>
            </div>     
            <div class="form-group">
                <label class="col-sm-3 control-label">Level</label>
                <div class="col-sm-9">
                    <select name="level" class="form-control select2" style="width: 100%;" required>
                        <option value="pilih" selected disabled="disabled">- Pilih -</option>
                        <option value="0" <?php echo $sql['level'] == '0' ? 'selected' : ''; ?>>HRD</option>
                        <option value="1" <?php echo $sql['level'] == '1' ? 'selected' : ''; ?>>Supervisor</option>
                        <option value="2" <?php echo $sql['level'] == '2' ? 'selected' : ''; ?>>Manager</option>                                                
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
<script type="text/javascript">
    $(function () {
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
    })
</script>