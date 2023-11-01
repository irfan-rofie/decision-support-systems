<?php include '../spk/koneksi.php'; ?>
<script type="text/javascript">
    $(function () {
        var chart;
        $(document).ready(function () {
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'container1',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Persentase Bobot Kriteria'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                    percentageDecimals: 2
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#8B0000',
                            connectorColor: '#8B0000',
                            formatter: function () {
                                return '<b>' + this.point.name + '</b>: ' + this.percentage.toFixed(2) + ' %';
                            }
                        },
                        showInLegend: true
                    }
                },
                series: [
                    {
                        type: 'pie',
                        name: 'Persentase Bobot',
                        data:
                                [
                                    <?php                                    
                                    $data = mysql_query("SELECT k.nama,t.bobot FROM t_kriteria k "
                                                . "left join t_bobot t on k.id_kriteria=t.id_kriteria "
                                                . "where k.status='Y'");
                                    while ($row = mysql_fetch_array($data)) { ?>
                                    ["<?php echo $row['nama']; ?>",<?php echo $row['bobot']; ?>],
                                    <?php } ?>
                                ]
                    }
                ]
            });
        });
    });

    var chart1; // globally available
    $(document).ready(function () {
        chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Grafik Perankingan'
            },
            xAxis: {
                categories: ['Alternatif']
            },
            yAxis: {
                title: {
                    text: 'Ranking'
                }
            },
            series:
                    [
                        <?php
                        $data = mysql_query("SELECT k.* FROM t_karyawan k, t_nilai n "
                                    . "WHERE k.nik = n.nik and k.status='Y' and n.status='Y' "
                                    . "GROUP BY n.nik ORDER BY k.nama");
                        while ($row = mysql_fetch_array($data)) { 
                            $y = mysql_query("select n.*,s.*,k.* from t_nilai n, t_standar s, t_kriteria k "
                                            . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria and "
                                            . "n.nik='" . $row['nik'] . "' and n.status='Y' and s.status='Y' and k.status='Y' "
                                            . "order by k.nama");
                            $ranking = 0;
                            while ($yy = mysql_fetch_array($y)) {
                                        if ($yy['atribut'] == 'C') {
                                            $m = mysql_query("select min(s.nilai) as nilai from t_nilai n, t_standar s, t_kriteria k "
                                                    . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                                                    . "and n.status='Y' and s.status='Y' and k.status='Y' "
                                                    . "and n.id_kriteria='" . $yy['id_kriteria'] . "'");
                                            $min = mysql_fetch_array($m);
                                            $val = $min['nilai'] / $yy['nilai'];
                                        } else {
                                            $m = mysql_query("select max(s.nilai) as nilai from t_nilai n, t_standar s, t_kriteria k "
                                                    . "where n.id_standar=s.id_standar and n.id_kriteria=k.id_kriteria "
                                                    . "and n.status='Y' and s.status='Y' and k.status='Y' "
                                                    . "and n.id_kriteria='" . $yy['id_kriteria'] . "'");
                                            $max = mysql_fetch_array($m);
                                            $val = $yy['nilai'] / $max['nilai'];
                                        }
                                        $cx = mysql_query("select * from t_bobot where id_kriteria = '" . $yy['id_kriteria'] . "'");
                                        $bot = mysql_fetch_array($cx);
                                        $ranking = $ranking + (($bot['bobot'] / 100) * $val);
                                    }
                            ?>
                        {
                            name: '<?php echo $row['nama']; ?>',
                            data: [<?php echo $ranking; ?>]
                        },
                        <?php } ?>
                    ]
        });
    });
</script>
<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Beranda
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <?php 
                        $c = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT nik) as j FROM t_nilai WHERE status='Y' "));
                    ?>
                    <h3><?php echo $c['j'];?></h3>
                    <p>Penilaian</p>
                </div>
                <div class="icon">
                    <i class="ion ion-archive"></i>
                </div>
                <a href="?menu=pnl" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <?php 
                        $c1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) as k FROM t_kriteria WHERE status='Y' "));
                    ?>
                    <h3><?php echo $c1['k'];?></h3>
                    <p>Kriteria</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="?menu=krt" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <?php 
                        $c2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) as l FROM t_karyawan WHERE status='Y' "));
                    ?>                    
                    <h3><?php echo $c2['l'];?></h3>
                    <p>Karyawan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="?menu=kyw" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <?php 
                        $c5 = mysql_fetch_array(mysql_query("SELECT COUNT(*) as m FROM t_user WHERE aktif='Y' "));
                    ?>                    
                    <h3><?php echo $c5['m'];?></h3>
                    <p>User</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="<?php echo $_SESSION['level'] == "HRD" ? "?menu=usr" : "#"?>" class="small-box-footer">Detail<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Rekap Penilaian Kinerja Karyawan Dengan Metode <i>Simple Additive Weighting </i>(SAW)</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                        <div class="col-lg-6">
                            <div class="chart">
                                <div id="container" style="height: 400px;"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="chart">
                                <div id="container1" style="height: 400px;"></div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
