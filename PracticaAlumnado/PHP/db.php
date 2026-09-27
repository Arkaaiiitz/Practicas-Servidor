<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del alumnado de 2ºESO del CF Somorrostro</title>
</head>
<body>
    <?php

        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $fechaNac = $_POST["fechaNac"];
        $curso = $_POST["curso"];
        $correo = $_POST["correo"];
        $contraseña = $_POST["contraseña"];


        $Conexion = mysqli_connect("localhost","php","admin","dbalumnado") or die ("No se ha podido conectar a la base de datos");
        $contarAlumnos = mysqli_query($Conexion, "SELECT * FROM alumnadoeso WHERE curso = '$curso'");
        $totalAlumnos = mysqli_num_rows($contarAlumnos);
        if($totalAlumnos < 25){
            $datos = mysqli_query($Conexion, "INSERT INTO alumnadoeso (nombre, apellidos, fechaNac, curso, correo, contraseña) VALUES ('$nombre', '$apellidos', '$fechaNac', '$curso', '$correo', '$contraseña')")
            or die ("Problemas en el select:") . mysqli_error($Conexion);

            echo "<p>Alumno añadido correctamente</p>";
        } else {
            echo "<p>No se pueden meter más alumnos en $curso, el máximo son 25</p>";
        }

        include("formAlumnado.html");

        echo "<h2> Tabla sobre el alumnado </h2>";
        echo "<table class='tabla-alumnado'>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Apellidos</th>";
        echo "<th>Fecha de Nacimiento</th>";
        echo "<th>Curso</th>";
        echo "<th>Correo</th>";
        echo "<th>Contraseña</th>";
        echo "</tr>";

        $alumnos = mysqli_query($Conexion, "SELECT * FROM alumnadoeso ORDER BY apellidos, curso");
        while($fila = mysqli_fetch_array($alumnos)){
            echo "<tr>";
            echo "<td>" . $fila['nombre'] . "</td>"; 
            echo "<td>" . $fila['apellidos'] . "</td>";
            echo "<td>" . $fila['fechaNac'] . "</td>";
            echo "<td>" . $fila['curso'] . "</td>";
            echo "<td>" . $fila['correo'] . "</td>";
            echo "<td>" . $fila['contraseña'] . "</td>";
            echo "</tr>";
            
        }
        mysqli_close($Conexion);
    ?>


</body>
</html>