<?php include("conexion.php"); ?>
<h2>Registro de invitados</h2>
<br><br><br>
<form action="index.php" method="post">
    <input style="color:blue; background:cyan"; type="text" name="nombre" placeholder="nombre">
    <input style="color:blue; background:cyan"; type="text" name="apellido" placeholder="apellido">
    <input style="color:blue; background:cyan"; type="submit" value="Registrar usuario">
</form>
<?php
    // CRUD en php (create, read, update, delete) eso significa crud
    if (isset($_POST['nombre']) && isset($_POST['apellido'])){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha = date("Y-m-d");


        // insertar datos en la tabla
        $sql = "INSERT INTO invitados (id, nombre, apellido, fecha) VALUES (NULL, '$nombre', '$apellido', '$fecha')";


        //VERIFICAR SI LOS DATOS SE INSERTARON
        if ($conexion->query($sql) === true){
            echo "<br><br><center><h1>datos cargados con exito!!</h1></center><br>";
        }else{
            die("<center><h1>error en guardar datos</h1></center><br>");
        }
        // eliminar solo con el id si eliminar no esta vacio
    }else if(isset($_POST['eliminar'])){
        $id = $_POST['id'];
        
        // consulta para eliminar
        $sql = "DELETE FROM invitados WHERE id = $id";

        if ($conexion->query($sql) === true){
            echo "<br><br><center><h1>datos Eliminados con exito!!</h1></center><br>";
        }else{
            die("<center><h1>error al Eliminar datos</h1></center><br>");
        }
    }
    // mostrar tabla de base de datos
    $sql = "SELECT nombre FROM invitados";
    $resultado = $conexion->query($sql);
    if ($resultado->num_rows > 0){
        while($row = $resultado->fetch_assoc()){
            echo '<center><div>
                <input type="text" name="nombre" value="'.$row['nombre'].'">
                <input type="submit" name="editar" value="editar">
                <input type="submit" name="eliminar" value="Eliminar">
            </div></center>';

        }

    }
    $conexion->close();
?>