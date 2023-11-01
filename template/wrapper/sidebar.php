<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../template/dist/img/administrator.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Hai, <?php echo $_SESSION['username'];?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="?menu=home"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i> <span>Master Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if ($_SESSION['level'] == "HRD") {?>
                    <li><a href="?menu=usr"><i class="fa fa-user"></i> Data User</a></li>                    
                    <?php }?>
                    <li><a href="?menu=kyw"><i class="fa fa-users"></i> Data Karyawan</a></li>
                    <!--li><a href="?menu=alt"><i class="fa fa-circle-o"></i> Data Alternatif</a></li-->
                    <li><a href="?menu=krt"><i class="fa fa-bar-chart"></i> Data Kriteria</a></li>
                    <!--li><a href="?menu=std"><i class="fa fa-circle-o"></i> Standar Kriteria</a></li-->
                    <li><a href="?menu=bbt"><i class="fa fa-plus-circle"></i> Bobot Kriteria</a></li>                 
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calculator"></i> <span>Analisa Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="?menu=pnl"><i class="fa fa-arrows-alt"></i> Matriks Penilaian</a></li>                    
                    <li><a href="?menu=nrm"><i class="fa fa-compress"></i> Matriks Normalisasi</a></li>
                    <li><a href="?menu=rkg"><i class="fa fa-line-chart"></i> Perankingan</a></li>
                </ul>
            </li>
            <?php if ($_SESSION['level'] == "Supervisor" or $_SESSION['level'] == "Manager") { ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clipboard"></i> <span>Laporan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="?menu=lap"><i class="fa fa-file-pdf-o"></i>Penilaian</a></li>                    
                </ul>
            </li>
            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
