<?php
session_start();
if ($_SESSION['login'] == true) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <?php include '../template/wrapper/head.php'; ?>
        </head>
        <body class="hold-transition skin-blue sidebar-mini">
            <?php include '../template/wrapper/js.php'; ?>
            <div class="wrapper">
                <?php
                include '../template/wrapper/header.php';
                include '../template/wrapper/sidebar.php';
                include '../template/wrapper/content.php';
                include '../template/wrapper/footer.php';
                ?>
            </div>
        </body>
    </html>
    <?php
} else {
    header("location:../index.php");
}
?>