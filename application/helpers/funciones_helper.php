<?php


function zero_fill ($valor, $long = 0)
{
    return str_pad($valor, $long, '0', STR_PAD_LEFT);
}
function generateRandomString($length = 100 ) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} 
function obtenerExtensionFichero($str)
    {
    $tmp = explode('.', $str);
    $file_extension = end($tmp);
      return $file_extension;
    }
function formatear_fecha($fecha)
{
  $retornar = formato_fecha($fecha, 'Y-m-d');
  return $retornar;
}
function formatear_fecha_dias_sumar($fecha)
{
  $retornar = formato_fecha($fecha, 'Y-m-j');
  return $retornar;
}
function formatear_fecha_kendo($fecha)
{
  $retornar = formato_fecha($fecha, 'd-m-Y');
  return $retornar;
}
function formatear_fecha_syncfusion($fecha)
{
  $retornar = formato_fecha($fecha, 'm-d-Y');
  return $retornar;
}
function formato_fecha($fecha, $formato)
{
  $retornar = NULL;
  if(!is_null($fecha)) {
    if(is_object($fecha)) {
      $retornar = $fecha->format($formato);
    }
    else {
      $valor = new DateTime($fecha);
      $retornar = $valor->format($formato);
    }
  }
  return $retornar;
}


function aleatoriosNoRepetidos()
{
    // Definimos un array que contendr� el listado de los n�meros.
    $numeros = array();
    // Iterador que lleva la cantidad de caracteres actual.
    $i = 0;
    // Marcar� la cantidad de caracteres que necesitemos.
    $cantCaracteres = 10;
    
    while($i < $cantCaracteres) {
        // Ubicamos un n�mero random entre 0 y 9
        $num=rand(0,9);
        // Validamos que ese n�mero no exista en el array.
        if(in_array($num,$numeros) === false) {
            // Si no existe, lo a�adiremos al array por medio del array_push()
            // e incrementamos el iterador de caracteres.
            array_push($numeros,$num);
            $i++;
        }
    }
    return $numeros;
}
//console.log( aleatoriosNoRepetidos(5)+"" )
