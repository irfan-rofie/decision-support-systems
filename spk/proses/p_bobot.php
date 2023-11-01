<?php

include '../koneksi.php';
$act = $_GET['act'];
switch ($act) {
    case "save":
        $id_kriteria = $_POST['id_kriteria'];
        $bobot = $_POST['bobot'];
        foreach ($id_kriteria as $key => $id) {
//            echo "id : " . $id . "<br/>";
//            echo "key : " . $key . "<br/>";
//            echo "bobot : " . $bobot[$key] . "<br/>";
            $row = mysql_num_rows(mysql_query("SELECT * FROM t_bobot WHERE id_kriteria='" . $id . "'"));
            if ($row > 0) {
                mysql_query("UPDATE t_bobot SET bobot='" . $bobot[$key] . "' WHERE id_kriteria='" . $id . "'");
            } else {
                mysql_query("INSERT INTO t_bobot(id_kriteria,bobot) VALUES('" . $id . "','" . $bobot[$key] . "')");
            }
        }
        header("location:../../spk/index.php?menu=bbt&status=succes");
        break;
}
?>