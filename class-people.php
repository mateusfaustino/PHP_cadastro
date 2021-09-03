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
        public function emailAlreadyExists($email, $id){
            $cmd = $this->pdo->prepare("SELECT id FROM phpcadastro.people WHERE email = :e");
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            if ($cmd->rowCount() > 0 && $res["id"]!=$id){
                return true;
            }else{
                return false;
            }
        }
        public function register($name, $phone, $email){
                $cmd = $this->pdo->prepare("INSERT INTO phpcadastro.people (name, phone, email) VALUES (:n, :p, :e)");
                $cmd->bindValue(":n", $name);
                $cmd->bindValue(":p", $phone);
                $cmd->bindValue(":e", $email);
                $cmd->execute();
        }
        public function delete($id){
            $cmd = $this->pdo->prepare("DELETE FROM phpcadastro.people WHERE id=:id");
            $cmd->bindValue(":id",$id);
            $cmd->execute();
        }
        public function findOnePerson($id){
            $res = array();
            $cmd = $this->pdo->prepare("SELECT * FROM phpcadastro.people WHERE id=:id");
            $cmd->bindValue(":id",$id);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
            
        
        public function Update($id, $name, $phone, $email){
            $cmd = $this->pdo->prepare
            ("UPDATE phpcadastro.people SET name=:n, phone=:p, email=:e WHERE id=:id");
            $cmd->bindValue(":id",$id);
            $cmd->bindValue(":n",$name);
            $cmd->bindValue(":p",$phone);
            $cmd->bindValue(":e",$email);
            $cmd->execute();
            
        }
    }

?>