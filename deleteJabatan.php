<?php
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");
$jabatan = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$jabatan->open();
if ($_GET['id']) {
    $id = $_GET['id'];
    if ($jabatan->deleteJabatan($id) > 0) {
        echo "
                <script>
                    alert('Data berhasil dihapus!');
                    document.location.href = 'jabatan.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Data gagal dihapus!');
                    document.location.href = 'jabatan.php';
                </script>
            ";
    }
}
