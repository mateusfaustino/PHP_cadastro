<?php
    try {
        $pdo = new PDO("mysql:dbname=phpcadastro;host=localhost", "root","");
    }catch (PDOException $e) {
        echo 'Database error: '.$e->getMessage();
    }catch(Exception $e){
        echo 'Database error: '.$e->getMessage();
    }
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
    <div id="wrapper">
        <section id='registration'>
            <form action="">
                <h2>Cadastro de pessoas</h2>
                <label for="name">nome</label>
                <input type="text" name="name">
                <label for="phone">Telefone</label>
                <input type="text" name='phone'>
                <label for="email">Email</label>
                <input type="text" name="email">
            </form>
        </section>
        <section id='list'>
            <table>
                <tr>
                    <th> Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td>Telefone</td>
                    <td>Email</td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td>Telefone</td>
                    <td>Email</td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td>Telefone</td>
                    <td>Email</td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td>Telefone</td>
                    <td>Email</td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td>Telefone</td>
                    <td>Email</td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td>Telefone</td>
                    <td>Email</td>
                </tr>
            </table>
        </section>
    </div>
</body>
</html>