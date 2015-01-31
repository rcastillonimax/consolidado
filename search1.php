<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="en">
        <meta name="Raymundo Castillo" content="">
        <meta name="keywords" content="">
        <title>Consolidado - NIMAX</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">

        <!--        <link rel="stylesheet" type="text/css" href=" http://cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
        -->


        <!--    Jquery para ordenacion y formato de tablas, si se descarga Jquery no es necesario las primeras 2 lineas-->
        <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="http://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>

        <!--Onready, inicializa  jquery-->
        <!--        <script>
        $(document).ready(function() {
        $('#example').DataTable();
        } );
        </script>     
        -->


<script type="text/javascript" class="init">


$(document).ready(function() {
    var table = $('#example').DataTable( {
        /*"scrollY": "200px",*/
        "paging": false
    } );

    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
} );


    </script>      







        <!--        Directorio donde estan los SCRIPT-->
    </head>

    <body>
    <div>

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
                //$query="SELECT * FROM $table";
                $query="SELECT * FROM $table WHERE `$searchby` = '$txtsearchby'";

                //                echo "-$query-<br>";

                //VAriable que alojara el codigo HTML de la TABLA
                $table=$hideColumn="";
                //Contruir Tabla
                //Si se ejecuta la consulta
                if($result=mysqli_query ($link,$query))
                {
                    //Si la consulta no esta vacia
                    if(mysqli_num_rows($result)>0)
                    { 
                        
                        $fields_num=mysqli_field_count($link);
                        $hideColumn="Elije columnas a ocultar\n<br>";
                        $table=$table."<h1>Table: Se encontraron ".mysqli_num_rows($result)." registro(s)</h1>\n";
                        //comienza cabecera de la tabla

                        /*                        $table=$table."<table data-role='table' data-mode='columntoggle' class='ui-responsive' class='display' id='example' cellspacing='0' width='100%'>\n\t<thead>\n\t\t<tr>\n";
                        */
                        $table=$table."<table class='display' id='example' cellspacing='0' width='100%' border='1'>\n\t<thead>\n\t\t<tr>\n";

                        
                         for($i=0;$i<$fields_num;$i++)
                        {
                            
                            $table=$table."\t\t\t<th class='header'>\n$i\n\t\t\t</th>\n\n";
                        }
                        $table=$table."\t\t</tr>\n\t\n\t\t<tr>";
                        
                        
                        
                        
                        // obtiene headers
                        //Revisar, probablemente se pueda cambiar por un while***
                        for($i=0;$i<$fields_num;$i++)
                        {
                            $field=mysqli_fetch_field($result);
                            $header=str_replace("_"," ",$field->name);
                            $table=$table."\t\t\t<th class='header'>\n{$header}\n\t\t\t</th>\n\n";
                            $hideColumn=$hideColumn."<a class='toggle-vis' data-column='$i'>{$i}</a> - \n";
                        }
                        $table=$table."\t\t</tr>\n\t</thead>\n";
                        $table=$table."\n\t<tbody>";
                        // Filas de la tabla
                        while($row = mysqli_fetch_row($result))
                        {
                            $table=$table."\n\t\t<tr>\n";
                            // $row is array... foreach( .. ) puts every element
                            // of $row to $cell variable
                            foreach($row as $cell)
                                $table=$table."\n\t\t\t<td>\n$cell\n\t\t\t</td>\n";
                            $table=$table."\t\t</tr>\n";
                        }
                        //Terminamos Tabla
                        $table=$table."\n\t</tbody>";
                        //Imprimos Tabla
                        echo $hideColumn."\n"."$table";
                    } else echo "<H1><br>Sin resultados</H1>";
                } else echo "Error en consulta:<b>".mysqli_error($link);
            ?>


    </body>
</html>