<?php
include "Jabatan.class.php";
class Pengurus extends Jabatan
{
    function getPengurus()
    {
        $query = "SELECT * FROM pengurus JOIN jabatan ON pengurus.id_jabatan
                    = jabatan.id_jabatan";
        return $this->execute($query);
    }

    function getDetail($id)
    {
        $query = "SELECT * FROM pengurus JOIN jabatan ON pengurus.id_jabatan
        = jabatan.id_jabatan JOIN divisi ON pengurus.id_divisi = divisi.id_divisi
        WHERE id_pengurus = '$id'";
        return $this->execute($query);
    }

    function insertData($data, $file)
    {
        $nim = $data['tnim'];
        $nama = $data['tnama'];
        $semester = $data['tsemester'];
        $fileName = $file['tfoto']['name'];
        $tempname = $file['tfoto']['tmp_name'];
        $folder = "images/" . $fileName;
        if (move_uploaded_file($tempname, $folder)) {
            $fileName = $file['tfoto']['name'];
        } else {
            $fileName = 'noPhoto.png';
        }
        $id_divisi = $data['tdivisi'];
        $id_jabatan = $data['tjabatan'];
        $query = "INSERT INTO pengurus VALUES ('', '$nim', '$nama', $semester,'$fileName', $id_jabatan, $id_divisi)";

        // Mengeksekusi query
        return $this->executeAffected($query);
    }

    function delete($id)
    {

        $query = "DELETE FROM pengurus WHERE id_pengurus = '$id'";

        // Mengeksekusi query
        return $this->executeAffected($query);
    }

    function updatePengurus($id, $data, $file)
    {
        $nim = $data['tnim'];
        $nama = $data['tnama'];
        $semester = $data['tsemester'];
        $fileName = $file['tfoto']['name'];
        $tempname = $file['tfoto']['tmp_name'];
        $folder = "images/" . $fileName;
        if (move_uploaded_file($tempname, $folder)) {
            $fileName = $file['tfoto']['name'];
        } else {
            $fileName = 'noPhoto.png';
        }
        $id_divisi = $data['tdivisi'];
        $id_jabatan = $data['tjabatan'];
        $query = "UPDATE pengurus SET nim = '$nim',nama = '$nama',semester = $semester,foto = '$fileName', id_jabatan = $id_jabatan, id_divisi = $id_divisi WHERE id_pengurus ='$id';";

        // Mengeksekusi query
        return $this->executeAffected($query);
    }
}
