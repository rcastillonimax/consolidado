<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="en">
        <meta name="Raymundo Castillo" content="">
        <meta name="keywords" content="">
        <title>Consolidado - NIMAX</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--        Directorio donde estan los SCRIPT-->

        <link rel="stylesheet" type="text/css" href="StickyTableHeaders-master/demo/css/custom.css">
        <!--//conflicto con css-->
        <!--<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">-->                    

        <!--    Jquery para ordenacion y formato de tablas, si se descarga Jquery no es necesario las primeras 2 lineas-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <!--        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>   -->
        <script src="http://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>

        <!--Onready, inicializa  jquery-->
        <!--        <script>
        $(document).ready(function() {
        $('#example').DataTable();
        } );
        </script>     
        -->

        <!--        Jquery Tablesorter para la Ordenacion, busqueda, ocultar/mostrar columnas-->
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
                    $('table').stickyTableHeaders('destroy');
                    $('table').stickyTableHeaders();

                } );
            } );
        </script>    


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
            if($txtsearchby==='TODO'){
                $query="SELECT * FROM $table WHERE 1";
                
            }else $query="SELECT * FROM $table WHERE `$searchby` = '$txtsearchby'";

            //                echo "-$query-<br>";

            //Variable que alojara el codigo HTML de la TABLA
            $table=$hideColumn="";
            //Contruir Tabla
            //Si se ejecuta la consulta
            $info="<h3><a href='index.php'>NUEVA BUSQUEDA</a></h3>";
            $info=$info."<h4>$searchby = $txtsearchby<BR>";
            if($result=mysqli_query ($link,$query))
            {
                //Si la consulta no esta vacia
                if(mysqli_num_rows($result)>0)
                { 
                    $fields_num=mysqli_field_count($link);
                    /*$hideColumn="CLICK para OCULTAR/MOSTRAR columnas\n<br>";*/


                    $info=$info."\tSe encontraron ".mysqli_num_rows($result)." registro(s)</h4>\n";
                    //comienza cabecera de la tabla

                    /*                        $table=$table."<table data-role='table' data-mode='columntoggle' class='ui-responsive' class='display' id='example' cellspacing='0' width='100%'>\n\t<thead>\n\t\t<tr>\n";
                    */
                    $table=$table."<table id='example' cellspacing='0' width='100%' border='1'>\n\t<thead>\n\t\t<tr>\n";

                    //Numeracion de Columnas para identificacion de columnas a Ocultar/mostrar,
                    /*                    for($i=0;$i<$fields_num;$i++)
                    {

                    $table=$table."\t\t\t<td>\n$i\n\t\t\t</td>\n\n";
                    }
                    $table=$table."\t\t</tr>\n\t\n\t\t<tr>";   */

                    //Generamos row fila con encabezdos para ocultar columnas, se imprimira en la ultima fila
                    $hideColumn="\n<tfoot>\n\t\t<tr>\n";

                    // obtiene headers
                    //Revisar, probablemente se pueda cambiar por un while***
                    for($i=0;$i<$fields_num;$i++)
                    {
                        $field=mysqli_fetch_field($result);
                        //Reemplazamos _ por espacio, 
                        /*if($i!=27 or $i!=35)
                        $header=str_replace("_"," ",$field->name);*/
                        $header=$field->name;

                        /*$table=$table."\t\t\t<th class='header'>\n{$header}\n\t\t\t</th>\n\n";*/
                        if($i==27 or $i==35) {
                            $espacios="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            $table=$table."\t\t\t<th class='header'>\n$espacios{$header}$espacios\n\t\t\t</th>\n\n";
                        } else $table=$table."\t\t\t<th class='header'>\n{$header}\n\t\t\t</th>\n\n";

                        $hideColumn=$hideColumn."\n\t\t\t<th>\n";
                        $hideColumn=$hideColumn."<a class='toggle-vis' data-column='$i'>{$header}</a>\n";    
                        $hideColumn=$hideColumn."\n\t\t\t</th>\n";
                    }
                    $table=$table."\t\t</tr>\n\t</thead>\n";
                    $table=$table."\n\t<tbody>";
                    $hideColumn=$hideColumn."\n\t\t</tr>\n</tfoot>\n";
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
                    $table=$table.$hideColumn."\n\t</tbody>";
                    //Imprimos Tabla
                    echo $info."\n"."$table";
                } else echo "Sin resultados</H4>";
            } else echo "Error en consulta:<br>".mysqli_error($link)."</H4>";
        ?>

        <!--Para aplicacion de Header Estaticos jmosbech/StickyTableHeaders https://github.com/jmosbech/StickyTableHeaders
        Tiene que ir al Final, si no, no funciona
        -->
        <script src="StickyTableHeaders-master/js/jquery.stickytableheaders.js"></script>
        <script>
            $("table").stickyTableHeaders();
        </script> 

    </body>
</html>