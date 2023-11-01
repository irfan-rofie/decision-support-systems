<!-- jQuery 3 -->
<script src="../template/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../template/bower_components/jquery/dist/highcharts.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="../template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- FastClick -->
<script src="../template/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../template/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="../template/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="../template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="../template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="../template/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--script src="../template/dist/js/pages/dashboard2.js"></script-->
<!-- AdminLTE for demo purposes -->
<script src="../template/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="../template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
        $('#example1').on('click', '.add, .edit', function () {
            var id = this.id;
            var url = '../spk/form/f_karyawan.php';
            $.post(url, {id: id}, function (data) {
                $(".modal-content").html(data).show();
            });
        });
        $('#example1').on('click', '.add-alt, .edit-alt', function () {
            var id = this.id;
            var url = '../spk/form/f_alternatif.php';
            $.post(url, {id: id}, function (data) {
                $(".modal-content").html(data).show();
            });
        });
        $('#example1').on('click', '.add-usr, .edit-usr', function () {
            var id = this.id;
            var url = '../spk/form/f_user.php';
            $.post(url, {id: id}, function (data) {
                $(".modal-content").html(data).show();
            });
        });        
        $('#example1').on('click', '.add-krt, .edit-krt', function () {
            var id = this.id;
            var url = '../spk/form/f_kriteria.php';
            $.post(url, {id: id}, function (data) {
                $(".modal-content").html(data).show();
            });
        });
        $('#example1').on('click', '.add-std, .edit-std', function () {
            var id = this.id;
            var url = '../spk/form/f_standar.php';
            $.post(url, {id: id}, function (data) {
                $(".modal-content").html(data).show();
            });
        });
        $('#example1').on('click', '.add-bbt', function () {
            var id = this.id;
            var url = '../spk/form/f_bobot.php';
            $.post(url, {id: id}, function (data) {
                $(".modal-content").html(data).show();
                calculates();
            });
        });
        $('#example1').on('click', '.add-pnl, .edit-pnl', function () {
            var id = this.id;
            var url = '../spk/form/f_nilai.php';
            $.post(url, {id: id}, function (data) {
                $(".modal-content").html(data).show();
            });
        });
    })
    function yes(ok) {
        if (confirm("Apa anda yakin akan menghapus data ini ?")) {
            location.href = ok;
        }
    }
    function hanyaAngka(e)
    {
        if (!/^[0-9]+$/.test(e.value)) {
            e.value = e.value.substring(0, e.value.length - 1);
        }
    }
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode;
        if (iKeyCode !== 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }
    function calculates() {
        var vrows = document.getElementsByName("bobot[]");
        var temp = parseInt(0);
        for (var x = 0; x < vrows.length; x++) {
            if (!isNaN(parseInt(vrows[x].value))) {
                temp += parseInt(vrows[x].value);
                document.getElementById('total').value = temp;
                if (parseInt(document.getElementById('total').value = temp) === 100) {
                    document.getElementById('btnSimpan').disabled = false;
                } else {
                    document.getElementById('btnSimpan').disabled = true;
                }
            }
        }
    }
</script>