<?php 

session_start();


if($_POST){
    if($_POST["usuario"] == "bps101" && $_POST['password'] == "admin"){
        $_SESSION['usuario'] = "bps101";
        header("Location: index.php");
    }
}else {
echo '<script>alert("Usuario o password incorrectos");</script>';

}

?>

<!doctype html>
<html lang="es">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body style="background: #eee;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <br><br>
                <form action="login.php" method="post" style="background: #fff; border-radius: 9px; box-shadow: 12px 14px 22px -16px rgba(0,0,0.4); padding: 15px; text-align:center ;width: 100%; height: 100%;">
                    <h2>Iniciar Sesion</h2>
                    <input class="form-control" type="text" name="usuario" id="" placeholder="Usuario">
                    <br>
                    <input class="form-control" type="password" name="password" id="" placeholder="Password">
                    <br>
                    <input type="submit" class="btn btn-success" value="Entrar Al portafolio" name="enviar" >
                </form>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>


</body>

</html>