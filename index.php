<?php
    session_start();
    require_once 'conection.php';

    if(isset($_SESSION['user_id'])){
        $records = $pdo->prepare('SELECT _id,email,password FROM users WHERE _id=:id');
        $records->bindParam(':id',$_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;
        if(count($results) > 0){
            $user = $results;
        }
        
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head> 
<body>
    <header>
        <a href="/pruebaLogin">Pagina principal</a>
    </header>
    
    <?php if(!empty($user)): ?>
    <br>
    <h1>bienvenido</h1> <?= $user['email']?>
    <br>has sido ingresado exitosamente
    <a href="logout.php">logout</a>

    <?php else: ?>
        <h1>registrate o inica sesion</h1>

        <a href="login.php">Iniciar sesion</a> o 
        <a href="singup.php">Registrarse</a>

    <?php endif; ?>

    

</body>
</html>