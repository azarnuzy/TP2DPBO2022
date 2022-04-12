<?php
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");
$divisi = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$divisi->open();
if ($_GET['id']) {
    $id = $_GET['id'];
    if ($divisi->deleteDivisi($id) > 0) {
        echo "
                <script>
                    alert('Data berhasil dihapus!');
                    document.location.href = 'divisi.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Data gagal dihapus!');
                    document.location.href = 'divisi.php';
                </script>
            ";
    }
}
