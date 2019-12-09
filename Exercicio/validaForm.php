<?php
require_once 'functions/mailparse.php';
require_once 'functions/login.php';

$pdoConnection = require_once "connection.php";

if($_POST['id'] == 'cadastrar') {
    $name      = $_POST['name'];
    $email     = $_POST['email'];
    $pass      = $_POST['pass'];
    $telefone  = $_POST['telefone'];
    $rua       = $_POST['rua'];
    $numero    = $_POST['numero'];
    $bairro    = $_POST['bairro'];
    $cidade    = $_POST['cidade'];
    $cep       = $_POST['cep'];
    

    if (!isset($_POST['name']) || !isset($_POST['email']) 
    ||  !isset($_POST['pass']) || !isset($_POST['telefone']) 
    ||  !isset($_POST['rua'])  || !isset($_POST['numero']) 
    ||  !isset($_POST['bairro']) ||  !isset($_POST['cidade']) 
    ||  !isset($_POST['cep']) ) {
        $output = json_encode(
            array(
                'type' => 'nullFields',
                'text' => 'Valores estão nulos'
        ));

        die($output);
    }
    
    if ( existEmail($pdoConnection, $email) == 0 ) {

        if(is_valid_email_address($email)) {

                $hash = password_hash($pass, PASSWORD_DEFAULT);

                $situacao = 1;

                $insert = $pdoConnection->prepare("INSERT INTO users (id , name, email, pass, situacao, telefone, rua, numero, bairro, cidade, cep)
                                                values(null, :name,:email,:pass, :situacao, :telefone, :rua, :numero, :bairro, :cidade, :cep) ");
                $insert->bindParam(':name',$name);
                $insert->bindParam(':email',$email);
                $insert->bindParam(':pass',$hash);
                $insert->bindParam(':situacao', $situacao);
                $insert->bindParam(':telefone',$telefone);
                $insert->bindParam(':rua',$rua);
                $insert->bindParam(':numero',$numero);
                $insert->bindParam(':bairro', $bairro);
                $insert->bindParam(':cidade',$cidade);
                $insert->bindParam(':cep',$cep);
                $insert->execute();

                $id = $pdoConnection->prepare("SELECT id FROM users WHERE email='$email' and pass='$hash' ");
                $id->execute();
                $user= $id->fetch();
                $value = $user['id'];

                $insert_pedido = $pdoConnection->prepare(" INSERT INTO `pedidos`(`id_pedido`, `id_cliente`) VALUES (NULL,:id_cliente) ");
                $insert_pedido->bindParam(':id_cliente',$value);
                $insert_pedido->execute();

                $output = json_encode(
                    array(
                        'type' => 'sucessSing',
                        'text' => 'Okay'
                ));

            die($output);
        } else {

            $output = json_encode(
                array(
                    'type' => 'errorUp',
                    'text' => 'Email mal formatado'
            ));

            die($output);
        }
    } else {
        $output = json_encode(
            array(
                'type' => 'existEmail',
                'text' => 'Email já existe'
        ));

        die($output);
    }
}

if($_POST['id'] == 'entrar') {
    
    $email = $_POST['email'];
    $pass  = $_POST['pass'];

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    if (!isset($_POST['email']) || !isset($_POST['pass']) || preg_replace('/\\s\\s+/', ' ', $email) == ""  || preg_replace('/\\s\\s+/', ' ', $pass) == "") {
        $output = json_encode(
            array(
                'type' => 'nullFields',
                'text' => 'Valores estão nulos'
        ));

        die($output);
    }

    $select = $pdoConnection->prepare("SELECT * FROM users WHERE email='$email' or name='$email' ");
    $select->setFetchMode(PDO::FETCH_ASSOC);
    $select->execute();
    $data=$select->fetch();

    if (!password_verify($pass, $data['pass']) && $data['email'] != $email  || !password_verify($pass, $data['pass']) && $data['name'] != $email  ) {
        
        $output = json_encode(
            array(
                'type' => 'errorSing',
                'text' => 'Credenciais inválidas'
        ));

        die($output);
    }

    $output = json_encode(
        array(
            'type'          => 'sucessSing',
            'emailOutput'   => $data['name'],
            'passOutput'    => $data['pass']
    ));

    session_start();

    $_SESSION['pass']      = $data['pass'];
    $_SESSION['email']     = $data['email'];
    $_SESSION['name']      = $data['name'];
    $_SESSION['telefone']  = $data['telefone'];
    $_SESSION['rua']       = $data['rua'];
    $_SESSION['numero']    = $data['numero'];
    $_SESSION['bairro']    = $data['bairro'];
    $_SESSION['cidade']    = $data['cidade'];
    $_SESSION['cep']       = $data['cep'];
    $_SESSION['clientId']  = $data['id'];
    
    $max = $pdoConnection->prepare(" SELECT max(id_pedido) from pedidos where id_cliente = :id_cliente");
    $max->bindParam(':id_cliente', $_SESSION['clientId']);
    $max->execute();
    $pedido_venda = $max->fetch();
    $_SESSION['pedido_venda'] = $pedido_venda[0];
    
    die($output);
    
}



?>