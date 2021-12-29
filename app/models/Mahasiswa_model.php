<?php

class Mahasiswa_model {
    // private $mhs = [
    //     [
    //         "nama" => "Geraldi Akira Surya",
    //         "npm" => "6181801002",
    //         "email" => "geraldiakira@gmail.com",
    //         "jurusan" => "Teknik Informatika"
    //     ],
    //     [
    //         "nama" => "Juan",
    //         "npm" => "6181801001",
    //         "email" => "juan@gmail.com",
    //         "jurusan" => "Teknik Industri"
    //     ],
    //     [
    //         "nama" => "Obed",
    //         "npm" => "6181801003",
    //         "email" => "obed@gmail.com",
    //         "jurusan" => "Matematika"
    //     ]
    // ];

    private $table = 'mahasiswa';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllMahasiswa() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    } 

    public function getMahasiswaById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataMahasiswa($data) {
        $query = "INSERT into mahasiswa
        VALUES ('', :nama, :npm, :email, :jurusan)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('npm', $data['npm']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataMahasiswa($id) {
        $query = "DELETE from mahasiswa WHERE id=:id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}