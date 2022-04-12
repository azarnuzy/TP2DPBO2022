<?php
include "Divisi.class.php";
class Jabatan extends Divisi
{
    function getJabatan()
    {
        $query = "SELECT * FROM jabatan;";
        return $this->execute($query);
    }

    function getJabatanDetail($id)
    {
        $query = "SELECT * FROM jabatan WHERE id_jabatan = '$id';";
        return $this->execute($query);
    }

    function addJabatan($data)
    {
        $jabatan = $data['tjabatan'];
        $query = "INSERT INTO jabatan VALUES ('', '$jabatan')";

        // Mengeksekusi query
        return $this->executeAffected($query);
    }

    function deleteJabatan($id)
    {

        $query = "DELETE FROM jabatan WHERE id_jabatan = '$id'";

        // Mengeksekusi query
        return $this->executeAffected($query);
    }

    function updateJabatan($id, $data)
    {
        $jabatan = $data['tjabatan'];
        $query = "UPDATE jabatan SET jabatan = '$jabatan' WHERE id_jabatan = '$id'";

        // Mengeksekusi query
        return $this->executeAffected($query);
    }
}
