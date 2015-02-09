<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="es">
        <meta name="author" content="Raymundo Castillo">
        <meta http-equiv="Reply-to" content="rcastillo@nimax.com.mx">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="creation-date" content="05/02/2015">
        <title>Consolidado</title>
        <!--<link rel="stylesheet" type="text/css" href="my.css">-->

        <script type="text/javascript" class="init">
            $(document).ready(function() {

                // Blocks as soon as possible
                $.blockUI({ message: $('#domMessage') });

                // Wire up page load event
                $(window).load(function () {
                    // Unblock when page is loaded 
                    $.unblockUI; 
                });
            } );
        </script> 

        <script type="">
            function validate(){
                if(document.getElementById('searchby').selectedIndex == 0)

                {
                    alert("Selecciona el criterio de busqueda");
                    document.getElementById('searchby').focus();
                    return false;
                }

            }
        </script>

    </head>
    <body>
        <div id="header-container">
            <header class="wrapper clearfix">
                <h1 id="title">CONSOLIDADO</h1>
                <!-- Lista para MENU
                <nav>
                <ul>
                <li><a href="#">nav ul li a</a></li>
                <li><a href="#">nav ul li a</a></li>
                <li><a href="#">nav ul li a</a></li>
                </ul>
                </nav>              -->
            </header>
        </div>

        <!--        <input id="pageDemo1" class="demo" type="submit" value="Block Page With Message" /> -->
        <div id="domMessage" style="display:none;"> 
            <h1>We are processing your request.  Please be patient.</h1> 
        </div>

        <div id="main-container">
            <div id="main" class="wrapper clearfix">

                <article>
                    <header>
                        <p>
                            <form name="frmComp" id="frmComp" action="search1.php" method="post" onsubmit="return validate()">

                                Texto a buscar:<br>
                                <input style="text-transform: uppercase;" title:"Se necesita un valor" placeholder="" type="text" name="txtsearchby"><BR><BR>
                                Selecciona críterio de búsqueda:<BR>
                                <select name='searchby' id='searchby' required="required">
                                    <option value='null' selected="selected"></option>
                                    <option value='FOLIO'>FOLIO</option>
                                    <option value='NÚM. SERIE'>NÚM. SERIE</option>
                                    <option value='NÚM. DE ORDEN DE SERVICIO'>NÚM. DE ORDEN DE SERVICIO</option>
                                </select>
                                <input id="pageDemo1" class="demo" type="submit" value="BUSCAR" align="center" /><br><BR>


                                <B>FORMATO:<BR><br></b>
                                <b>FOLIO:</b> <BR>NMG00236 AB/ AMO19730-14 AB<BR><BR>
                                <b>NÚM. SERIE:</b> <BR>11265522501293 / TE01946<BR><BR>
                                <b>NÚM. DE ORDEN DE SERVICIO:</b> <BR>431696
                            </form>
                        </p>
                    </header>
                </article>

                <aside>
                </aside>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div id="footer-container">
            <footer class="wrapper">
                <!--<h3>footer</h3>-->

            </footer>
        </div>
    </body>
</html>