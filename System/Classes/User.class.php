<?php
    class User {
        private static $table = "tbl_Usuario";
        private $ID;
        private $Name;
        private $LastName = '';
        private $Email;
        private $Password;
        private $RecSenhaToken;
        private $Image;
        private $ADM = 0;

        public function setID ($id) {
            $this->ID = $id;
        }

        public function getID () {
            return $this->ID;
        }

        public function setName ($name) {
            $name = utf8_encode(trim(preg_replace('/\s+/', " ", $name)));
            $name = explode(" ", $name, 2);

            if($name[0] == null)
                return false;

            $this->Name = $name[0];

            if(isset($name[1]))
                $this->LastName = $name[1];

            return true;
        }

        public function getName () {
            return utf8_decode($this->Name . " " . $this->LastName);
        }

        public function getFirstName () {
            return utf8_decode($this->Name);
        }

        public function getLastName () {
            return utf8_decode($this->LastName);
        }

        public function setEmail ($email) {
            $this->Email = utf8_encode($email);
        }

        public function getEmail () {
            return utf8_decode($this->Email);
        }

        public function setPassword ($password) {
            $this->Password = utf8_encode($password);
        }

        public function getPassword () {
            return utf8_decode($this->Password);
        }

        public function setRecSenha ($hash) {
            $this->RecSenhaToken = utf8_encode($hash);
        }

        public function getRecSenha () {
            return $this->RecSenhaToken;
        }

        public function setImage ($file) {
            $this->Image = $file;
        }

        public function getImage () {
            return $this->Image;
        }

        public function getADM () {
            return $this->ADM;
        }

        public function setADM ($adm) {
            $this->ADM = $adm;
        }

        public function INSERT($db) {
            if(isset($this->Image))
                $this->Image->INSERT_File($db);

            $values = array(
                'Nome'      => $this->getFirstName(),
                'Sobrenome' => $this->getLastName(),
                'Email'     => $this->getEmail(),
                'Senha'     => $this->getPassword(),
                'ADM'       => $this->getADM()
            );

            if(isset($this->Image))
                $values['ID_Imagem'] = $this->Image->getID();

            $this->setID($db->INSERT(self::$table, $values));
        }

        public static function getUsers ($db, $WHERE) {
            $query = "SELECT U.ID, U.Nome, Sobrenome, Email, Senha, ADM, ID_Imagem, I.Nome AS Imagem "
            . "FROM " . self::$table . " U "
            . "LEFT JOIN tbl_Imagem I "
            . " ON U.ID_Imagem = I.ID "
            . $WHERE;

            $Users = array();
            $rows = $db->SELECT($query);

            foreach ($rows as $row) {
                $User = new User();
                $Image = new File();
                
                if($row['ADM'] == 1)
                    $User->setADM(true);
                if($row['Imagem'] == null)
                    $Image->setName('user_pad.png');
                else {
                    $Image->setID($row['ID_Imagem']);
                    $Image->setName($row['Imagem']); // imagem retorna nome.extensão
                }

                $User->setEmail($row['Email']);
                $User->setPassword($row['Senha']);
                $User->setID($row['ID']);
                $User->setName($row['Nome'] . " " . $row['Sobrenome']);
                $User->setImage($Image);

                $Users[] = $User;
            }

            return $Users;
        }

        public function UPDATE($db) {
            if($this->Image->getSize() != null)
                $this->Image->UPDATE($db);

            $values = array(
                'Nome'      => $this->getFirstName(),
                'Sobrenome' => $this->getLastName(),
                'Email'     => $this->getEmail(),
                'Senha'     => $this->getPassword(),
                'RecSenhaToken' => $this->getRecSenha()
            );

            if($this->Image->getSize() != null) {
                $IMG_ID = $this->Image->getID();
                $values['ID_Imagem'] = $IMG_ID;
            }

            $db->UPDATE(self::$table, $values, array("ID" => $this->getID()));
        }

        public function DELETE ($db) {
            if($this->Image->getID() != null)
                $this->Image->DELETE($db);

            return $db->DELETE(self::$table, ['ID' => $this->getID()]);
        }
    }
?>