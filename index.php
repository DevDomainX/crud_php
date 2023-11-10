<?php include("conexion.php"); ?>
<h2>Registro de invitados</h2>
<br><br><br>
<form action="index.php" method="post">
    <input style="color:blue; background:orange"; type="text" name="nombre" placeholder="nombre">
    <input type="text" name="apellido" placeholder="apellido">
    <input type="submit" value="Registrar usuario">
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
    // verificar cambios i verificar si no estan vacios 
    }else if(isset($_POST['editar'])){
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        // actualizar datos de la tabla '' si es string sin '' numeros
        $sql = "UPDATE invitados SET nombre = '$nombre' WHERE id = $id";
        $resultado = $conexion->query($sql);
        // condicional para ver si los datos se actulizaron correctamnte
        if ($conexion->query($sql) === true){
            echo "<br><br><center><h1>datos actualizados con exito!!</h1></center><br>";
        }else{
            die("<center><h1>error en guardar datos</h1></center><br>");
        }
     // condicional para eliminar si el dato no esta vacio   
    }else if(isset($_POST['eliminar'])){
        $id = $_POST['id'];

        // pregunta sql para eliminar en la bd solo con el id elimina todo
        $sql = "DELETE FROM invitados WHERE id = $id";

        // verificar si elimino o no 
        if ($conexion->query($sql) === true){
            echo "<br><br><center><h1>dato Eliminado con exito!!</h1></center><br>";
        }else{
            die("<center><h1>error en guardar datos</h1></center><br>");
        }
    }

    //crear lista de nombres para editar los nombres en este caso
    $sql = "SELECT id, nombre FROM invitados";
    $resultado = $conexion->query($sql);

    // inerjoin para enlazar datos de una tabla a otra 

    /*$sql = "SELECT * FROM registros INNER JOIN invitados ON registros.invitado_id = invitados.id";

    $resultado = $conexion->query($sql);*/

    if ($resultado->num_rows > 0){
        while($row = $resultado->fetch_assoc()){
            echo '<div>
                     <form action="index.php" method="post">
                        <input type="hidden" name="id" value="'.$row['id'].'">
                        <input type="text" name="nombre" value="'.$row['nombre'].'">
                        <input type="submit" name="editar" value="Editar">
                        <input type="submit" name="eliminar" value="Eliminar">
                    </form>
                </div>';
        }
    }
    
    $conexion->close();

    


?>



