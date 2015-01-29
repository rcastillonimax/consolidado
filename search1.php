<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="en">
        <meta name="Raymundo Castillo" content="">
        <meta name="keywords" content="">

        <title>Consolidado - NIMAX</title>

        <!--        <link rel="stylesheet" type="text/css" href="my.css">  -->

        <!--    Jquery para ordenacion y formato de tablas, si se descarga Jquery no es necesario las primeras 2 lineas-->
        <!--        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->

        <!--        Directorio donde estan los SCRIPT-->
        <script type="text/javascript" src="../jquery/tablesorter/jquery-latest.js"></script> 
        <script type="text/javascript" src="../jquery/tablesorter/__jquery.tablesorter.js"></script> 


        <!--        Script Prueba Jquery para ver si se esta ejecutando, ya probamos y si ejecuta-->
        <script>
            $(document).ready(function(){
                $("#btn1").click(function(){
                    alert("Text: " + $("#test").text());
                });
                $("#btn2").click(function(){
                    alert("HTML: " + $("#test").html());
                });
            });
        </script> 

    </head>

    <body>

        <?php
            //Hara una consulta a una DB en MySQL y con los datos obtenidos generara una tabla
        
            include('../php/connect.php');
            $namedb="consolidado_schema";
            $table="reportes2014";
            mysqli_select_db($link,$namedb);
            //recuperamos criterio busqueda
            $searchby=$_REQUEST['searchby'];
            //echo "-$searchby-<br>";
            
            //cambiar " " espacios por "_"
            $searchby=str_replace(" ","_",$searchby);
            //Convertimos a Mayusculas
            $txtsearchby=strtoupper($_REQUEST['txtsearchby']);
            //echo "-$txtsearchby-<br>";
            
            //Ejecutamos Query
            //$query="SELECT * FROM $table WHERE '".$searchby."' = \`".$txtsearchby."\`";
            $query="SELECT * FROM $table WHERE `$searchby` = '$txtsearchby'";
            echo "-$query-<br>";
            
            //VAriable que alojara el codigo HTML de la TABLA
            $table="";
            //Contruir Tabla
            //Si se ejecuta la consulta
            if($result=mysqli_query ($link,$query))
            {
                //Si la consulta no esta vacia
                if(mysqli_num_rows($result)>0)
                { 
                    $fields_num=mysqli_field_count($link);
                    $table=$table."<h1>Table: Se encontraron ".mysqli_num_rows($result)." registro(s)</h1>";
                    //comienza cabecera de la tabla
                    $table=$table."<table class='tablesorter' border='1'><thead><tr>";

                    // obtiene headers
                    //Revisar, probablemente se pueda cambiar por un while***
                    for($i=0;$i<$fields_num;$i++)
                    {
                        $field=mysqli_fetch_field($result);
                        $header=str_replace("_"," ",$field->name);
                        $table=$table."<th class='header'>{$header}</th>";
                    }
                    $table=$table."</tr></thead>";

                    // Filas de la tabla
                    while($row = mysqli_fetch_row($result))
                    {
                        $table=$table."<tbody><tr>";
                        // $row is array... foreach( .. ) puts every element
                        // of $row to $cell variable
                        foreach($row as $cell)
                            $table=$table."<td>$cell</td>";
                        $table=$table."</tr>\n";
                    }
                    //Terminamos Tabla
                    $table=$table."</tbody>";
                    //Imprimos Tabla
                    echo "$table";
                } else echo "<H1><br>Sin resultados</H1>";

            } else echo "Error en consulta:<b>".mysqli_error($link);

        ?>

        <p id="test">This is some <b>bold</b> text in a paragraph.</p>
        <button id="btn1">Show Text</button>
        <button id="btn2">Show HTML</button>


        <!--        <script >
        $(document).ready(function() 
        { 
        $("#myTable").tablesorter(); 
        } 
        );


        </script> -->  
        <script type="text/javascript" id="js">
           $('table').tablesorter({ headers: { 0: { sorter: false}, 1: {sorter: false} } });
        </script>



    </body>
</html>