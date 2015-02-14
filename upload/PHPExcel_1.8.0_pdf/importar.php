<!-- http://ProgramarEnPHP.wordpress.com -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>:: Importar de Excel a la Base de Datos ::</title>
</head>

<body>
    <!-- FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL -->
    Selecciona el archivo a importar:
    <form name="importa" method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data" >
        <input type="file" name="excel" />
        <input type='submit' name='enviar'  value="Importar"  />
        <input type="hidden" value="upload" name="action" />
    </form>
    <!-- CARGA LA MISMA PAGINA MANDANDO LA VARIABLE upload -->

    <?php
        //Data Load en una consulta de mysql puede ser buena opcion
        include('../../php/connect.php'); 
        extract($_POST);
        if ($action == "upload"){
        //cargamos el archivo al servidor con el mismo nombre
        //solo le agregue el sufijo bak_ 
        $archivo = $_FILES['excel']['name'];
        $tipo = $_FILES['excel']['type'];
        $destino = "bak_".$archivo;
        if (copy($_FILES['excel']['tmp_name'],$destino)) echo "Archivo Cargado Con Éxito";
        else echo "Error Al Cargar el Archivo";
        ////////////////////////////////////////////////////////
        if (file_exists ("bak_".$archivo)){ 
            /** Clases necesarias */
            require_once('Classes/PHPExcel.php');
            require_once('Classes/PHPExcel/Reader/Excel2007.php');

            echo $inputFileName=$destino;
            // Cargando la hoja de cálculo
            /** Identify the type of $inputFileName **/
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            /** Create a new Reader of the type that has been identified **/
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            /** Load $inputFileName to a PHPExcel Object **/
            $objPHPExcel = $objReader->load($inputFileName);
            // Asignar hoja de excel activa
            $objWorkSheet=$objPHPExcel->setActiveSheetIndex(0);
            $workSheetName=$objWorkSheet->str_replace(" ","_",getTitle());

            if($_arrayData[$workSheetName]=$objWorkSheet -> toArray()){
                var_dump($_arrayData);


            } else "Error en los datos";


            /* Hayamos funcion que pasa a un array toda la info de un rango determinado*/




            /*
            //$lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
            $lastRow = $objWorkSheet->getHighestRow();
            $lastColumn =$objWorkSheet->getHighestColumn(); 
            // Llenamos el arreglo con los datos  del archivo xlsx
            for ($row=1;$row<=$lastRow;$row++){
            for($col=0;$col<=$lastColumn;$col++){
            //Array que guarda los valores de cada columna
            $_cell[i-1][i]=$objWorkSheet

            }


            $data = array(
            array(
            'title' => 'My title' ,
            'name' => 'My Name' ,
            'date' => 'My date'
            ),
            array(
            'title' => 'Another title' ,
            'name' => 'Another Name' ,
            'date' => 'Another date'
            )
            );

            $this->db->insert_batch('mytable', $data); 
            }		
            }   */




            //si por algo no cargo el archivo bak_ 
            }else{echo "Necesitas primero importar el archivo";}
                $errores=0;
                //recorremos el arreglo multidimensional 
                //para ir recuperando los datos obtenidos
                //del excel e ir insertandolos en la BD
                foreach($_DATOS_EXCEL as $campo => $valor){
                    $namedb="consolidado_schema";
                    $nametable=;
                    $sql = "INSERT INTO alumnos VALUES (NULL,'";
                    foreach ($valor as $campo2 => $valor2){
                        $campo2 == "sexo" ? $sql.= $valor2."');" : $sql.= $valor2."','";
                    }
                    $result = mysql_query($sql);
                    if (!$result){ echo "Error al insertar registro ".$campo;$errores+=1;}
            }	
            /////////////////////////////////////////////////////////////////////////

            echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";
            //una vez terminado el proceso borramos el 
            //archivo que esta en el servidor el bak_
            unlink($destino);
        }

    ?>
</body>
</html>