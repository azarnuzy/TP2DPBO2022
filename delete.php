<?php
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");
$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();
if ($_GET['id']) {
    $id = $_GET['id'];
    if ($pengurus->delete($id) > 0) {
        echo "
                <script>
                    alert('Data berhasil dihapus!');
                    document.location.href = 'index.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Data gagal dihapus!');
                    document.location.href = 'index.php';
                </script>
            ";
    }
}
