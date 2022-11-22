<?php
    class Database {
        private static $HOST = 'localhost';
        private static $DBNAME = 'tcc_db';
        private static $USER = 'root';
        //private static $PASS = '';
        private static $PASS = 'G4jIS9D2d62';
        private $connection;

        private function setConnection () {
            try {
                $this->connection = new PDO(
                    "mysql:host=". self::$HOST . ";"
                   ."dbname=" . self::$DBNAME
                   , self::$USER
                   , self::$PASS
                );
            } catch(PDOException $e) {
                die("ERRO: " . $e->getMessage());
            }
        }

        public function getConnection () {
            return $this->connection;
        }

        private function executeQuery ($query, $values = []) {
            try {
                $stmt = $this->getConnection()->prepare($query);
                $stmt->execute(array_values($values));

                return $stmt;
            } catch(PDOException $e) {
                echo $query;
                die("<br>ERRO: {$e->getMessage()}<br>");
            }
        }

        public function INSERT ($table, $values) {
            $keys = array_keys($values);
            $binds = array_fill(0, sizeof($keys), '?');

            $query  = "INSERT INTO $table (" . implode(',',$keys) . ")";
            $query .= " VALUES (" . implode(',', $binds) . ")";

            $this->executeQuery($query, array_values($values));
            return $this->connection->lastInsertId();
        }

        public function SELECT ($query) {
            return $this->executeQuery($query)->fetchAll();
        }

        public function UPDATE ($table, $values, $pk) {
            $query  = "UPDATE $table ";
            $query .= "SET " . implode('=?, ', array_keys($values)) . '=?';
            $query .= ' WHERE ' . array_keys($pk)[0] . " = " . array_values($pk)[0];

            $this->executeQuery($query, array_values($values));
        }

        public function DELETE ($table, $pk) {
            $query  = "DELETE FROM $table ";
            $query .= "WHERE " . implode("=? AND ", array_keys($pk)) . "=?";

            return $this->executeQuery($query, array_values($pk));
        }

        public function __construct () {
            $this->setConnection();
        }
    }
?>