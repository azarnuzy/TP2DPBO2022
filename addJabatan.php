<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");

$jabatan = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$jabatan->open();

if (isset($_POST['submit'])) {
    if ($jabatan->addJabatan($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambah!');
                document.location.href = 'jabatan.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambah!');
                document.location.href = 'jabatan.php';
            </script>
            ";
    }
}

$jabatan->close();
