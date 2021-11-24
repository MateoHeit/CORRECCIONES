<?php
include_once("tateti.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/*
   Olmos, Gonzalo. FAI-1964. TUDW. gonzaloolmos1998@gmail.com. Gonzalo-Olmos
   Heit,  Mateo.   FAI-2937. TUDW . mateoheit@gmail.com       . MateoHeit
   Robledo, Alejandro. FAI-2027. TUDW. ale07-nqn@hotmail.com .AlejandroRobledo 
*/





/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/


//FUNCIONES PARA CARGAR JUEGOS A LA COLECCION

/**
*Esta funcion recibe como parametro un arreglo multidimiensional carga 10 juegos como *ejemplo con el nombre de cada jugador y sus respectivos puntajes
*@param array $coleccionJuegos
*@return array
*/

function cargarJuegos() {
            
    $coleccion[0] = ["jugadorCruz" => "GONZA", "jugadorCirculo" => "ALE" , "puntosCruz" => 3 , "puntosCirculo" => 0] ;
    $coleccion[1] = ["jugadorCruz" => "JUAN", "jugadorCirculo" => "CARO" , "puntosCruz" => 1 , "puntosCirculo" => 1] ;
    $coleccion[2] = ["jugadorCruz" => "ANTONIO", "jugadorCirculo" => "MARINA" , "puntosCruz" => 4 , "puntosCirculo" => 0] ;
    $coleccion[3] = ["jugadorCruz" => "MATEO", "jugadorCirculo" => "MARINA" , "puntosCruz" => 3, "puntosCirculo" => 0] ;
    $coleccion[4] = ["jugadorCruz" => "ANTONIO", "jugadorCirculo" => "ALE" , "puntosCruz" => 0 , "puntosCirculo" => 4] ;
    $coleccion[5] = ["jugadorCruz" => "CARO", "jugadorCirculo" => "JUAN" , "puntosCruz" => 3 , "puntosCirculo" => 0] ;
    $coleccion[6] = ["jugadorCruz" => "ALE", "jugadorCirculo" => "GONZA" , "puntosCruz" => 1 , "puntosCirculo" => 1] ;
    $coleccion[7] = ["jugadorCruz" => "CARO", "jugadorCirculo" => "MATEO" , "puntosCruz" => 3 , "puntosCirculo" => 1] ;
    $coleccion[8] = ["jugadorCruz" => "JUAN", "jugadorCirculo" => "GONZA" , "puntosCruz" => 3 , "puntosCirculo" => 0] ;
    $coleccion[9] = ["jugadorCruz" => "GONZA", "jugadorCirculo" => "ALE" , "puntosCruz" => 1 , "puntosCirculo" => 3] ;
    
return $coleccion;
    }
    

/**5)Punto Vista Programador
 * Esta funcion agrega un nuevo juego a la colección 
 * @param
 * @param
 */
function agregarJuego($coleccionJuegos, $juegoNuevo){
    $coleccionJuegos[]= $juegoNuevo;
  return $coleccionJuegos ;
}



//FUNCION PARA MOSTRAR UN JUEGO POR NUMERO DE JUEGO

/**Este Modulo Muestra un Juego. 
*@param array $coleccionJuegos
*@param int $numeroJuego
*/
function mostrarJuego($coleccionJuegos, $numeroJuego)
{
    // string $resultado,$nombreX, $nombreO
    // int $puntosCirculo, $puntosO
//convierto a mayusculas
    $nombreX = $coleccionJuegos[$numeroJuego]["jugadorCruz"]; 
//convierto a mayusculas
   $nombreO = strtoupper($coleccionJuegos[$numeroJuego]["jugadorCirculo"]);
//obtengo los puntos
    $puntosX = $coleccionJuegos[$numeroJuego]["puntosCruz"];
    $puntosO = $coleccionJuegos[$numeroJuego]["puntosCirculo"];
 
    //condiciones para el valor $resultado
    if ($puntosX == $puntosO) {
        $resultado = "(empate)";
    } elseif ($puntosX > $puntosO) {
        $resultado = "(ganó X)";
    } else {
        $resultado = "(ganó O)";
    }
    // imprimo el resultado del juego
    echo "****************************\n";
    echo "Juego TATETI: " . ($numeroJuego+1) . " " . $resultado . "\n";
    echo "Jugador X: " . $nombreX . " obtuvo " . $puntosX . "\n";
    echo "Jugador O: " . $nombreO . " obtuvo " . $puntosO . "\n";
    echo "****************************\n";
}

//FUNCIONES PARA MOSTRAR EL PRIMER JUEGO GANADOR

/**Este modulo pide el nombre de un jugador y recorre el arreglo parcialmente para verificar si existe en la coleccion. Retorna el nombre si existe
*@param array $coleccionJuegos
*@return String
*/
function pideYverificaJugador($coleccionJuegos){
    //int $i
    //String $nombre
    //boolean $repetir
    
    //inicializacion
    $i = 0;
    $repetir = false;

    echo"Ingrese el nombre de un Jugador: ";
    //convierto el nobmre a mayusculas
    $nombre= strtoupper(trim(fgets(STDIN)));
    
    do{
    while(($coleccionJuegos[$i]["jugadorCruz"]!= $nombre && $coleccionJuegos[$i]["jugadorCirculo"] !=$nombre ) && $i < count($coleccionJuegos) ){
        $i++;
    }
    if($coleccionJuegos[$i]["jugadorCruz"]== $nombre){
        $nombre = $coleccionJuegos[$i]["jugadorCruz"];
    } else{
        $nombre = $coleccionJuegos[$i]["jugadorCirculo"];
    } 
    
    if($i >= count($coleccionJuegos)){
        echo"Este jugador No se encuentra en la colección de juegos, Por favor ingrese otro: "; 
        $nombre= strtoupper(trim(fgets(STDIN)));
        $i=0;
        $repetir = true;
    }
    }while($repetir);

    return $nombre;
    }


/** 6)Punto Vista Programador
 * Funcion que retorna el indice del primer juego ganado por un jugador dado
 * @param array $coleccionJuegos
 * @param String $nombreJugador
 * @return int
 */
function indiceGanador($coleccionJuegos, $nombreJugador){
    //int $indice $noGano, $i  boolean $flag
   $i=0;
   $flag = true;
   
   do{
       if($coleccionJuegos[$i]["jugadorCruz"] == $nombreJugador){
          if($coleccionJuegos[$i]["puntosCruz"]>$coleccionJuegos[$i]["puntosCirculo"]){
              $indice = $i;
              $flag = false;
          }
       }elseif($coleccionJuegos[$i]["jugadorCirculo"] == $nombreJugador){
           if($coleccionJuegos[$i]["puntosCruz"]<$coleccionJuegos[$i]["puntosCirculo"]){
              $indice = $i;
              $flag = false;
          }
       }
   
       if($i >= count($coleccionJuegos)-1 ){
          $flag = false;
          $indice = -1; //en caso de que no haya ganado ninguna
       }
       $i++;
      }while($flag);
      
      return $indice;
   }    


//Para mostrar el juego se utiliza nuevamente la funcion mostrarJuego


//FUNCIONES PARA MOSTRAR EL PORCENTAJE DE JUEGOS GANADOS POR SIMBOLO

/** 8) punto de vista del programador
*Esta funcion no recibe ninguna variable por parametro y retorna el simbolo elegido por el usuario
*@return String
*/
function retornaSimbolo(){
    //String $simbolo

    echo "Ingrese un simbolo: cruz (X) o Circulo(O): ";
    //convierte a mayusculas lo ingresado por teclado
    $simbolo= strtoupper(trim(fgets(STDIN)));

    //Validación del simbolo 
    while(!($simbolo== "X" || $simbolo== "O") ){
        echo("Simbolo incorrecto, Ingrese cruz (X) o Circulo(O): ");
        $simbolo= strtoupper(trim(fgets(STDIN)));
    }
    return $simbolo;
}


/**
 * 9) desde el punto de vista del programador
 * retorna la cantidad de juegos ganados
 * @param array $coleccionJuegos
 * @param int $totalJuegosGanados
 * @return int
 */

function juegosGanadosTot($coleccionJuegos){
    $totalJuegosGanados = 0;
    for($i=0; $i < count($coleccionJuegos); $i++){
        if($coleccionJuegos[$i]["puntosCruz"] != $coleccionJuegos[$i]["puntosCirculo"]){
            $totalJuegosGanados++;
        }
    }
    return $totalJuegosGanados;
}

/** 10) 
 * Modulo que Retorna la cantidad de juegos ganados por un símbolo dado
 * @param $coleccionJuegos
 * @param $simbolo
 * @return int 
 */
function juegosGanadosPorSimbolo($coleccionJuegos, $simbolo){
    //int $ganadosCruz, $ganadosCirculo, $ganados
    $ganadosCruz = 0;
    $ganadosCirculo = 0;
    for($i=0; $i < count($coleccionJuegos); $i++){
        if($coleccionJuegos[$i]["puntosCruz"] > $coleccionJuegos[$i]["puntosCirculo"] ){
            $ganadosCruz++;
        }elseif($coleccionJuegos[$i]["puntosCruz"] < $coleccionJuegos[$i]["puntosCirculo"]){
            $ganadosCirculo++;
        }
    }
    if ($simbolo == "X") {
        $ganados = $ganadosCruz;
    }else{
        $ganados = $ganadosCirculo;
    }
return $ganados;
}



/**4)Punto de vista del usuario
 * Este modulo solicita al usuario como dato un simbolo y muestra por pantalla_
 * _el porcentaje de los juegos ganados de dicho simbolo.
 * @param array $coleccionJuegos
 */
function mostrarPorcentajeGanados($coleccionJuegos){
    //int $totalJuegosGanados, $acumJuegosGanadosO, $acumJuegosGanadosX
    //float $porcentaje
    //String $simbolo 

    $simbolo = retornaSimbolo();

    if($simbolo == "X"){
        $porcentaje = juegosGanadosPorSimbolo($coleccionJuegos, $simbolo) * 100 / juegosGanadosTot($coleccionJuegos);
       echo  "El porcentaje de los juegos ganados por ". $simbolo. " es: ". $porcentaje . "% \n";

    }else{
        $porcentaje = juegosGanadosPorSimbolo($coleccionJuegos, $simbolo) * 100 / juegosGanadosTot($coleccionJuegos);
        echo "El porcentaje de los juegos ganados por". $simbolo. " es: ". $porcentaje . "% \n";
    } 
}


//FUNCIONES PARA MOSTRAR RESUMEN DE JUGADOR INGRESADO POR USUARIO

//Se vuelve a usar nuevamente la funcion pideYVerificaJugador

/** 7) Desde el punto de vista del programador
 *  Modulo que retorna Un arreglo con el resumen de un Jugador Dado
 * @param array $coleccionJuegos
 * @param String $jugador
 * @return array
 */
function resumenArray($coleccionJuegos, $nombreJugador){
//int $i, $partidasGanadas ,$partidasPerdidas, $PartidasEmpate , $puntosAcum 
$resumenJugador=[];
     
$partidasGanadas = 0;
$partidasPerdidas = 0;
$PartidasEmpate = 0;
$puntosAcum = 0;
////cuenta las partidas que ganó un jugador ($nombreJugador)
for($i=0; $i < count($coleccionJuegos); $i++){
           
    if($nombreJugador == $coleccionJuegos[$i]["jugadorCruz"]){

        if($coleccionJuegos[$i]["puntosCruz"] == $coleccionJuegos[$i]["puntosCirculo"] ){
             $PartidasEmpate++;
             $puntosAcum = $puntosAcum + $PartidasEmpate;
        }elseif($coleccionJuegos[$i]["puntosCruz"] > $coleccionJuegos[$i]["puntosCirculo"] ){
             $partidasGanadas ++;
             $puntosAcum = $puntosAcum + $coleccionJuegos[$i]["puntosCruz"];
        }else{
            $partidasPerdidas++; 
        }


    }elseif($nombreJugador == $coleccionJuegos[$i]["jugadorCirculo"] ){
        if($coleccionJuegos[$i]["puntosCruz"] == $coleccionJuegos[$i]["puntosCirculo"] ){
             $PartidasEmpate++;
             $puntosAcum = $puntosAcum + $PartidasEmpate;
        }elseif($coleccionJuegos[$i]["puntosCruz"] < $coleccionJuegos[$i]["puntosCirculo"] ){
             $partidasGanadas ++;
             $puntosAcum = $puntosAcum + $coleccionJuegos[$i]["puntosCirculo"];
        }else{
            $partidasPerdidas++; 
        }

    }
        
    }

    //cargamos el arreglo resumen
    $resumenJugador = [
        "nombre" => $nombreJugador,
        "juegosGanados" =>  $partidasGanadas,
        "juegosPerdidos" => $partidasPerdidas,
        "juegosEmpatados" => $PartidasEmpate,
        "puntosAcumulados" =>  $puntosAcum ];
     
     
    return $resumenJugador;
}

/**
 * MODULO 5 DESDE EL PUNTO DE VISTA DEL USUARIO
 * Este modulo muestra por pantalla el resumen del jugador
 * @param $arrayResumen
 */

function mostrarResumen($arrayResumen){
 
    echo "*************************************\n";
    echo "Jugador: " . $arrayResumen["nombre"] . "\n";
    echo "Ganó: " . $arrayResumen["juegosGanados"] . "  juegos \n";
    echo "Perdió: " . $arrayResumen["juegosPerdidos"] . " juegos\n";
    echo "Empató: " . $arrayResumen["juegosEmpatados"] . " juegos\n";
    echo "Puntos Acumulados: " . $arrayResumen["puntosAcumulados"] . " puntos\n";
    echo "*************************************\n";
     
}


//FUNCIONES PARA MOSTRAR LISTADO DE JUEGOS ORDENADO POR JUGADOR CIRCULO

/**
 * 11)
 * compara la los nombres de la clave "jugadorCirculo"
 * @param array $a
 * @param array $b
 * @return int
 */
function cmp($a, $b){
    if($a["jugadorCirculo"]== $b["jugadorCirculo"]){
        $orden = 0; 
    } elseif($a["jugadorCirculo"]<$b["jugadorCirculo"]){
        $orden = -1;
    } else{
        $orden = 1;
    }
    return $orden;
} 

/**
 * Se ordena por nombre usando la funcion uasort
 * @param array $coleccion
 */
function ordenarPorNombre($coleccion){
//La funcion uasort ordena loleccion de juegos con la función "cmp"
uasort($coleccion, 'cmp'); 
print_r($coleccion);
}

//FUNCIONES PARA EL MENU//

/** 
* menu de opciones que repite mientras la opcion no sea salir, y retorna  *la opcion 
* @return int $opcion
*/
function seleccionarOpcion(){
    $opcion = 0;
    echo"Elija una opcion valida: \n";
    while($opcion != 7){
 	    echo"Menú de opciones \n";
        echo"1) Jugar al tateti \n";
        echo"2) Mostrar un juego \n";
        echo"3) Mostrar el primer juego ganador \n";
   	    echo"4) Mostrar porcentajes de juegos ganados \n";
   	    echo"5) Mostrar resumen de jugador \n";
   	    echo"6) Mostrar listado de juego ordenado por jugador O \n";
        echo"7) Salir \n"; 
    
   	    $opcion = solicitarNumeroEntre(1,7);
	    if($opcion!= 7){
            break;
        }      
    }
    return $opcion;
}





/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
//int $opcion, $numero, $indice
//array $juego
//String $nombre


//Proceso:

//Cargamos los juegos
$coleccionJuegos = cargarJuegos();

//$juego = jugar();
print_r($coleccionJuegos);
//imprimirResultado($juego);

do {
    $opcion = seleccionarOpcion();

    switch ($opcion) {
        case 1: 
            //Jugar al tateti
     		$juego = jugar();
            $coleccionJuegos = agregarJuego($coleccionJuegos, $juego);
            echo " \n ";
            break;
        case 2:
            //Mostrar un juego
	     echo"Ingrese un numero de juego: ";
		$numero = trim(fgets(STDIN));	
		if($numero >= 1 && $numero <= count($coleccionJuegos)){
           mostrarJuego($coleccionJuegos, $numero-1);
		}else{
        echo "No existe ese número de juego en la colección ";
        }
        echo " \n ";
            break;
        case 3:
            //Mostrar el primer Juego Ganador
            $nombre = pideYverificaJugador($coleccionJuegos); //pide el nombre de un jugador y verifica que exista en la colección
           
            $indice = indiceGanador($coleccionJuegos, $nombre); //almacena indice del primer juego ganado por el jugador dado
            if($indice != -1){
                mostrarJuego($coleccionJuegos, $indice);
            }else{
                echo"El jugador no ganó ningún juego.\n";
            }
            echo " \n ";
            break;
	   case 4:
            //Mostrar Porcentaje de juegos Ganados
		mostrarPorcentajeGanados($coleccionJuegos); 
        echo " \n ";
		break;
	   case 5:
            //Mostrar Resumen de jugador
 		  $nombre = pideYverificaJugador($coleccionJuegos);
          mostrarResumen(resumenArray($coleccionJuegos, $nombre));
          echo " \n ";
		break;
	   case 6:
            //Mostrar Listado de juego por Jugador O
 			ordenarPorNombre($coleccionJuegos);
             echo " \n ";
		break;
	   case 7:
            //Salir
 			$opcion = 7;
		break;
    }
} while ($opcion != 7 );
