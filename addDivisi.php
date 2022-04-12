<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");

$divisi = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$divisi->open();

if (isset($_POST['submit'])) {
    if ($divisi->addDivisi($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambah!');
                document.location.href = 'divisi.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambah!');
                document.location.href = 'divisi.php';
            </script>
            ";
    }
}

$divisi->close();
