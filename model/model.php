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

        public function getProfilePath(){
            include "../../includes/database.php";
            $stmt = $data->prepare("SELECT profilepath FROM user WHERE email = ?");
	        $stmt->bind_param("s", $this->email);
	        $stmt->execute();
            $result = $stmt->get_result();
            
            mysqli_close($data);
            return $result;
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

        function __construct($id, $judul, $kategori, $penulis, $tanggal, $path, $konten) {
            $this->id = $id;
            $this->judul = $judul;
            $this->kategori = $kategori;
            $this->penulis = $penulis;
            $this->tanggal = $tanggal;
            $this->path = $path;
            $this->konten = $konten;
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

        public function insertData() {
            include "../../includes/database.php";
            $stmt = $data->prepare("INSERT INTO post (judul, kategori, penulis, tanggalPublikasi, pictpath, isikonten) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $this->judul, $this->kategori, $this->penulis, $this->tanggal, $this->path, $this->konten);
            $stmt->execute();
            mysqli_close($data);
        }

        public function updateData() {
            include "../../includes/database.php";
            $stmt = $data->prepare("UPDATE post SET judul = ?, kategori = ?, penulis = ?, tanggalPublikasi = ?, pictpath = ?, isikonten = ? WHERE id = ?");
            $stmt->bind_param("sssssss", $this->judul, $this->kategori, $this->penulis, $this->tanggal, $this->path, $this->konten, $this->id);
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
        }

        public function tableData() {
            include "../../includes/database.php";
			$post = "SELECT * FROM post";
			$hasil = $data->query($post);

            return $hasil;
        }

        public function searchPostByQuery($search){
            include "../../includes/database.php";
			$post = "SELECT * FROM post WHERE judul LIKE '%$search%'";
			$hasil = $data->query($post);

            return $hasil;
        }

        public function getLatestPost($category) {
            include "../../includes/database.php";
            
            if($category !== null){
                $query= "SELECT * FROM post WHERE kategori = ? ORDER BY tanggalPublikasi DESC";
                $stmt = $data->prepare($query);
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $res = $stmt->get_result();
                mysqli_close($data);
            } else {
                $query= "SELECT * FROM post ORDER BY tanggalPublikasi DESC";
                $res = $data->query($query);
                mysqli_close($data);
            }
            return $res;
        }
    }

    class Komentar {
        private $emailUser;
        private $idPosting;
        private $komentar;
        private $tanggal;
        private $idComment;

        function __construct($emailUser, $idPosting, $komentar, $tanggal, $idComment) {
            $this->emailUser = $emailUser;
            $this->idPosting = $idPosting;
            $this->komentar = $komentar;
            $this->tanggal = $tanggal;
            $this->idComment = $idComment;
        }

        public function newComment() {
            include "../../includes/database.php";
            $stmt = $data->prepare("INSERT INTO komentar (idPosting, emailUser, komentar, tanggal) VALUES(?, ?, ?, ?)");
            $stmt->bind_param("isss", $this->idPosting, $this->emailUser, $this->komentar, $this->tanggal);
            $stmt->execute();
            mysqli_close($data);
        }
        
        public function getCommentsByPost(){
            include "../../includes/database.php";
            $query = "SELECT k.*, concat_ws(' ', u.firstname, u.lastname) as `fullName`, u.profilepath, (SELECT count(*) FROM likes l WHERE k.idKomentar = l.idKomentar GROUP BY k.idKomentar) AS `jumlahLike` FROM komentar k, `user` u WHERE k.emailUser = u.email AND k.idPosting = ? ORDER BY k.idKomentar DESC;";
            $stmt = $data->prepare($query);
            $stmt->bind_param("s", $this->idPosting);
            $stmt->execute();
            $hsl = $stmt->get_result();
            mysqli_close($data);
            return $hsl;
        }
    }

    class Likes {
        private $emailUser;
        private $idComment;

        function __construct($emailUser, $idComment) {
            $this->emailUser = $emailUser;
            $this->idComment = $idComment;
        }

        public function addLikes(){
            include "../../includes/database.php";
            $query= "INSERT INTO likes (emailUser, idKomentar) VALUES (?, ?)";
            $stmt = $data->prepare($query);
            $stmt->bind_param("ss", $this->emailUser, $this->idComment);
            $stmt->execute();
            mysqli_close($data);
        }

        public function searchForLike(){
            include "../../includes/database.php";
            $query= "SELECT * FROM likes WHERE emailUser = ?";
            $stmt = $data->prepare($query);
            $stmt->bind_param("s", $this->emailUser);
            $stmt->execute();
            $arrayLike = $stmt->get_result();
            mysqli_close($data);
            return $arrayLike;
        }

        public function deleteLikes() {
            include "../../includes/database.php";
            $stmt = $data->prepare("DELETE FROM LIKES WHERE emailUser = ? AND idKomentar = ?");
            $stmt->bind_param("ss", $this->emailUser, $this->idComment);
            $stmt->execute();
            mysqli_close($data);
        }
    }
?>