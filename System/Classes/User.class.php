<?php
    class User {
        private static $table = "tbl_Usuario";
        private $ID;
        private $Name;
        private $LastName;
        private $Email;
        private $Password;
        private $Image;

        public function setID ($id) {
            $this->$ID = $id;
        }

        public function getID () {
            return $this->ID;
        }

        public function setName ($name) {
            $name = trim(preg_replace('/\s+/', " ", $name));
            $name = explode(" ", $name, 2);

            if($name[0] == null)
                return false;

            $this->Name     = $name[0];
            $this->LastName = $name[1];

            return true;
        }

        public function getFirstName () {
            return $this->Name;
        }

        public function getLastName () {
            return $this->LastName;
        }

        public function setEmail ($email) {
            $this->Email = $email;
        }

        public function getEmail () {
            return $this->Email;
        }

        public function setPassword ($password) {
            $this->Password = $password;
        }

        public function getPassword () {
            return $this->Password;
        }

        public function setImage ($file) {
            $this->Image = $file;
        }

        public function getImage () {
            return $this->Image;
        }

        public function INSERT($db) {
            $this->Image->INSERT_File($db);

            $values = array(
                'Nome'      => $this->getFirstName(),
                'Sobrenome' => $this->getLastName(),
                'Email'     => $this->getEmail(),
                'Senha'     => $this->getPassword(),
                'ID_Imagem' => $this->Image->getID()
            );

            $db->INSERT(self::$table, $values);
        }

        public function __construct ($email, $password, $Image) {
            $this->setEmail($email);
            $this->setPassword($password);
            $this->setImage($Image);
        }
    }
?>