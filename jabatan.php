<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");

$jabatan = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$jabatan->open();

$data = null;
$no = 1;

$jabatan->getJabatan();

while ($row = $jabatan->getResult()) {
    $data .= "
        <tr>
            <th scope='row'>" . $no . "</th>
            <td>" . $row['jabatan'] . "</td>
            <td style='font-size: 22px;'>
                <a href='updateJabatan.php?id=" . $row['id_jabatan'] . "' title='Edit Data'><i class='bi bi-pencil-square text-warning updateJabatan'></i></a>&nbsp;<a href='deleteJabatan.php?id=" . $row['id_jabatan'] . "' title='Delete Data' onclick='return confirm('Delete book?')'><i class='bi bi-trash-fill text-danger'></i></a>
            </td>
        </tr>";
    $no++;
}
$form = null;
$form .= "<div class='form-review form-add'>
<h3>Tambah Jabatan</h3>
<form autocomplete='on' action='addJabatan.php' method='POST' class='formAdd' enctype='multipart/form-data'>
    <div class='mb-3'>
        <label for='tjabatan' class='form-label'>Nama Jabatan</label>
        <input type='text' class='form-control' name='tjabatan' id='tjabatan' minlength='3' placeholder='Nama Jabatan' required>
    </div>
    <button id='submit-review' type='submit' class='submit-btn' name='submit' style='float: right;'>Tambah</button>
</form>
</div>";
$jabatan->close();
$tpl = new Template("templates/jabatan.html");
$tpl->replace("DaftarJabatan", $data);
$tpl->replace('FormJabatan', $form);
$tpl->write();
