<?php
    // try {
    //     $pdo = new PDO("mysql:dbname=phpcadastro;host=localhost", "root","");
    // }catch (PDOException $e) {
    //     echo 'Database error: '.$e->getMessage();
    // }catch(Exception $e){
    //     echo 'Database error: '.$e->getMessage();
    // }
    require_once 'class-people.php';
    $people = new People("phpcadastro","localhost","root","");
    $data = $people->findData();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/registration.css">
    <link rel="stylesheet" href="./styles/list.css">
    <title>Cadastro</title>
</head>
<body>
    <?php
        if(isset($_POST['email'])){
            $name = addslashes($_POST['name']);
            $phone = addslashes($_POST['phone']);
            $email = addslashes($_POST['email']);
            if(!empty($name) && !empty($phone) && !empty($email)){
                if(!$people->register($name, $phone, $email)){
                    echo "Esse email já está cadastrado";    
                }else{
                    $people->register($name, $phone, $email);
                }
            }else{
                echo "Por favor, preencha todos os campos";
            }
        }
    ?>
    <div id="wrapper">
        <section id='registration'>
            <form action="./" method='POST'>
                <h2>Cadastro de pessoas</h2>
                <label for="name">nome</label>
                <input type="text" name="name">
                <label for="phone">Telefone</label>
                <input type="text" name='phone'>
                <label for="email">Email</label>
                <input type="text" name="email">
                <input type="submit">
            </form>
        </section>
        <section id='list'>
            <table>
                <tr>
                    <th> Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                </tr>
                <?php
                    if(count($data)>0){
                        for ($i=0; $i < count($data); $i++) { 
                            ?>
                            <tr>
                            <?php
                                foreach ($data[$i] as $key => $value){
                                    if($key!="id"){
                                        ?>
                                        <td>
                                        <?php
                                        echo $value;
                                        ?>
                                        </td>
                                        <?php
                                    }
                                }
                            ?>
                            </tr>
                            <?php
                        }
                    }
                ?>
                
            </table>
        </section>
    </div>
</body>
</html>