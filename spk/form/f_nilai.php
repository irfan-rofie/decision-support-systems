<?php
include '../koneksi.php';
$nik = $_POST['id'];
$a = mysql_query("SELECT * FROM t_nilai WHERE nik='" . $nik . "'");
$nr = mysql_num_rows($a);
if ($nr > 0) {
    $title = "Ubah ";
    $disabled = "disabled";
    $act = "update";
} else {
    $title = "Tambah ";
    $disabled = "";
    $act = "save";
}
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?php echo $title; ?>Penilaian Karyawan</h4>
</div>
<form class="form-horizontal" method="post" action="proses/p_nilai.php?act=<?php echo $act; ?>">
    <input type="hidden" name="nik_" value="<?php echo $nik; ?>">
    <div class="modal-body">
        <div class="box-body">
            <div class="form-group">
                <label class="col-xs-4 control-label">Nama Karyawan</label>
                <div class="col-xs-8">
                    <select name="nik" class="form-control select2" style="width: 100%;"
                            required <?php echo $disabled; ?>>                        
                                <?php if ($nik == 0) { ?>
                            <option value="pilih" selected disabled="disabled">- Pilih -</option>
                            <?php
                            $x = mysql_query("select * from t_karyawan where status='Y' and nik not in(select nik from t_nilai where status='Y')");
                        } else {
                            $x = mysql_query("select * from t_karyawan where status='Y' and nik='" . $nik . "'");
                        }
                        while ($obj = mysql_fetch_object($x)) {
                            ?>
                            <option value="<?php echo $obj->nik; ?>"><?php echo $obj->nama; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>            
            <div class="form-group">  
                <label class="col-xs-4 control-label"></label>
                <label class="col-lg-4"><span class="label label-success">KRITERIA PENILAIAN</span></label>                  
            </div>                            
            <?php
            $query = mysql_query("SELECT * FROM t_kriteria where status='Y'");
            while ($row = mysql_fetch_array($query)) {
                ?>
                <div class="form-group">
                    <input type="hidden" name="id_kriteria[]" value="<?php echo $row['id_kriteria']; ?>">
                    <label class="col-xs-4 control-label"><?php echo $row['nama']; ?></label>
                    <div class="col-xs-8">
                        <select name="id_standar[]" class="form-control select2" style="width: 100%;" required>
                            <option value="pilih" selected disabled="disabled">- Nilai -</option>
                            <?php
                            if ($nik != 0) {
                                $c = mysql_query("select * from t_nilai where nik='" . $nik . "' and id_kriteria='" . $row['id_kriteria'] . "'");
                                $cc = mysql_fetch_array($c);
                                $std = $cc['id_standar'];
                            }
                            $x = mysql_query("select * from t_standar where status='Y'");
                            while ($obj = mysql_fetch_object($x)) {
                                if ($obj->id_standar == $std) {
                                    $sel = "selected";
                                } else {
                                    $sel = "";
                                }
                                ?>
                                <option value="<?php echo $obj->id_standar; ?>" <?php echo $sel; ?>><?php echo $obj->nilai; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            <?php } ?>            
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default pull-right-container" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>