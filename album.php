<?php include_once("cabecera.php"); ?>
<?php include_once("conexion.php"); ?>
<?php

//insertar
if ($_POST) {
    $nombre = $_POST['nombre'];
    $imagen = $_FILES['imagen']['name'];
    $descripcion = $_POST['descripcion'];

    //no se repita la imagen
    $fecha = new DateTime();
    $imagen = $fecha->getTimestamp() . "_" . $_FILES['imagen']['name']; //para que no se repita
    //tratar imagen
    $imagen_temporal = $_FILES['imagen']['tmp_name'];
    move_uploaded_file($imagen_temporal, "imagenes/" . $imagen);

    //insertar
    $conexion = new conexion();
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
    $conexion->ejecutar($sql);

    //no volver a insertar
    header("Location: album.php");
}

if (isset($_GET["borrar"])) {
    $id = $_GET['borrar'];
    $conexion = new conexion();

    //borrar imagen
    $imagen = $conexion->consultar("SELECT imagen FROM `proyectos` WHERE id = " . $id);
    echo gettype($imagen);
    unlink("imagenes/" . $imagen[0]['imagen']);

    $sql = "DELETE FROM proyectos WHERE `proyectos`.`id` = " . $id;
    $conexion->ejecutar($sql);
}



//leer
$conexion = new conexion();
$sql = "SELECT * FROM `proyectos`";
$resultado = $conexion->consultar($sql);

?>
<div class="container">
    <div class="row">

        <div class="col-md-4">
            <br><br>
            <h3 style="text-align: center;">Guardar fotos</h3>
            <form action="album.php" method="post" enctype="multipart/form-data" style="background: #fff; border-radius: 9px; box-shadow: 12px 14px 22px -16px rgba(0,0,0.4); padding: 15px; text-align:center ;width: 100%;">
                <input required type="text" class="form-control" name="nombre" placeholder="nombre">
                <br><br>
                <input required type="file" class="form-control" name="imagen">
                <br><br>
                <textarea required name="descripcion" placeholder="Descripcion" class="form-control"></textarea>
                <br><br>
                <input type="submit" class="btn btn-success" value="Enviar foto" name="enviar">

            </form>
        </div>

        <div class="col-md-7">
            <br><br>
            <h3 style="text-align: center;">Lista de fotos</h3>
            <table class="table table-striped" style="background: #fff; border-radius: 9px; box-shadow: 12px 14px 22px -16px rgba(0,0,0.4); padding: 15px; text-align:center ;width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Acciones</th>


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $proyecto) { ?>
                        <tr>
                            <th><?php echo $proyecto['id'] ?></th>
                            <th><?php echo $proyecto['nombre'] ?></th>
                            <th>
                                <img src="imagenes/<?php echo $proyecto['imagen'] ?>" alt="" width="100">

                            </th>
                            <th><?php echo $proyecto['descripcion'] ?></th>
                            <th><a class="btn btn-danger" href="?borrar=<?php echo $proyecto['id']; ?>" role="button">Eliminar</a></th>
                            <th>
                            <form action="editar.php" method="post">
                                <input type="hidden" value="<?php $proyecto['id']; ?>">
                                <input type="submit" value="Actualizar">
                            </form>
                            </th>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>





<?php include_once("pie.php"); ?>