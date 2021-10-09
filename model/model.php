<?php

    require_once "../../includes/database.php";
    class User {
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $birthdate;
        private $gender;
        private $path;
        private $level;

        function __construct($FNAME, $LNAME, $EMAIL, $PASS, $BDATE, $GENDER, $PATH, $LEVEL) {
            $this->firstname = $FNAME;
            $this->lastname = $LNAME;
            $this->email = $EMAIL;
            $this->password = $PASS;
            $this->birthdate = $BDATE;
            $this->gender = $GENDER;
            $this->path = $PATH;
            $this->level = $LEVEL;
        }
        public function getFname() {
            return $this->firstname;
        }
        public function getLname() {
            return $this->lastname;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getPass() {
            return $this->password;
        }
        public function getPath() {
            return $this->path;
        }
        public function getLevel() {
            return $this->level;
        }
        public function getData() {
            include "../../includes/database.php";
            $stmt = $data->prepare("SELECT * FROM user WHERE email = ?");
	        $stmt->bind_param("s", $this->email);
	        $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }
        public function insertData() {
            include "../../includes/database.php";
            $stmt = $data->prepare("INSERT INTO user (firstname, lastname, email, pass, birthdate, gender, profilepath, lv) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $this->firstname, $this->lastname, $this->email, $this->password, $this->birthdate, $this->gender, $this->path, $this->level);
            $isSuccess = $stmt->execute();
            mysqli_close($data);
            return $isSuccess;
        } 
    }

    class Posting {
        private $id;
        private $judul;
        private $kategori;
        private $penulis;
        private $tanggal;
        private $path;
        private $konten;
        private $likecount;

        function __construct($id, $judul, $kategori, $penulis, $tanggal, $path, $konten, $likecount) {
            $this->id = $id;
            $this->judul = $judul;
            $this->kategori = $kategori;
            $this->penulis = $penulis;
            $this->tanggal = $tanggal;
            $this->path = $path;
            $this->konten = $konten;
            $this->likecount = $likecount;
        }
        
        public function getId() {
            return $this->id;
        }
        public function getJudul() {
            return $this->judul;
        }
        public function getKategori() {
            return $this->kategori;
        }
        public function getPenulis() {
            return $this->penulis;
        }
        public function getTanggal() {
            return $this->tanggal;
        }
        public function getPath() {
            return $this->path;
        }
        public function getKonten() {
            return $this->konten;
        }
        public function getLike() {
            return $this->likecount;
        }

        public function insertData() {
            include "../../includes/database.php";
            $stmt = $data->prepare("INSERT INTO post (judul, kategori, penulis, tanggalPublikasi, pictpath, isikonten) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $this->judul, $this->kategori, $this->penulis, $this->tanggal, $this->path, $this->konten);
            $stmt->execute();
            mysqli_close($data);
        }

        public function updateData() {
            include "../../includes/database.php";
            $stmt = $data->prepare("UPDATE post SET id = ?, judul = ?, kategori = ?, penulis = ?, tanggalPublikasi = ?, pictpath = ?, isikonten = ?, jumlahlike WHERE id = ?");
            $stmt->bind_param("sssssssis", $this->id, $this->judul, $this->kategori, $this->penulis, $this->tanggal, $this->path, $this->konten, $this->likecount, $this->id);
            $stmt->execute();
            mysqli_close($data);
        }

        public function deleteData() {
            include "../../includes/database.php";
            $stmt = $data->prepare("DELETE FROM post WHERE id=?");
            $stmt->bind_param("s", $this->id);
            $stmt->execute();
            mysqli_close($data);
        }

        public function searchData() {
            include "../../includes/database.php";
            $stmt = $data->prepare("SELECT * FROM post WHERE id = ?");
		    $stmt->bind_param("s", $this->id);
		    $stmt->execute();
            $result = $stmt->get_result();
		    $row = $result->fetch_array();
		    $this->judul = $row['judul'];
		    $this->kategori = $row['kategori'];
		    $this->penulis = $row['penulis'];
            $this->tanggal = $row['tanggalPublikasi'];
            $this->path = $row['pictpath'];
            $this->konten = $row['isikonten'];
            $this->likecount = $row['jumlahlike'];
        }

        public function tableData() {
            include "../../includes/database.php";
			$post = "SELECT * FROM post";
			$hasil = $data->query($post);

            return $hasil;
        }

        public function latestKiri() {
            include "../../includes/database.php";
			$post = "SELECT * FROM post ORDER BY tanggalPublikasi DESC LIMIT 3";
            $hasil = $data->query($post);

            return $hasil;
        }

        public function latestKanan() {
            include "../../includes/database.php";
			$post = "SELECT * FROM post ORDER BY tanggalPublikasi DESC LIMIT 3,10";
            $hasil = $data->query($post);

            return $hasil;
        }
    }

    class Komentar {
        private $emailUser;
        private $idPosting;
        private $komentar;
        private $tanggal;

        function __construct($emailUser, $idPosting, $komentar, $tanggal) {
            $this->emailUser = $emailUser;
            $this->idPosting = $idPosting;
            $this->komentar = $komentar;
            $this->tanggal = $tanggal;
        }
    }
?>