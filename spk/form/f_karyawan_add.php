<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Tambah Data Karyawan</h4>
</div>
<form class="form-horizontal" method="post" action="proses/p_karyawan.php?act=save">
    <div class="modal-body">
        <div class="box-body">
            <div class="form-group">
                <label for="nik" class="col-sm-3 control-label">NIK</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" required maxlength="15">
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Nama Karyawan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Karyawan" required maxlength="50">
                </div>
            </div>
            <div class="form-group">
                <label for="jabatan" class="col-sm-3 control-label">Jabatan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" required maxlength="50">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal Masuk</label>
                <div class="col-sm-9">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="tgl_masuk" id="datepicker" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default pull-right-container" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>