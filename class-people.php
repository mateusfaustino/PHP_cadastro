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
        
        public function register($name, $phone, $email){
            $cmd = $this->pdo->prepare("SELECT id FROM phpcadastro.people WHERE email = :e");
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            if ($cmd->rowCount() > 0){
                return false;
            }else{
                $cmd = $this->pdo->prepare("INSERT INTO phpcadastro.people (name, phone, email) VALUES (:n, :p, :e)");
                $cmd->bindValue(":n", $name);
                $cmd->bindValue(":p", $phone);
                $cmd->bindValue(":e", $email);
                $cmd->execute();
                return true;
            }
        }
        public function delete($id){
            $cmd = $this->pdo->prepare("DELETE FROM phpcadastro.people WHERE id=:id");
            $cmd->bindValue(":id",$id);
            $cmd->execute();
        }
        public function edit($id){

        }
    }

?>