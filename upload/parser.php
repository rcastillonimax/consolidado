<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Procesar Archivo</title>
        <script src="js/jquery.js"></script>
        <script src="js/javascript.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>

    <body>
        <div class="content">
            <a href="index.html">INDEX </a> <br>
            <!--            <a href="agregar.html">Agregar un Empleado </a><br> 
            <a href="file_empleados.html">Agregar Empleados desde archivo</a><br>
            <a href="del_registros.php">Eliminar Registros </a><br> 
            <a href="del_empleados.php">Eliminar tabla Empleados</a>   -->

            <?php
                /*
                origen: index.php
                Script que recoge el nombre del archivo con los registros de todos los empleados
                cargado al servidor,
                verifica que sea valido
                recupera de tabla empleado idEmpleado segun numEmpleado,
                verifica si en tabla registroEmpleado hay registros con IdEmpleado y fecha indicados
                Si- obtiene idRegistro e inserta registro idRegistro y Hora nuevo a tabla registroHora
                No- Inserta idEmpleado y fecha, recupera IdRegistro,
                Inserta idRegistro y hora en tabla registroHora

                */
                include('../php/connect.php');
                /*                $query="SHOW TABLES LIKE ''";
                $res=mysqli_query($con,$query);    */
                //Tabla vacía??
                //               if($row=mysqli_fetch_array($res)){
                //ruta donde se guardaran los archivos


                $target_dir = "../../archivos/";   //REMOTA
                //$target_dir="c:/archivos/"; //LOCAL

                //extensiones permitidas
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $FileType = pathinfo($target_file,PATHINFO_EXTENSION);

                // Check if file already exists
                /*if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
                }
                */
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($FileType != "xls" && $FileType != "xlsx" && $FileType != "csv"
                    && $FileType != "txt" ) {
                    echo "Archivo no permitido";
                    $uploadOk = 0;
                }

/*                if (($_FILES["fileToUpload"]["type"] == "text/plain")
                    || ($_FILES["fileToUpload"]["type"] == "application/txt")
                    || ($_FILES["fileToUpload"]["type"] == "text/anytex")
                    || ($_FILES["fileToUpload"]["type"] == "application/octet-stream"))
                {*/
                    if ($_FILES["fileToUpload"]["error"] > 0){
                        echo "Error: " . $_FILES["fileToUpload"]["error"] . "<br>";
                    }
                    else{
                        //Imprimos informacion del archivo
                        echo "Upload: " . $_FILES["fileToUpload"]["name"] . "<br>";
                        echo "Type: " . $_FILES["fileToUpload"]["type"] . "<br>";
                        echo "Size: " . ($_FILES["fileToUpload"]["size"] / 1024) . " kB<br>";
                        echo "Almacenamiento temporal: " . $_FILES["fileToUpload"]["tmp_name"]."<br>";
                        //$target_dir=$target_dir.$_FILES["fileToUpload"]["name"];
                        echo "ruta a subir: ".$target_file;
                        //movemos archivo de lmacenamiento temporal a directorio
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }

                        //procesamos archivo            
                        /*                            if($fp=fopen($target_dir,"r")){
                        while(!feof($fp)){               
                        $line=fgets($fp);
                        echo "<br><br>".$numEmpleado=strtok($line," \t");
                        echo "\t".$fecha=strtok(" \t");
                        echo "\t".$hora=strtok(" \t");
                        $idEmp="";
                        $idRegistro="";
                        //Existe el empleado?
                        $query="SELECT idEmpleado FROM empleado WHERE numEmpleado ='$numEmpleado'";
                        //                                    echo "<br>$query";
                        $res=mysqli_query($con,$query);
                        //Recuperar idEmpleado de tabla empleado
                        if($row=mysqli_fetch_array($res)){
                        $idEmp=$row[0];
                        //                                        echo "<br>El IdEmp=$idEmp";
                        //existe registro con ese idEmp y fecha en la tabla registroempleado?
                        $query="SELECT idRegistro FROM registroEmpleado WHERE empleado_idEmpleado='$idEmp' AND Fecha='$fecha'";
                        //                                        echo "<br>$query";
                        $res=mysqli_query($con,$query);
                        if($row=mysqli_fetch_array($res,MYSQLI_NUM)){
                        $idRegistro=$row[0];
                        //Si existe
                        echo "<br> Ya hay empleado con idEmp=$idEmp y fecha: $fecha";
                        }else{
                        //No existe, Insertamos nuevo Registro en tabla registroEmpleado
                        $query="INSERT INTO registroEmpleado (empleado_idEmpleado,Fecha) VALUES('$idEmp','$fecha')";
                        if(mysqli_query($con,$query)){
                        echo "<br>Registro idEmp y fecha agregado correctamente";
                        //                                                echo "<br>".$query;
                        //obtenermos el id del registro insertado
                        $idRegistro= mysqli_insert_id($con);
                        }                        
                        else echo "<br>Registro no agregado ".mysqli_error($con);
                        }
                        //CONSIREDAR SI HAY HORAS REPEDITAS
                        //Con $idregistro y $hora Insertamos registro  registroHora
                        if($idRegistro!=null){
                        $query="SELECT idregistroHora FROM registroHora WHERE registroEmpleado_idRegistro='$idRegistro' AND Hora='$hora'";
                        $res=mysqli_query($con,$query);
                        if($row=mysqli_fetch_array($res)){
                        echo "<br>El Registro YA EXISTE ".$row[0];
                        }else {
                        $query="INSERT INTO registroHora (registroEmpleado_idRegistro,Hora)
                        VALUES ('$idRegistro','$hora')";
                        if(mysqli_query($con, $query)) echo "<br>Registro hr agregado correctamente";
                        else echo "<br>Registro hr NO AGREGADO ".mysqli_error($con);
                        //                                                echo "<br>".$query;
                        }
                        }
                        else echo "<br>No se inserto registro xq idRegistro= $idRegistro - null?";                
                        } else echo "<br>Sin IdEmp, el empleado NO EXISTE??!";
                        }
                        }
                        else echo "error al abrir el archivo "; */
                    }
//                }
                //                }else echo "<br>La Tabla empleados no contiene Registros";
                //                mysqli_close($con);
            ?>

        </div>
    </body>
</html>