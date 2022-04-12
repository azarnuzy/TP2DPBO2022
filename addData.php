<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");

$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();

if (isset($_POST['submit'])) {
    if ($pengurus->insertData($_POST, $_FILES) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambah!');
            </script>
            ";
    }
}

$divisi = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$jabatan =  new Pengurus($db_host, $db_user, $db_pass, $db_name);
$divisi->open();
$jabatan->open();
$divisi->getDivisi();
$jabatan->getJabatan();
$rowDiv = [];
$rowJabatan = [];
while ($row = $divisi->getResult()) {
    $rowDiv[] = $row;
}
while ($row = $jabatan->getResult()) {
    $rowJabatan[] = $row;
}

$data = null;

$data .= "<div class='form-review mt-4 mb-4'>
<form autocomplete='on' action='' method='POST'class='formUpdate' enctype='multipart/form-data'>
    <div class='mb-3'>
        <label for='tnama' class='form-label'>Nama</label>
        <input type='text' class='form-control' name='tnama' id='tnama' minlength='3' placeholder='Nama' required>
    </div>
    <div class='mb-3'>
        <label for='tnim' class='form-label'>NIM</label>
        <input type='text' class='form-control' name='tnim' id='tnim' minlength='3' placeholder='NIM' required>
    </div>
    <div class='mb-3'>
        <label for='tsemester' class='form-label'>Semester</label>
        <input type='number' class='form-control' name='tsemester' id='tsemester' placeholder='Semester' required>
    </div>
    <div class='mb-3'>
      <label for='tfoto' class='form-label'>Foto</label>
      <input class='form-control' type='file' id='tfoto' name='tfoto' required />
    </div>
    <div class='mb-3'>
        <label for='tdivisi' class='form-label'>Divisi</label>
        <select name='tdivisi' id='tdivisi' class='form-control'>
        ";
foreach ($rowDiv as $div) :
    $data .= "<option value='" . $div['id_divisi'] . "'>" . $div['nama_divisi'] . "</option>";
endforeach;
$data .= "</select>
    </div>
    <div class='mb-3'>
        <label for='tjabatan' class='form-label'>Jabatan</label>
        <select name='tjabatan' id='tjabatan' class='form-control'>
        ";
foreach ($rowJabatan as $div) :
    $data .= "<option value='" . $div['id_jabatan'] . "'>" . $div['jabatan'] . "</option>";
endforeach;
$data .= "
        </select>
    </div>
    <button id='submit-review' type='submit' class='submit-btn' name='submit'>Submit</button>
</form>
</div>";




$divisi->close();
$jabatan->close();
$tpl = new Template("templates/addData.html");
$tpl->replace("FORM_TAMBAH_DATA", $data);
$tpl->write();
