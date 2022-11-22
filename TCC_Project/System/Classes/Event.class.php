<?php
    class Event {
        private static $table = "tbl_Evento";
        private $Cod;
        private $Titulo;
        private $DataHora_Inicio;
        private $DataHora_Venc;
        private $Descricao;
        private $Image;
        private $Permission;
        private $Favorito;
        private $Classificacoes = array();
        private $Grupos = array();

        public function setCod ($cod) {
            $this->Cod = $cod;
        }

        public function getCod () {
            return $this->Cod;
        }
        
        public function setTitulo ($titulo) {
            $titulo = trim(preg_replace('/\s+/', " ", $titulo));

            $this->Titulo = $titulo;
        }

        public function getTitulo () {
            return $this->Titulo;
        }

        public function setDataHora_Inicio ($dataHora_Inicio) {
            $this->DataHora_Inicio = $dataHora_Inicio;
        }

        public function getDataHora_Inicio () {
            return $this->DataHora_Inicio;
        }

        public function setDataHora_Venc ($dataHora_Venc) {
            $this->DataHora_Venc = $dataHora_Venc;
        }

        public function getDataHora_Venc () {
            return $this->DataHora_Venc;
        }

        public function setDescricao ($descricao) {
            $this->Descricao = $descricao ;
        }

        public function getDescricao () {
            return $this->Descricao ;
        }

        public function setImage ($file) {
            $this->Image = $file;
        }

        public function getImage () {
            return $this->Image;
        }

        public function getPermission () {
            return $this->Permission;
        }

        public function setPermission ($permission) {
            $this->Permission = $permission;
        }

        public function getFavorito () {
            return $this->Favorito;
        }

        public function setFavorito ($favorito) {
            $this->Favorito = $favorito;
        }

        public function getClassificacoes () {
            return $this->Classificacoes;
        }

        public function addClassificacao ($Classificacao) {
            $this->Classificacoes[] = $Classificacao;
        }

        public function getGrupos () {
            return $this->Grupos;
        }

        public function addGrupo ($Grupo) {
            $this->Grupos[] = $Grupo;
        }

        public function SELECTED_Groups (int $id) {
            foreach($this->Grupos as $GroupAssoc) {
                if($GroupAssoc->getGroup()->getID() == $id)
                    return true;
            }
        }

        public function SELECTED_Classifications (int $id) {
            foreach($this->Classificacoes as $ClassificacaoAssoc) {
                if($ClassificacaoAssoc->getClassificacao()->getID() == $id)
                    return true;
            }
        }

        public function deleteGroups ($db) {
            $db->DELETE('tbl_EventoXGrupo', array('Cod_Evento' => $this->getCod()));
        }

        public function deleteClassification ($db) {
            $db->DELETE('tbl_Classifica', array('Cod_Evento' => $this->getCod()));
        }

        public function INSERT_Favorito ($db, $id_user) {
            $values = [
                'Cod_Evento' => $this->getCod(),
                'ID_Usuario' => $id_user
            ];
            
            $db->INSERT('tbl_Favorita', $values);
        }
        
        public function deleteFavorito ($db, $id_user) {
            $values = [
                'Cod_Evento' => $this->getCod(),
                'ID_Usuario' => $id_user
            ];

            $db->DELETE('tbl_Favorita', $values);
        }

        public function INSERT ($db) {
            if(isset($this->Image))
                $this->Image->INSERT_File($db);

            $values = array(
                'Titulo' => $this->getTitulo()
            );

            if($this->DataHora_Inicio != null)
                $values['DataHora_Inicio'] = $this->getDataHora_Inicio();
            if($this->DataHora_Venc != null)
                $values['DataHora_Venc']   = $this->getDataHora_Venc();
            if($this->Descricao != null)
                $values['Descricao']       = $this->getDescricao();
            if($this->Image != null)
                $values['ID_Imagem']       = $this->Image->getID();

            $this->setCod($db->INSERT(self::$table, $values));
        }

        public static function getEvents ($db, $WHERE) {
            $query = "SELECT Cod, Titulo, DataHora_Inicio, DataHora_Venc, Descricao, ID_Imagem, I.Nome as 'Imagem', G.ID as 'ID_Grupo', Cat.ID as 'ID_Classificacao', Permissao, IF(F.ID_Usuario <> UG.ID_Usuario OR F.ID_Usuario IS NULL, 0, 1) as 'Favoritado'
            FROM tbl_Evento
            LEFT JOIN tbl_Imagem I ON I.ID = ID_Imagem
            LEFT JOIN tbl_Classifica C ON Cod = C.Cod_Evento
            LEFT JOIN tbl_Classificacao Cat ON Cat.ID = C.ID_Classificacao
            LEFT JOIN tbl_EventoXGrupo EG ON Cod = EG.Cod_Evento
            LEFT JOIN tbl_Grupo G ON G.ID = ID_Grupo
            LEFT JOIN tbl_Favorita F ON F.Cod_Evento = Cod
            LEFT JOIN tbl_UsuarioXGrupo UG ON UG.ID_Grupo = G.ID 
            ".
            $WHERE.
            " ORDER BY DataHora_Inicio";

            $rows = $db->SELECT($query);
            $Events = array();
            $Event = new Event();
            $LastCod = 0;
            $lastIDGroup = 0;

            foreach($rows as $row) {
                if($LastCod == $row['Cod']) {
                    if($row['ID_Grupo'] == $lastIDGroup) { // classificação mudou
                        $Classificacao = new Classification();
                        $Classificacao->setID($row['ID_Classificacao']);

                        $Event->addClassificacao(new Classifica($Classificacao, $Event));
                    } else { // grupo mudou
                        $Grupo = new Group();
                        $Grupo->setID($row['ID_Grupo']);

                        $Event->addGrupo(new EventoXGrupo($Grupo, $Event));
                    }

                    if(!$Event->getPermission() && $row['Permissao'] == 1)
                        $Event->setPermission(true);
                    if(!$Event->getFavorito() && $row['Favoritado'] == 1)
                        $Event->setFavorito(true);
                } else {
                    $Event = new Event();
                    $Image = new File();

                    $Image->setID($row['ID_Imagem']);
                    if($row['Imagem'] == null)
                        $Image->setName('event_pad.png');
                    else
                        $Image->setName($row['Imagem']);
                    
                    $Event->setCod($row['Cod']);
                    $Event->setTitulo($row['Titulo']);
                    $Event->setDataHora_Inicio($row['DataHora_Inicio']);
                    $Event->setDataHora_Venc($row['DataHora_Venc']);
                    $Event->setDescricao($row['Descricao']);
                    $Event->setImage($Image);

                    $Grupo = new Group();
                    $Grupo->setID($row['ID_Grupo']);

                    $Event->addGrupo(new EventoXGrupo($Grupo, $Event));

                    $Classificacao = new Classification();
                    $Classificacao->setID($row['ID_Classificacao']);

                    $Event->addClassificacao(new Classifica($Classificacao, $Event));

                    if($row['Favoritado'] == 1)
                        $Event->setFavorito(true);
                    if($row['Permissao'] == 1)
                        $Event->setPermission(true);

                    $lastIDGroup = $row['ID_Grupo'];
                    $Events[] = $Event;
                }

                $LastCod = $row['Cod'];
            }

            return $Events;
        }

        public function UPDATE ($db) {
            if($this->Image->getSize() != null)
                $this->Image->UPDATE($db);

            $values = array(
                'Titulo' => $this->getTitulo()
            );

            if($this->DataHora_Inicio != null)
                $values['DataHora_Inicio'] = $this->getDataHora_Inicio();
            if($this->DataHora_Venc != null)
                $values['DataHora_Venc']   = $this->getDataHora_Venc();
            if($this->Descricao != null)
                $values['Descricao']       = $this->getDescricao();
            if($this->Image->getSize() != null) {
                $IMG_ID = $this->Image->getID();
                $values['ID_Imagem'] = $IMG_ID;
            }

            $db->UPDATE(self::$table, $values, array("Cod" => $this->getCod()));
        }

        public function DELETE ($db) {
            return $db->DELETE(self::$table, ['Cod' => $this->getCod()]);
        }
    }
?>