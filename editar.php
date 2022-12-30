<?php

//actualizar

if (isset($_POST)) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $imagen = $_FILES['imagen']['name'];
    $descripcion = $_POST['descripcion'];

    echo $id;
    echo $nombre;
    echo $imagen;
    echo $descripcion;

    $sql = ("UPDATE proyectos SET nombre='$nombre', descripcion='$descripcion' WHERE id='$id");
    $conexion->ejecutar($sql);

    if ($imagen != "") {

        //no se repita la imagen
        $fecha = new DateTime();
        $imagen = $fecha->getTimestamp() . "_" . $_FILES['imagen']['name']; //para que no se repita
        //tratar imagen
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
        move_uploaded_file($imagen_temporal, "imagenes/" . $imagen);

        //borrar imagen
        $imagen = $conexion->consultar("SELECT imagen FROM `proyectos` WHERE id = " . $id);


        if (isset($imagen[0]["imagen"]) && ($imagen[0]["imagen"] != "imagen.jpg")) {

            if (file_exists("imagenes/" . $imagen[0]["imagen"])) {
                unlink("imagenes/" . $imagen[0]["imagen"]);
            }
        }

        $sql = "UPDATE proyectos SET imagen='$imagen' WHERE `id` = " . $id;
        $conexion->ejecutar($sql);

    }
}