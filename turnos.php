<!doctype html>
<html>
	<head>
	
    	<meta charset="utf-8">
	
    	<title>Turnos</title>
    
        <link rel="stylesheet" type="text/css" href="css/generales.css">
        <link rel="stylesheet" type="text/css" href="css/turnos.css">
        <link rel="stylesheet" type="text/css" href="css/responsivo-turnos.css">
    
    </head>
	<body>
    	
        <div class="contenedor-principal">
        	

            <?php

                require_once('funciones/conexion.php');
                require_once('funciones/funciones.php');
                
                //datos de la empresa
                $sql = "select * from info_empresa";
                $error = "Error al cargar datos de la empresa ";
                $search = consulta($con, $sql, $error);
                    
                $info = mysqli_fetch_assoc($search); 


                //turno atendido
                $sqlTA = "select turno, idCaja from atencion order by turno desc";
                $errorTA = "Error al cargar el turno atendido";
                $searchTA = consulta($con, $sqlTA, $errorTA);

                if(mysqli_num_rows($searchTA) > 1){

                    $turno = mysqli_fetch_assoc($searchTA);
                    $numeroTurno = $turno['turno'];
                    $caja = $turno['idCaja'];

                }else{

                    $numeroTurno = '000';
                    $caja = '0';

                }
                
                
                //ultimos 10 turnos atendidos
                $sqlUT = "select id, turno, idCaja from atencion order by turno desc limit 10";
                $errorUT = "Error al cargar los ultimos 10 turnos atendidos";
                $searchUT = consulta($con, $sqlUT, $errorUT);

            ?>

            <header>

                <div class="marco-tablaTurnos">
        
                    <div class="contenedor-tablaTurnos">
                        <div class="columna-tablaTurnos">
                            <div class="tabla-turnosArriba">Turno</div>
                            <div class="tabla-turnosAbajo" id="verTurno"><?php echo $numeroTurno; ?></div>

                        </div>
                        <div class="columna-tablaTurnos">
                            <div class="tabla-turnosArriba">Caja</div>  
                            <div class="tabla-turnosAbajo" id="verCaja"><?php echo $caja; ?></div>
                        </div>
                    </div>
        
                </div>
            
            </header>

            <section class="contenido">
                        
                <div class="contenido-izquierda">

                    <header class="contenedor-logo">

                        <div class="logo-empresa">
                        
                            <img src="<?php echo $info['logo'];?>">
                        
                        </div>
                        
                        <h1 class="nombre-empresa"><?php echo $info['nombre'];?> Bienvenido</h1>

                    </header>

                    <div class="contenedor-video">
                        
                        <div class="contenedor-reproductor">
                        
                            <iframe  src="https://www.youtube.com/embed/zw9-xodidNA?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        
                        </div>
                    
                    </div>

                </div>
                
                <div class="contenido-derecha">

                    <div class="contenedor-turnos">
                    
                         <table class="tabla-turnos" id="tabla-turnos">
                            <tr><th>Turno</th><th colspan="2">Caja</th></tr>
                            <?php  

                                if(mysqli_num_rows($searchUT) != 0){

                                    $c = 0;

                                    while ($row = mysqli_fetch_assoc($searchUT)){
                                        
                                        if($c === 0){

                                            /*echo '<tr>
                                                      <td>
                                                            <span  class="primer-fila">'.$row['turno'].'</span>
                                                      </td>
                                                       <td class="no-caja">
                                                            <span  class="caja primer-fila">'.$row['idCaja'].'</span>
                                                        </td>
                                                 </tr>';*/

                                            echo "<tr><td><span  class='primer-fila'>$row[turno]</span></td><td class='td-caja'><span class='caja primer-fila'>Caja</span></td><td class='no-caja'><span  class='primer-fila'>$row[idCaja]</span></td></tr>";

                                        }else{

                                            echo "<tr><td>$row[turno]</td><td class='td-caja'><span class='caja'>Caja</span></td><td class='no-caja'>$row[idCaja]</td></tr>";

                                        }

                                        $c++;    
                                        

                                    }

                                }

                            ?>
                            
                        </table>
                    
                    </div><!--contenedor turnos-->

                </div>
        		
            </section><!--contenido-->
            
            <footer class="footer">
                
                <marquee class="noticias">Precio del dolar: 20.00MN - solicita tu targeta de credito - Compra en linea tus marcas favoritas sin dar tus datos - Realiza tus operaciones sin acudir a tu sucursal</marquee>

            </footer>
        
        </div><!--contenedor principal-->
        
        <audio src="tonos/hangouts_message.ogg" id="tono"></audio>
		
        <script src="js/funcionesGenerales.js"></script>
		<script src="js/websocket.js"></script>
		<!--<script src="js/turnos.js"></script>-->
 
    </body>

</html>
