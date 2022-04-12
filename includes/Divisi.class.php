<?php

class Divisi extends DB
{
    function getDivisi()
    {
        $query = "SELECT * FROM divisi";
        return $this->execute($query);
    }

    function getDivisiDetail($id)
    {
        $query = "SELECT * FROM divisi WHERE id_divisi = '$id'";
        return $this->execute($query);
    }

    function addDivisi($data)
    {
        $name = $data['tnamaDivisi'];

        $query = "INSERT INTO divisi VALUES ('', '$name')";

        // Mengeksekusi query
        return $this->executeAffected($query);
    }

    function deleteDivisi($id)
    {

        $query = "DELETE FROM divisi WHERE id_divisi = '$id'";

        // Mengeksekusi query
        return $this->executeAffected($query);
    }

    function updateDivisi($id, $data)
    {

        $nama_divisi = $data['tnamaDivisi'];
        $query = "UPDATE divisi SET nama_divisi = '$nama_divisi' WHERE id_divisi=$id";

        // Mengeksekusi query
        return $this->executeAffected($query);
    }
}
