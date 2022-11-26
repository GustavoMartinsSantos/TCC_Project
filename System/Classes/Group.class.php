<?php
    class Group {
        private static $table = "tbl_Grupo";
        private $ID;
        private $Name;
        private $GroupXUsers = array();
        private $NumMembers;

        public function setID ($id) {
            $this->ID = $id;
        }

        public function getID () {
            return $this->ID;
        }

        public function setName ($name) {
            $this->Name = utf8_encode($name);
        }

        public function getName () {
            return utf8_decode($this->Name);
        }

        public function getGroupXUsers () {
            return $this->GroupXUsers;
        }

        public function addGroupXUsers ($UserXGroup) {
            $this->GroupXUsers[] = $UserXGroup;
        }

        public function setNumMembers ($num) {
            $this->NumMembers = $num;
        }

        public function getNumMembers () {
            return $this->NumMembers;
        }

        public function deleteUsers ($db) {
            $db->DELETE('tbl_UsuarioXGrupo', array('ID_Grupo' => $this->getID()));
        }

        public function INSERT($db) {
            $values = array(
                'Nome' => $this->getName()
            );

            $this->setID($db->INSERT(self::$table, $values));
        }

        public static function getGroups ($db, $WHERE) {
            $query = "SELECT Grupo.ID, Grupo.Nome, Grupo.Membros, UG.Permissao
            FROM (
                SELECT G.ID, G.Nome, COUNT(G.ID) AS 'Membros' FROM tbl_Grupo G 
                INNER JOIN tbl_UsuarioXGrupo ON G.ID = ID_Grupo
                INNER JOIN tbl_Usuario U ON U.ID = ID_Usuario
                GROUP BY G.ID
                ORDER BY 2
                ) AS Grupo
            INNER JOIN tbl_UsuarioXGrupo UG ON UG.ID_Grupo = Grupo.ID 
            ". $WHERE ." 
            ORDER BY 2";

            $rows = $db->SELECT($query);
            $Groups = array();

            foreach ($rows as $row) {
                $Group = new Group();
                $Group->setID($row['ID']);
                $Group->setName($row['Nome']);
                $Group->setNumMembers($row['Membros']);

                $GroupXUser = new UserXGroup();
                $GroupXUser->setPermissao($row['Permissao']);

                $Group->addGroupXUsers($GroupXUser);

                $Groups[] = $Group;
            }

            return $Groups;
        }

        public static function getGroup ($db, $WHERE) {
            $query = "SELECT G.ID, G.Nome, ID_Usuario, CONCAT(U.Nome, ' ', U.Sobrenome) as 'Usuario', U.Email, I.Nome as 'Imagem', Permissao 
            FROM tbl_Grupo G 
            INNER JOIN tbl_UsuarioXGrupo ON G.ID = ID_Grupo 
            INNER JOIN tbl_Usuario U ON U.ID = ID_Usuario 
            LEFT JOIN tbl_Imagem I ON I.ID = ID_Imagem " . $WHERE;

            $rows = $db->SELECT($query);
            $Group = new Group();

            if(count($rows) == 0)
                return null;

            $Group->setID($rows[0]['ID']);
            $Group->setName($rows[0]['Nome']);

            foreach($rows as $row) {
                $User = new User();
                $File = new File();
                $File->setName($row['Imagem']);

                $User->setName($row['Usuario']);
                $User->setID($row['ID_Usuario']);
                $User->setEmail($row['Email']);
                $User->setImage($File);
                
                $GroupXUser = new UserXGroup($Group, $User, $row['Permissao']);
                $GroupXUser->setGroup($Group);
                $GroupXUser->setUser($User);
                $GroupXUser->setPermissao($row['Permissao']);

                $Group->addGroupXUsers($GroupXUser);
            }

            return $Group;
        }

        public function UPDATE ($db) {
            $values = array(
                'Nome' => $this->getName()
            );

            $db->UPDATE(self::$table, $values, array("ID" => $this->getID()));
        }

        public function DELETE ($db) {
            return $db->DELETE(self::$table, ['ID' => $this->getID()]);
        }
    }
?>