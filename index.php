<?php
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
                    header("location: index.php");
                }
            }else{
                echo "Por favor, preencha todos os campos";
            }
        }
        if(isset($_GET['id'])){
             $people->delete(addslashes($_GET['id']));
             header("location: index.php");
        }
    ?>
    <div id="wrapper">
        <section id='registration'>
            <form action="./" method='POST'>
                <div class='registration_header'>
                    <h2>Cadastro de pessoas</h2>
                </div>    
                <label for="name">nome</label>
                <input type="text" name="name">
                <label for="phone">Telefone</label>
                <input type="text" name='phone'>
                <label for="email">Email</label>
                <input type="text" name="email">
                <input class="registration_button" type="submit" >
            </form>
        </section>
        <section id='list'>
            <table>
                <tr>
                    <th> Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Configurar</th>
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
                            <td class="confg">
                                <a class="delete" href="./?id=<?php echo $data[$i]['id'];?>" id="list_delete">excluir</a>
                                <a class="eidt" href="./?id-edit=<?php echo $data[$i]['id'];?>" id="list_delete">editar</a>
                            </td>                             
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