<?php
    class Classifica {
        private static $table = 'tbl_Classifica';
        private $Classificacao;
        private $Evento;

        public function getClassificacao () {
            return $this->Classificacao;
        }

        public function setClassificacao ($Classificacao) {
            $this->Classificacao = $Classificacao;
        }

        public function getEvento () {
            return $this->Evento;
        }

        public function setEvento ($Evento) {
            $this->Evento = $Evento;
        }

        public function INSERT ($db) {
            $values = array(
                'Cod_Evento'       => $this->Evento->getCod(),
                'ID_Classificacao' => $this->Classificacao->getID(),
            );

            $db->INSERT(self::$table, $values);
        }

        public function __construct($Classificacao, $Evento) {
            $this->setClassificacao($Classificacao);
            $this->setEvento($Evento);
        }
    }
?>