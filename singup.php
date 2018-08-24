
<?php
    require_once 'conection.php';

    $message = '';
    $messagePass = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (email, password) values (:email,:password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);

        $compara= $_POST['confirmPassword'] === $_POST['password'];

        if(!empty($_POST['confirmPassword']) && $compara){
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password);
            if($stmt->execute()){
                $message = 'usuario creado correctamente';
            }else{
                $message = 'ups, ha ocurrido un error';
            }
        }else{
            $messagePass = 'las contraseñas no coinciden';
        }


    }   
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <a href="/pruebaLogin">Pagina principal</a>
    </header>

    <h1>Registrarse</h1>

    <?php if(!empty($message)): ?>
    <p><?=$message ?></p>
    <p>puedes ir a <a href="login.php"> login</a></p>     
    <?php endif; ?>

    <?php if(!empty($messagePass)): ?>
    <p><?=$messagePass ?></p>   
    <?php endif; ?>

    <form action="singup.php" method="post">
        <input type="text" name="email" placeholder="ejemplo@ejmeplo.com" >
        <input type="password" name="password" placeholder="ingresa tu contraseña">
        <input type="password" name="confirmPassword" placeholder="confirma tu contraseña">
        <input type="submit" value="send"> 
    </form>


</body>
</html>

