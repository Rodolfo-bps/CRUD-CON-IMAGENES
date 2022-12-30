<?php include_once("cabecera.php"); ?>
<?php include_once("conexion.php"); ?>
<?php
$conexion = new conexion();
$sql = "SELECT * FROM `proyectos`";
$resultado = $conexion->consultar($sql);
?>

<div class="p-5 bg-light">
    <div class="container">
        <h1 class="display-3">Bienvenido <?php echo $_SESSION['usuario'];?></h1>
        <p class="lead">Este es un portafolio</p>
        <hr class="my-2">
        <p>Mas informacion</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Administrar</a>
        </p>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($resultado as $proyecto) { ?>
        <div class="col">
            <div class="card">
                <img src="imagenes/<?php echo $proyecto['imagen']?>" class="card-img-top" alt="..." width="100">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $proyecto['nombre']?></h5>
                    <p class="card-text"><?php echo $proyecto['descripcion']?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php include_once("pie.php"); ?>