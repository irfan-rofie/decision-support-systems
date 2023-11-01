<?php
include '../koneksi.php';
$query = mysql_query("SELECT k.id_kriteria,k.nama,t.bobot FROM t_kriteria k left join t_bobot t on k.id_kriteria=t.id_kriteria where k.status='Y'");
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Atur Bobot Kriteria</h4>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Silahkan isi bobot sesuai keinginan anda, total bobot maximal 100%
    </div>
</div>
<form class="form-horizontal" method="post" action="proses/p_bobot.php?act=save">;
    <div class="modal-body">
        <div class="box-body">
            <?php while ($row = mysql_fetch_array($query)) { ?>
                <div class="form-group">
                    <label class="col-xs-4 control-label"><?php echo $row['nama']; ?></label>
                    <div class="col-xs-8">
                        <div class="input-group">
                            <input type="hidden" name="id_kriteria[]" value="<?php echo $row['id_kriteria']; ?>">                            
                            <input type="text" class="form-control pull-right input-sm" name="bobot[]" 
                                   value="<?php echo $row['bobot']; ?>" required maxlength="2" 
                                   onkeypress="javascript:return isNumber(event)" 
                                   oninput="calculates();">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>            
            <?php } ?>
            <div class="form-group">
                <label class="col-xs-4 control-label">Total</label>
                <div class="col-xs-8">
                    <div class="input-group">
                        <input type="text" class="form-control pull-right input-sm" name="total" id="total" disabled maxlength="50">
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default pull-right-container" data-dismiss="modal">Tutup</button>
        <button id="btnSimpan" type="submit" class="btn btn-primary" disabled>Simpan</button>
    </div>
</form>