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
</head>
<body>

    <?php
    include('../php/connect.php');
	$namedb="consolidado_schema";
    $table="reportes2014";
    mysqli_select_db($link,$namedb);
    $query="SELECT * FROM $table";
    $result=mysqli_query ($link,$query);
    
    $fields_num=mysqli_field_count($result);
	echo"<h1>Table:";
	echo "<table border ='1'><tr>";
	
	//Imprimimos headers
	for($i=0;$i<$fields_num;$i++)
	{
		$field=mysqli_fetch_field($result);
		echo"<td>{$field->name}</td>";
	}
	
	echo "</tr>\n";
	
	//Imprimimos tabla
	
	while($row = mysql_fetch_row($result))
	{
		echo "<tr>";
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable
		foreach($row as $cell)
			echo "<td>$cell</td>";
		echo "</tr>\n";
	}
		
	
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