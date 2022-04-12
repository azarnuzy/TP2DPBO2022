<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");

$jabatan = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$detailJabatan = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$jabatan->open();
$detailJabatan->open();
$data = null;
$form = null;
$no = 1;

$rowJabatan;
$jabatan->getJabatan();
$tpl = new Template("templates/jabatan.html");

while ($row = $jabatan->getResult()) {
    $data .= "
        <tr>
            <th scope='row'>" . $no . "</th>
            <td>" . $row['jabatan'] . "</td>
            <td style='font-size: 22px;'>
                <a href='updateJabatan.php?id=" . $row['id_jabatan'] . "' title='Edit Data'><i class='bi bi-pencil-square text-warning updateJabatan'></i></a>&nbsp;<a href='deleteJabatan.php?id='" . $row['id_jabatan'] . "' title='Delete Data' onclick='return confirm('Delete book?')'><i class='bi bi-trash-fill text-danger'></i></a>
            </td>
        </tr>";
    $no++;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($detailJabatan->updateJabatan($id, $_POST) > 0) {
                echo "
            <script>
                alert('Data berhasil diperbarui!');
                document.location.href = 'jabatan.php';
            </script>
            ";
            } else {
                echo "
                <script>
                alert('Data gagal diperbarui!');
                document.location.href = 'jabatan.php';
                </script>
                ";
            }
        }
        $detailJabatan->getJabatanDetail($id);

        while ($rowJabatan = $detailJabatan->getResult()) {
            $form .= "
                    <div class='form-review form-add'>
                    <h3>Update Jabatan</h3>
                    <form autocomplete='on' action='' method='POST' class='formAdd' enctype='multipart/form-data'>
                        <div class='mb-3'>
                            <label for='tjabatan' class='form-label'>Nama Jabatan</label>
                            <input type='text' class='form-control' name='tjabatan' id='tjabatan' minlength='3' placeholder='Nama Jabatan' value='" . $rowJabatan['jabatan'] . "' required>
                        </div>
                        <button id='submit-review' type='submit' class='submit-btn' name='submit' style='float: right;'>Update</button>
                    </form>
                    </div>
                    ";
        }
        $tpl->replace('FormJabatan', $form);
    }
} else {
}





$jabatan->close();
$detailJabatan->close();

$tpl->replace("DaftarJabatan", $data);

$tpl->write();
