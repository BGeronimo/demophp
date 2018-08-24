<?php

    session_start();

    require_once 'conection.php';


    if(!empty($_POST['email']) && !empty($_POST['password'])){
    
        $records = $pdo->prepare('SELECT _id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $messages = '';

        
        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['_id'];
            header('Location: /pruebalogin');
            
        }else{
            $messages = 'ups, ha ocurrido un error. Revisa tu correo y contraseña';
        }
    }
    ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css"> 
    <title>Document</title>
</head>
<body>
    <header>
        <a href="/pruebaLogin">Pagina principal</a>
    </header>

    <?php if(!empty($messages)): ?>
    <p><?=$messages ?></p>     
    <?php endif; ?>

    <h1>Login</h1>

    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="ejemplo@ejmeplo.com" >
        <input type="password" name="password">
        <input type="submit" value="send"> 
    </form>
</body>
</html>