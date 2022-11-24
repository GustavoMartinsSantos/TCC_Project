<?php
    class File {
        private static $table = "tbl_Imagem";
        private static $uploadDir = '../IMG/';
        private $ID;
        private $Name;
        private $Extension;
        private $Size;
        private $Error;
        private $tmpName;

        public function setID($ID) {
            $this->ID = $ID;
        }

        public function getID() {
            return $this->ID;
        }

        public function setName ($name) {
            $this->Name = $name;
        }

        public function getName () {
            return $this->Name;
        }

        public function setExtension ($extension) {
            $this->Extension = strtolower($extension);
        }

        public function getExtension () {
            return "." . $this->Extension;
        }

        public function setSize ($size) {
            $this->Size = $size;
        }

        public function getSize () {
            return $this->Size;
        }

        public function setError ($error) {
            $this->Error = $error;
        }

        public function getError () {
            return $this->Error;
        }

        public function setTmpName ($dir) {
            $this->tmpName = $dir;
        }

        public function getTmpName () {
            return $this->tmpName;
        }

        public function Upload () {
            $valid_extensions = array('.jpeg', '.jpg', '.png');
            $IS_VALID = false;

            foreach($valid_extensions as $valid) {
                if($this->getExtension() == $valid)
                    $IS_VALID = true;
            }

            if($this->getError() != 0 || !$IS_VALID)
               return false;

            $destination = self::$uploadDir . $this->getName() . $this->getExtension();
            move_uploaded_file($this->getTmpName(), $destination);

            return true;
        }

        public function INSERT_File ($db) {
            $upload = $this->Upload();

            if($upload) {
                $values = array(
                    'Nome' => $this->Name . '.' . $this->Extension
                );
                
                $this->setID($db->INSERT(self::$table, $values));
            }
        }

        private static function getFile ($db,  $ID) {
            $query = "SELECT ID, Nome " .
                     "FROM " . self::$table . 
                     " WHERE ID = $ID";

            return $db->SELECT($query)[0];
        }

        public function UPDATE ($db) {
            if($this->getID() != null) {
                $OldFile = new File();
                $OldFile->setID($this->getID());

                $OldFile->DELETE($db);
            }

            $this->INSERT_File($db);
        }

        public function DELETE ($db) {
            $file = self::getFile($db, $this->getID());

            $path = self::$uploadDir . $file['Nome'];
            $delete = unlink($path);

            if($delete) {
                $pk = array('ID' => $this->getID());

                return $db->DELETE(self::$table, $pk);
            }
        }
    }
?>