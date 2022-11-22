<?php
    class Classification {
        private static $table = "tbl_Classificacao";
        private $ID;
        private $Name;

        public function getID () {
            return $this->ID;
        }

        public function setID ($id) {
            $this->ID = $id;
        }

        public function getName () {
            return $this->Name;
        }

        public function setName ($nome) {
            $this->Name = $nome;
        }

        public static function getClassificacoes ($db) {
            $Classificacoes = array();
            $query = "SELECT ID, Nome FROM " . Classification::$table;

            $rows = $db->SELECT($query);

            foreach($rows as $row) {
                $Classificacao = new Classification();
                $Classificacao->setID($row['ID']);
                $Classificacao->setName($row['Nome']);

                $Classificacoes[] = $Classificacao;

            }

            return $Classificacoes;
        }
    }
?>