<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");

$divisi = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$divisi->open();

$data = null;
$no = 1;

$divisi->getDivisi();

while ($row = $divisi->getResult()) {
    $data .= "
        <tr>
            <th scope='row'>" . $no . "</th>
            <td>" . $row['nama_divisi'] . "</td>
            <td style='font-size: 22px;'>
                <a href='updateDivisi.php?id=" . $row['id_divisi'] . "' title='Edit Data'><i class='bi bi-pencil-square text-warning updateDivisi'></i></a>&nbsp;<a href='deleteDivisi.php?id=" . $row['id_divisi'] . "' title='Delete Data' onclick='return confirm('Delete book?')'><i class='bi bi-trash-fill text-danger'></i></a>
            </td>
        </tr>";
    $no++;
}
$form = null;
$form .= "<div class='form-review form-add'>
<h3>Tambah Divisi</h3>
<form autocomplete='on' action='addDivisi.php' method='POST' class='formAdd' enctype='multipart/form-data'>
    <div class='mb-3'>
        <label for='tnamaDivisi' class='form-label'>Nama Divisi</label>
        <input type='text' class='form-control' name='tnamaDivisi' id='tnamaDivisi' minlength='3' placeholder='Nama Divisi' required>
    </div>
    <button id='submit-review' type='submit' class='submit-btn' name='submit' style='float: right;'>Tambah</button>
</form>
</div>";
$divisi->close();
$tpl = new Template("templates/divisi.html");
$tpl->replace("DaftarDivisi", $data);
$tpl->replace('FormDivisi', $form);
$tpl->write();
