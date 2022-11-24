<?php
    class EventoXGrupo {
        private static $table = 'tbl_EventoXGrupo';
        private $Group;
        private $Evento;

        public function getGroup () {
            return $this->Group;
        }

        public function setGroup ($Group) {
            $this->Group = $Group;
        }

        public function getEvento () {
            return $this->Evento;
        }

        public function setEvento ($Evento) {
            $this->Evento = $Evento;
        }

        public function INSERT ($db) {
            $values = array(
                'Cod_Evento' => $this->Evento->getCod(),
                'ID_Grupo'   => $this->Group->getID()
            );

            $db->INSERT(self::$table, $values);
        }

        public function __construct($Group, $Evento) {
            $this->setGroup($Group);
            $this->setEvento($Evento);
        }
    }
?>