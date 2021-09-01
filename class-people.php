<?php
    class People{
        private $pdo;
        private $myDb;

        public function __construct ($dbname, $host, $user, $password){
            try {
                
                $this->pdo = new PDO("mysql:bdname=".$dbname.";host=".$host,$user,$password);
                $this->myDb = $dbname;
            }
            catch (PDOException $e) {
                echo "Database error: ".$e->getMessage();
                exit();
            }
            catch(Exception $e){
                echo "error: ".$e->getMessage();
                exit();
            }
        }
        public function findData(){
            $res=array();
            $cmd = $this->pdo->query("SELECT * FROM phpcadastro.people ORDER BY name");
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

    }

?>