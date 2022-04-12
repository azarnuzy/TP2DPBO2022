<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");

$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$divisi = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$jabatan =  new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_POST['submit'])) {
        if ($pengurus->updatePengurus($id, $_POST, $_FILES) > 0) {
            echo "
        <script>
            alert('Data berhasil diperbarui!');
            document.location.href = 'index.php';
        </script>
        ";
        } else {
            echo "
        <script>
            alert('Data gagal diperbarui!');
            document.location.href = 'index.php';
        </script>
        ";
        }
    }

    $pengurus->getDetail($id);
}

$data = null;
$no = 1;


while ($row = $pengurus->getResult()) {
    $data .= "<article class='explore-detail' tabindex='0'>
    <div class='img-container'>
      <img
        class='explore-item__thumbnail'
        src='./images/" . $row['foto'] . "'
        alt='" . $row['nama'] . "'
        tabindex='0'
      />
    </div>
    <ul class='detail-explore__info'>
      <li tabindex='0'>
        <span class='category'>" . $row['jabatan'] . "</span>
      </li>
      <li tabindex='0'>
        <strong>Nama        : </strong
        >" . $row['nama'] . "
      </li>
      <li tabindex='0'>
        <strong>NIM : </strong
        >" . $row['nim'] . "
      </li>
      <li tabindex='0'>
        <strong>Semester : </strong
        >" . $row['semester'] . "
      </li>
      <li tabindex='0'>
        <strong>Nama Divisi : </strong
        >" . $row['nama_divisi'] . "
      </li>
      <li tabindex='0' style='margin-top:10px'>  
            <a
            href='detail.php?id=" . $row['id_pengurus'] . "'
            class='action-btn' id='btn-update'
            >Update</a
            >
      </li>
    </ul>
    <div class='form-review'>
        <form autocomplete='on' action='' method='POST'class='formUpdate' style='display:none;' enctype='multipart/form-data'>
            <div class='mb-3'>
                <label for='tnama' class='form-label'>Nama</label>
                <input type='text' class='form-control' name='tnama' id='tnama' minlength='3' placeholder='Nama' value=" . $row['nama'] . " required>
            </div>
            <div class='mb-3'>
                <label for='tnim' class='form-label'>NIM</label>
                <input type='text' class='form-control' name='tnim' id='tnim' minlength='3' placeholder='NIM' value=" . $row['nim'] . " required>
            </div>
            <div class='mb-3'>
                <label for='tsemester' class='form-label'>Semester</label>
                <input type='number' class='form-control' name='tsemester' id='tsemester' placeholder='Semester' value=" . $row['semester'] . " required>
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
    </div>
  </article>";
}

$pengurus->close();
$tpl = new Template("templates/detail.html");
$tpl->replace("DataPengurus", $data);
$tpl->write();
