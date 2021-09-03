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
            
            if(isset($_GET['id-edit']) && !empty($_GET['id-edit']) ){
                
                $name = addslashes($_POST['name']);
                $phone = addslashes($_POST['phone']);
                $email = addslashes($_POST['email']);
                if(!empty($name) && !empty($phone) && !empty($email)){
                    if($people->emailAlreadyExists($email,$_GET['id-edit'] ) ){
                        echo "Esse email já está cadastrado"; 
                        
                    }else{
                        $people->update($_GET['id-edit'], $name, $phone, $email);
                        header("location: index.php");
                    }
                }else{
                    echo "Por favor, preencha todos os campos";
                }
            }else{
                $name = addslashes($_POST['name']);
                $phone = addslashes($_POST['phone']);
                $email = addslashes($_POST['email']);
                if(!empty($name) && !empty($phone) && !empty($email)){
                    if($people->emailAlreadyExists($email,null)){
                        echo "Esse email já está cadastrado";    
                    }else{
                        $people->register($name, $phone, $email);
                        header("location: index.php");
                    }
                }else{
                    echo "Por favor, preencha todos os campos";
                }
            }
                    
        }
        if(isset($_GET['id'])){
            $people->delete(addslashes($_GET['id']));
            header("location: index.php");
        }
        ?>
    <div id="wrapper">
        <section id='registration'>
            <?php
                if(isset($_GET['id-edit'])){
                    $personData = $people->findOnePerson(addslashes($_GET['id-edit']));
                    
                }

            ?>
            <form 
                action=
                    <?php
                        if(isset($_GET['id-edit'])){
                            echo "./?id-edit=".$_GET['id-edit'];
                        }else{
                            echo "./";
                        }
                    ?> 
                method='POST'
                class="
                    <?php
                        if(isset($_GET['id-edit'])){
                            echo "edit";
                        }
                    ?>
                "
            >
                <div class='registration_header'>
                    <h2>
                        <?php
                            if(isset($_GET['id-edit'])){
                                echo "Atualizar registro";
                            }else{
                               echo "Cadastrar pessoa";
                            }
                        ?>
                    </h2>
                </div>    
                <label for="name">nome*</label>
                <input type="text" name="name"
                value=
                    <?php  
                        if(isset($_GET['id-edit'])){
                            echo $personData['name'];
                        } 
                    ?>
                >
                <label for="phone">telefone*</label>
                <input type="text" name='phone'
                value=
                    <?php  
                        if(isset($_GET['id-edit'])){
                            echo $personData['phone'];
                        } 
                    ?>
                >
                <label for="email">email*</label>
                <input type="text" name="email"
                value=
                    <?php  
                        if(isset($_GET['id-edit'])){
                            echo $personData['email'];
                        } 
                    ?>
                >
                <div class='registration_control'>
                    <input value=
                    <?php
                            if(isset($_GET['id-edit'])){
                                echo "atualizar";
                            }else{
                               echo "cadastrar";
                            }
                    ?>
                     class="registration_button save" type="submit" >
                    <a href="index.php" class="registration_button cancel" >cancelar</a>
                </div>
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
                                <a class="edit" href="./?id-edit=<?php echo $data[$i]['id'];?>" id="list_delete">editar</a>
                                <a class="delete" href="./?id=<?php echo $data[$i]['id'];?>" id="list_delete">excluir</a>
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