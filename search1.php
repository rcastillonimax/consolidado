<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="en">
        <meta name="author" content="">
        <meta http-equiv="Reply-to" content="@.com">
        <meta name="generator" content="PhpED 8.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="creation-date" content="09/06/2012">
        <meta name="revisit-after" content="15 days">
        <title>Untitled</title>
        <link rel="stylesheet" type="text/css" href="my.css">
        <!--    Jquery para ordenacion y formato de tablas-->
        <script type="text/javascript" src="../jquery/tablesorter/jquery-latest.js"></script> 
        <script type="text/javascript" src="../jquery/tablesorter/jquery.tablesorter.js"></script> 


    </head>
    <body>

        <?php
            include('../php/connect.php');
            $namedb="consolidado_schema";
            $table="reportes2014";
            mysqli_select_db($link,$namedb);
            //recuperamos valor
            $searchby=$_REQUEST['searchby'];
            //echo "-$searchby-<br>";
            //cambiar espacios por _
            $searchby=str_replace(" ","_",$searchby);
            $txtsearchby=$_REQUEST['txtsearchby'];
            //echo "-$txtsearchby-<br>";

            //$query="SELECT * FROM $table WHERE '".$searchby."' = \`".$txtsearchby."\`";
            //SELECT * FROM $table '$txtsearchby' YA ESTA BIEN SOLO FALTA EL WHERE
            $query="SELECT * FROM $table WHERE `$searchby` = '$txtsearchby'";
            echo "-$query-<br>";
            $table="";
            //Si se ejecuta la consulta
            if($result=mysqli_query ($link,$query))
            {
                echo $fields_num=mysqli_field_count($link);
                if($fields_num>0)
                { 
                    $table=$table+"<h1>Table:</h1>";
                    $table=$table."<table border ='1'><tr>";

                    // headers
                    for($i=0;$i<$fields_num;$i++)
                    {
                        $field=mysqli_fetch_field($result);
                        $table=$table."<td>{$field->name}</td>";
                    }
                    $table=$table."</tr>";

                    // tabla
                    while($row = mysqli_fetch_row($result))
                    {
                        $table=$table."<tr>";
                        // $row is array... foreach( .. ) puts every element
                        // of $row to $cell variable
                        foreach($row as $cell)
                            $table=$table."<td>$cell</td>";
                        $table=$table."</tr>\n";
                    }
                    echo "imprimimos tabla: ".$table."sd";
                } else echo "Sin resultado";

            } else echo "Error en consulta:<b>".mysqli_error($link);

            /*
            if($result->num_rows>0)
            {
            while($nombre_columna=$result->fetch_field_direct($i)){
            echo $nombre_columna->name + "\t";
            $i++;
            }
            }
            */  

            /*  $query="SELECT *
            FROM reporte_2014
            WHERE `._SERIE`='TE19119";
            $result=$link->query($query);
            $option="<option value=''>Elige criterío de búsqueda</option>";
            $i=0;
            while($row=$result->mysqli_fetch_array()){
            $option=$option."<option value='$i'>$row</option>";
            echo "";
            */
        ?>


    </body>
</html>