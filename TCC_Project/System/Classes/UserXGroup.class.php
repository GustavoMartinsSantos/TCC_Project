<?php
    class UserXGroup {
        private static $table = 'tbl_UsuarioXGrupo';
        private $Group;
        private $User;
        private $Permission;

        public function getGroup () {
            return $this->Group;
        }

        public function setGroup ($Group) {
            $this->Group = $Group;
        }

        public function getUser () {
            return $this->User;
        }

        public function setUser ($User) {
            $this->User = $User;
        }

        public function getPermissao () {
            return $this->Permission;
        }

        public function setPermissao ($Permission) {
            $this->Permission = $Permission;
        }

        public function INSERT ($db) {
            $values = array(
                'ID_Usuario' => $this->User->getID(),
                'ID_Grupo'   => $this->Group->getID(),
                'Permissao'  => $this->Permission
            );

            $db->INSERT(self::$table, $values);
        }
    }
?>