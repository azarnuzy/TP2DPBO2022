<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");

$divisi = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$detailDivisi = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$divisi->open();
$detailDivisi->open();
$data = null;
$form = null;
$no = 1;

$rowDetail;
$divisi->getDivisi();
$tpl = new Template("templates/divisi.html");

while ($row = $divisi->getResult()) {
    $data .= "
        <tr>
            <th scope='row'>" . $no . "</th>
            <td>" . $row['nama_divisi'] . "</td>
            <td style='font-size: 22px;'>
                <a href='updateDivisi.php?id=" . $row['id_divisi'] . "' title='Edit Data'><i class='bi bi-pencil-square text-warning updateDivisi'></i></a>&nbsp;<a href='deleteDivisi.php?id='" . $row['id_divisi'] . "' title='Delete Data' onclick='return confirm('Delete book?')'><i class='bi bi-trash-fill text-danger'></i></a>
            </td>
        </tr>";
    $no++;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($detailDivisi->updateDivisi($id, $_POST) > 0) {
                echo "
            <script>
                alert('Data berhasil diperbarui!');
                document.location.href = 'divisi.php';
            </script>
            ";
            } else {
                echo "
                <script>
                alert('Data gagal diperbarui!');
                document.location.href = 'divisi.php';
                </script>
                ";
            }
        }
        $detailDivisi->getDivisiDetail($id);

        while ($rowDetail = $detailDivisi->getResult()) {
            $form .= "
                    <div class='form-review form-add'>
                    <h3>Update Divisi</h3>
                    <form autocomplete='on' action='' method='POST' class='formAdd' enctype='multipart/form-data'>
                        <div class='mb-3'>
                            <label for='tnamaDivisi' class='form-label'>Nama Divisi</label>
                            <input type='text' class='form-control' name='tnamaDivisi' id='tnamaDivisi' minlength='3' placeholder='Nama Divisi' value='" . $rowDetail['nama_divisi'] . "' required>
                        </div>
                        <button id='submit-review' type='submit' class='submit-btn' name='submit' style='float: right;'>Update</button>
                    </form>
                    </div>
                    ";
        }
        $tpl->replace('FormDivisi', $form);
    }
} else {
}





$divisi->close();
$detailDivisi->close();

$tpl->replace("DaftarDivisi", $data);

$tpl->write();
