<?php
/**
 * VARIABLES GLOBALES
 * Documentacion:
 * https://www.php.net/manual/es/reserved.variables.globals.php
 */
$arreglo_codigos_agenda=[];
$arreglo_codigos_reserva=[];
$archivo_mal1= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/datos_descartados_usuarios.csv";
$archivo_mal_usuarios = fopen($archivo_mal1, "w");
$arr_inicial = ["nombre", "run", "Dv", "Correo", "Nombre_usuario", "Contrasena", 
"Telefono_contacto", "Puntos", "Codigo_agenda", "Etiqueta", "Codigo_reserva", 
"Fecha", "Monto", "Cantidad_personas"];                                
fputcsv($archivo_mal_usuarios, $arr_inicial, ",", '"', "\\");

$archivo_mal2= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/datos_descartados_empleados.csv";
$archivo_mal_empleados = fopen($archivo_mal2, "w");
$arr_inicial2 = ["nombre", "run", "Dv", "Correo", "Nombre_usuario", "Contrasena", 
"Telefono_contacto", "Jornada", "Isapre", "Contrato", "Codigo_reserva", 
"Codigo_agenda", "Fecha", "Monto", "Cantidad_personas", "Estado_disponibilidad", 
"Numero_viaje", "Lugar_origen", "Lugar_llegada", "Fecha_salida", "Fecha_llegada",
"Capacidad", "Tiempo_estimado", "Precio_asiento", "Empresa", "Tipo_de_bus",
"Comodidades", "Escalas", "Clase", "Paradas"];                                
fputcsv($archivo_mal_empleados, $arr_inicial2, ",", '"', "\\");
     

// USUARIOS 
function parse_nombre($str){
    /**Nombre 
    * Consideraciones:
    * Admite NULO
    * Hay que limpiar RUT de puntos y ahi calcular si es RUT o no
    * cualquier string u similar se acepta como valido
    */
    return $str;
}

function parse_rut($str){
    /**
     * RUT 
     * Consideraciones:
     * NO ADMITE NULO
     */
    if ($str != NULL){
        $str = preg_replace('/\D/', '', $str);
        return $str;
    }else{
        return FALSE;
    }
}

function parse_dv($str){
    /**
     * DV
     * Consideraciones:
     * NO ADMITE NULO
     */
    if ($str != NULL){
        $str = preg_replace('/\D/', '', $str);
        return $str;
    }else{
        return FALSE;                
    }
}

function parse_correo($str){
    /**
     * Correo
     * Consideraciones:
     * Los dominios de correos permitidos en la pagina web son ’viajes.cl’, ’tourket.com’, 
     * ’wass.com’, ’marmol.com’, ’outluc.com’, ’edubus.cal’ y ’viajesanma.com’.
     * Un correo es una letra @ un dominio ejemplo:
     * a@dominio.cl
     */
    if ($str != "" AND strpos($str,"@") != FALSE){
        $arr = explode("@", $str);
        if (strlen($arr[0]) > 0 && in_array($arr[1], [
            "viajes.cl",
            "tourket.com",
            "wass.com",
            "marmol.com",
            "outluc.com",
            "edubus.cal",
            "viajesanma.com"
        ])){
            return $str;
        }else{return FALSE;}
    }else{return FALSE;}
}

function parse_username($str){
    /** Nombre Usuario
     * Consideraciones:
     * Nombre de usuario en la web
     * Admite NULO
     */ 
    return $str;
}

function parse_contrasena($str){
    /** Contrasena
     * Consideraciones:
     * Contrasena del usuario
     * Admite NULO
     * Cualquier string o similar se acepta como valido
     */
    return $str;
}

function parse_telefono($str){
    /** Telefono
     * Consideraciones:
     * NO ADMITE NULO
     * Debe tener largo 9
     * Si un numero es no nulo pero no es de largo 9 y/o no contiene codigo pais se agregaran 0 
     * hasta completar 9 numeros
     * Se tomaran todos los numeros del string y a partir de ahi se ordenara el numero de manera correcta
     * Si un numero es menor que 9 se agregan 0 hasta completar y se asume codigo +569 todo esto con el objetivo de 
     * preservar la mayor cantidad de informacion
     * Documentacion:
     * https://www.php.net/manual/es/function.preg-replace.php
     */
    if ($str != NULL){
        /*cualquier otro caso para mantener la mayor cantidad de datos, se ignoran los primeros numeros 
        y se toman en cuenta solo los 9 ultimos agregando siempre el codigo de pais
        */
        $numero_saneado = preg_replace('/[^0-9]/', '', $str);
        $largo_num = strlen($numero_saneado);
        if ($largo_num < 11){
            $numero_saneado = "569".(8-$largo_num)*"0" . $str;
        }
        $numero_saneado = "+".substr($numero_saneado, 0, 2)." ".substr($numero_saneado,2,1)." ".substr(
            $numero_saneado, 3, 4)." ".substr($numero_saneado, 7);
        return $numero_saneado;


        
    }else{
        return FALSE;
    }
}

function parse_puntos($str){
    /** Puntos
     * Consideraciones:
     * Admite NULO
     * Tiene que ser un numero
     * Si no es un numero se coloca 0
     * Documentacion:
     * https://www.php.net/manual/es/function.strlen.php
     */
    $numero_saneado = preg_replace('/[^0-9]/', '', $str);
    if (strlen($numero_saneado) == 0 || $numero_saneado == NULL){    
        $numero_saneado = 0;
    }
    return $numero_saneado;
}

function parse_codigo_agenda($str){
    /**
     * Codigo Agenda
     * Consideraciones:
     * UNICO
     * NO NULO
     * INTEGER
     * Documentacion: 
     * https://www.php.net/manual/es/reserved.variables.globals.php
     * https://www.php.net/manual/es/function.in-array.php
     */
    global $arreglo_codigos_agenda;
    if ($str == NULL){
        $numero_saneado = 0;
    }
    $numero_saneado = preg_replace('/[^0-9]/', '', $str);
    if (in_array($numero_saneado, $arreglo_codigos_agenda) != FALSE){
        return FALSE;
    } else{
        return $numero_saneado;
    }
    
}
function parse_etiqueta($str){
    /**
     * Etiqueta
     * Consideraciones:
     * ADMITE NULO
     * Documentacion:
     */
    return $str;
}
function parse_codigo_reserva($str){
    /**
     * Codigo Reserva 
     * Consideraciones:
     * UNICO
     * NO NULO
     * INTEGER
     * Documentacion: 
     * https://www.php.net/manual/es/reserved.variables.globals.php
     * https://www.php.net/manual/es/function.in-array.php
     */
    global $arreglo_codigos_reserva;
    if ($str == NULL){
        $numero_saneado = 0;
    }
    $numero_saneado = preg_replace('/[^0-9]/', '', $str);
    if (in_array($numero_saneado, $arreglo_codigos_reserva) != FALSE){
        return FALSE;
    } else{
        return $numero_saneado;
    }
    
}
function parse_fecha($str){
    /** 
     * Fecha 
     * Consideraciones:
     * ADMITE NULO
     * Debe tener formato YYYY-MM-DD
     * Para preservar la mayor cantidad de datos si un string 
     * Documentacion:
     * https://www.php.net/manual/es/function.preg-replace.php
     */
    if ($str == NULL){
        return $str;
    }
    $numero_saneado = preg_replace('/[^0-9]/', '', $str);
    $largo_num = strlen($numero_saneado);
    $numero_saneado =substr($numero_saneado, 0, 4)."-".substr($numero_saneado,4,2)."-".substr(
        $numero_saneado, 6);
    return $numero_saneado;


        
}
function parse_monto($str){
    /**
     * Monto
     * Consideraciones:
     * NO NULO
     * FLOAT
     * Documentacion: 
     * https://www.php.net/manual/es/reserved.variables.globals.php
     * https://www.php.net/manual/es/function.in-array.php
     */
    if ($str == NULL){
        $numero_saneado = 0.0;
    }
    $numero_saneado = preg_replace('/[^0-9]/', '', $str);
    return $numero_saneado; 
}


function parse_cantidad_personas($str){
    /**
     * Cantidad Personas
     * Consideraciones:
     * ADMITE NULO
     * Interger
     * Documentacion: 
     * https://www.php.net/manual/es/reserved.variables.globals.php
     * https://www.php.net/manual/es/function.in-array.php
     */
    if ($str == NULL){
        $numero_saneado = 1;
    }
    $numero_saneado = preg_replace('/[^0-9]/', '', $str);
    return $numero_saneado; 
}

function confirm_rut($numero, $dv){
    /**
     * Confirmar Rut
     * Consideraciones:
     * Funcion para confirmar si un numero es rut o no
     * Documentacion:
     * https://www.php.net/manual/es/function.str-split.php
     * https://www.php.net/manual/es/function.strtoupper.php 
     * https://www.php.net/manual/es/function.count.php
     */
    $multiplicadores = [2, 3, 4, 5, 6, 7, 2, 3, 4, 5, 6, 7];
    $digitos = str_split(strrev($numero));
    $suma = 0;
    for ($i = 0; $i < count($digitos); $i++) {
        $suma += $digitos[$i] * $multiplicadores[$i];
    }
    $residuo = $suma % 11;
    $dv_calculado = 11 - $residuo;
    if ($dv_calculado == 11) {
        $dv_calculado = 0;
    } elseif ($dv_calculado == 10) {
        $dv_calculado = 'K';
    }
    if (strtoupper($dv) == strtoupper($dv_calculado)) {
        return TRUE; 
    } else {
        return FALSE;
    }
}

function parse_usuarios($arr){
    /**
     * Parse Usuarios
     * Consideraciones:
     * Documentacion:
     * https://www.php.net/manual/es/function.array-push.php
     */
    echo "parse_usuarios...\n";
    $arr_correcto = [];
    $arr_malo = [];
    $correctitud = TRUE;
    global $archivo_mal_usuarios;

    $bool_nombre = parse_nombre($arr[0]);
    # checkeo que ni rut ni dv sean nulos, en caso que esto ocurra checkeo si es rut
    $bool_rut= parse_rut($arr[1]);
    $bool_dv = parse_dv($arr[2]); 
    $bool_correo = parse_correo($arr[3]);
    $bool_username = parse_username($arr[4]);
    $bool_contrasena = parse_contrasena($arr[5]);
    $bool_telefono = parse_telefono($arr[6]);
    $bool_puntos = parse_puntos($arr[7]);
    $bool_codigo_agenda = parse_codigo_agenda($arr[8]);
    $bool_etiqueta = parse_etiqueta($arr[9]);
    $bool_codigo_reserva = parse_codigo_reserva($arr[10]);
    $bool_fecha = parse_fecha($arr[11]);
    $bool_monto = parse_monto($arr[12]);
    $bool_cantidad_personas = parse_cantidad_personas($arr[13]);

    if ($bool_nombre !== FALSE){
        //echo "NOMBRE: $bool_nombre\n";
        array_push($arr_correcto, $bool_nombre);
    }else{
        echo "NOMBRE: mal\n"; $correctitud = FALSE; array_push($arr_correcto,"");} 

    if ($bool_rut != FALSE AND $bool_dv != FALSE){   
        $is_rut = confirm_rut($bool_rut, $bool_dv);
        if ($is_rut != FALSE){
            //echo "RUT: $bool_rut-$bool_dv \n";
            array_push($arr_correcto, $bool_rut);
            array_push($arr_correcto, $bool_dv);
        }}else{echo "RUT: mal\n";$correctitud = FALSE; array_push($arr_correcto,""); 
            array_push($arr_correcto,"");} #lo meto en el archivo de error y salgo de la funcion


    if ($bool_correo !== FALSE){
        //echo "CORREO: $bool_correo\n";
        array_push($arr_correcto, $bool_correo);
    } else{echo "CORREO: mal\n"; $correctitud = FALSE; array_push($arr_correcto,"");} 

    if ($bool_username !== FALSE){
        //echo "USERNAME: $bool_username\n";
        array_push($arr_correcto, $bool_username);
    }else{echo "USERNAME: mal\n"; $correctitud = FALSE; array_push($arr_correcto,"");}

    if ($bool_contrasena !== FALSE){
        //echo "PASSWORD: $bool_contrasena\n";
        array_push($arr_correcto, $bool_contrasena);
    }else{echo "PASSWORD: mal\n";$correctitud = FALSE;array_push($arr_correcto,"");}

    
    if ($bool_telefono !== FALSE){
        //echo "TELEFONO: $bool_telefono\n";
        array_push($arr_correcto, $bool_telefono);
    }else{echo "TELEFONO: mal\n";$correctitud = FALSE;array_push($arr_correcto,"");}

    if ($bool_puntos !== FALSE){
        //echo "PUNTOS: $bool_puntos\n";
        array_push($arr_correcto, $bool_puntos);
    }else{echo "PUNTOS: mal\n";$correctitud = FALSE;array_push($arr_correcto,"");}

    if ($bool_codigo_agenda !== FALSE){
        //echo "CODIGO AGENDA: $bool_codigo_agenda\n";
        array_push($arr_correcto, $bool_codigo_agenda);
    }else{echo "CODIGO AGENDA: mal\n";$correctitud = FALSE; array_push($arr_correcto,"");}

    if ($bool_etiqueta !== FALSE){ #preguntar si hay que hacer algun filtro con etiqueta u otros
        //echo "ETIQUETA: $bool_etiqueta\n";
        array_push($arr_correcto, $bool_etiqueta);
    }else{echo "etiqueta: mal\n";$correctitud = FALSE; array_push($arr_correcto,"");}

    if ($bool_codigo_reserva !== FALSE){
        //echo "CODIGO RESERVA: $bool_codigo_reserva\n";
        array_push($arr_correcto, $bool_codigo_reserva);
    }else{echo "CODIGO RESERVA: mal\n";$correctitud = FALSE; array_push($arr_correcto,"");}

    if ($bool_fecha !== FALSE){
        //echo "FECHA: $bool_fecha\n";
        array_push($arr_correcto, $bool_fecha);
    }else{echo "FECHA: mal\n";$correctitud = FALSE; array_push($arr_correcto,"");}

    if ($bool_monto !== FALSE){
        //echo "MONTO: $bool_monto\n";
        array_push($arr_correcto, $bool_monto);
    }else{echo "MONTO: mal\n";$correctitud = FALSE; array_push($arr_correcto,"");}

    if ($bool_cantidad_personas !== FALSE){
        //echo "CANTIDAD PERSONAS: $bool_cantidad_personas\n";
        array_push($arr_correcto, $bool_cantidad_personas);
    }else{echo "CANTIDAD PERSONAS: mal\n";$correctitud = FALSE; array_push($arr_correcto,"");}

    //var_dump($arr_correcto);
    if ($correctitud === FALSE){

        fputcsv($archivo_mal_usuarios, $arr_correcto, ",", '"', "\\");
            
        return "";
    }else{
        return $arr_correcto;
    }
    echo "\n"; 
    }
         
// EMPLEADOS *Algunas funciones se repiten con Usuarios, ver eso despues
function parse_nombre_empleado($arr){
    /**
     * String, es el nombre completo del usuario, admite nulo.
     */
    return 0;
}
function parse_rut_empleado($arr){
    /**
     * Run: Integer, Rol U ́nico Nacional, numero natural que parte desde el 1, no nulo. 
     */
    return 0;
}
function parse_dv_empleado($arr){
    /**
     * Dv: String, d ́ıgito verificador del Run, valores posibles 0 a 9, K o k.
     */
    return 0;
}
function parse_correo_empleado($arr){
    /**
     * Correo: texto, correo electr ́onico del usuario, contiene al menos una letra, el caracter @ y 
     * un texto (dominio) Ejemplos a@tourket.com, asdfghj@wass.com, no nulo.
     */
    return 0;
}
function parse_username_empleado($arr){
    /**
     * Nombre usuario: String, nombre del usuario en la web, admite nulo.
     */
    return 0;
}
function parse_contrasena_empleado($arr){
    /**
     * Contrasena: String, contrasen ̃a del usuario, no nulo.
     */
    return 0;
}
function parse_telefono_empleado($arr){
    /**
     * Telefono contacto: String, tel ́efono de contacto de largo 9 en formato [codigo de pa ́ıs] 
     * X XXXX XXXX, no nulo.
     */
    return 0;
}
function parse_jornada_empleado($str){
    /**
     * Jornada: String, diurno o nocturno, admite nulo.
     */
    $str =  preg_replace("/[^a-zA-ZáéíóúÁÉÍÓÚñÑ]/u", "", $str);
    if ($str == "" || $str == "Diurno" || $str == "Nocturno"){
        return $str;
    } else{
        echo "jornada: $str\n";
        return FALSE;
    }
}
function parse_isapre_empleado($str){
    /**
     * Isapre: String, nombre de la isapre, admite nulo.
     */
    return $str;
}
function parse_contrato_empleado($str){
    /**
     * Contrato: String, tipo de contrato (part time o full time), admite nulo.
     */
    $str = preg_replace("/[^a-zA-ZáéíóúÁÉÍÓÚñÑ ]/u", "", $str);
     if ($str == NULL || $str == "Part time" || $str == "Full time"){
        return $str;
    } else{
        echo "Contrato: $str\n";
        return FALSE;
    }

    return 0;
}
function parse_codigo_reserva_empleado($str){
    /** 
     * Codigo reserva: Integer, co ́digo u ́nico para identificar una reserva, no nulo. 
     */   
    if ($str == NULL){
        return FALSE;
    }else{
        return $str;
    }
}
function parse_codigo_agenda_empleado($str){
    /**
     * Codigo agenda: Integer, c ́odigo u ́nico para identificar una agenda, admite nulos.
     */

    return $str;
}
function parse_fecha_empleado($arr){
    /**
     * Fecha: Date, fecha de reserva, admite nulo.
     */
    return 0;
}
function parse_monto_empleado($arr){
    /**
     * Monto: Float, precio en pesos de la reserva, no nulo..
     */
    return 0;
}
function parse_cantidad_personas_empleado($arr){
    /**
     * Cantidad personas: Integer, cantidad de personas de la reserva, admite nulo.
     */
    return 0;
}
function parse_estado_disponibilidad($str){
    /**
     * Estado disponibilidad: Boolean, estado que representa si la reserva ha sido tomada 
     * admite nulo.
     * Disponible o No disponible
     */
    if ($str == NULL || $str == "Disponible" || $str == "No Disponible"){
        return $str;
    }else{
        return FALSE;
    }
}
function parse_numero_viaje_empleado($str){
    /**
     * Numero viaje: Integer, identificador del viaje, no nulo.
     */
    if ($str == NULL){
        return FALSE;
    } else{
        return $str;
    }
    }
function parse_lugar_origen_llegada($str){
    /**
     * Lugar origen: String, solo admite letras (sin s ́ımbolos), admite nulo.
     * Documentacion:
     * https://www.php.net/manual/es/function.preg-replace.php
     */
    if ($str == NULL){
        return $str;
    }else{
        $str =  preg_replace("/[^a-zA-ZáéíóúÁÉÍÓÚñÑ]/u", "", $str);
        return $str; 
    }
}
function parse_lugar_llegada_empleado($arr){
    /**
     * Lugar llegada: String, solo admite letras (sin s ́ımbolos), admite nulo.
     */
    return 0;
}
function parse_fecha_salida_empleado($arr){
    /**
     * Fecha salida: Date, fecha de comienzo del transporte, admite nulo.
     */
    return 0;
}
function parse_fecha_llegada_empleado($str){
    /**
     * Fecha llegada: Date, fecha de llegada del transporte, no nulo.
     * Consideraciones:
     * Igual que cualquier otra fecha, simplemente no admite nulo
     * ADMITE NULO
     * Debe tener formato YYYY-MM-DD
     * Para preservar la mayor cantidad de datos si un string 
     * Documentacion:
     * https://www.php.net/manual/es/function.preg-replace.php
     */
    if ($str == NULL){
        return FALSE;
    }
    $numero_saneado = preg_replace('/[^0-9]/', '', $str);
    $largo_num = strlen($numero_saneado);
    $numero_saneado =substr($numero_saneado, 0, 4)."-".substr($numero_saneado,4,2)."-".substr(
        $numero_saneado, 6);
    return $numero_saneado;
}
function parse_capacidad_empleado($str){
    /**
     * Capacidad: Integer, cantidad m ́axima del viaje, admite nulo.
     * Consideraciones:
     * se toman todos los numeros de la string
     * si es nulo se retorna inmediatamente
     * Documentacion:
     * https://www.php.net/manual/es/function.preg-replace.php
     */
    if ($str == NULL){
        return NULL;
    }else{
        $numero_saneado = preg_replace('/[^0-9]/', '', $str);
        return $numero_saneado;
    }
}
function parse_tiempo_estimado($str){
    /**
     * Tiempo estimado: Integer, tiempo en minutos del viaje, admite nulo..
     * Consideraciones:
     * se toman todos los numeros de la string
     * si es nulo se retorna inmediatamente ADMITE NULO
     * Documentacion:
     * https://www.php.net/manual/es/function.preg-replace.php
     */
    if ($str == NULL){
        return NULL;
    }else{
        $numero_saneado = preg_replace('/[^0-9]/', '', $str);
        return $numero_saneado;
    }
}

function parse_precio_asiento($str){
    /**
     * Precio asiento: Integer, valor individual del viaje, no nulo.
     * Consideraciones:
     * si el string es null no es valido
     * si no se limpia e caso de que tenga caracteres invalidos
     * Documentacion:
     * https://www.php.net/manual/es/function.preg-replace.php
     */
    if ($str == NULL){
        return FALSE;
    }else{
        $numero_saneado = preg_replace('/[^0-9]/', '', $str);
        return $numero_saneado;
    }
}
function parse_empresa($str){
    /**
     * Empresa: String, empresa de transporte, admite nulo.
     */
    if ($str == NULL){
        return NULL;
    }else{
        return $str;
    }
}
function parse_tipo_bus($str){
    /**
     * Tipo de bus: String, normal, semi-cama o cama, admite nulos.
     * Consideraciones:
     * Admite normal, semi-cama, cama y nulos
     * Se limpia el string de sibolos que no sean -
     * Documentacion:
     * https://www.php.net/manual/es/function.preg-replace.php
     */
    if ($str == NULL || $str == ""){
        return NULL;
    }
    $str_saneado = preg_replace('/[^a-zA-ZáéíóúÁÉÍÓÚñÑ-]/u', '', $str);
    if ($str_saneado == "normal" || $str_saneado == "semi-cama" || $str_saneado == "cama"){
        return $str_saneado;
    }
}
function parse_comodidades($str){
    /**
     * Comodidades: String array, lista de comodidades del transporte, admite nulos.
     */
    if ($str == NULL){
        return NULL;
    }else{
        return $str;
    }
}
function parse_escalas($str){
    /**
     * Escalas: String array, lista de escalas de un avi ́on, admite nulos.
     */
    if ($str == NULL){
        return NULL;
    }else{
        return $str;
    }
}
function parse_clase($str){
    /**
     * Clase: String, tipo de asiento en avi ́on (primera clase, clase ejecutiva, clase econ ́omica), 
     * admite nulos
     * Consideraciones:
     * Admite primera clase, clase ejecutiva, clase economica y nulo
     * Se limpia el string de sibolos
     * Documentacion:
     * https://www.php.net/manual/es/function.preg-replace.php
     */
    if ($str == NULL){
        return NULL;
    }
    $str_saneado = preg_replace('/[^a-zA-ZáéíóúÁÉÍÓÚñÑ]/u', '', $str);
    if ($str_saneado == "primera clase" || $str_saneado == "clase ejecutiva"
     || $str_saneado == "clase económica"){
        return $str_saneado;
    }
}
function parse_paradas($str){
    /**
     * Paradas: String array, lista de paradas de un tren, admite nulos.
     */
    if ($str == NULL){
        return NULL;
    }else{
        return $str;
    }
}
function parse_empleados($arr){
    /**
     * Parse Empleados
     * Consideraciones:
     * Algunos datos usan funciones que se usaron para limpiar usuarios_rescatados.csv
     * Documentacion:
     */
    global $archivo_mal_empleados;

    $correctitud = TRUE;
    $arr_correcto =[];
    $bool_nombre_empleado=parse_nombre($arr[0]);
    $bool_rut_empleado = parse_rut($arr[1]);
    $bool_dv_empleado = parse_dv($arr[2]);
    $bool_correo_empleado = parse_correo($arr[3]);
    $bool_username_empleado = parse_username($arr[4]);
    $bool_contrasena_empleado = parse_contrasena($arr[5]);
    $bool_telefono_empleado = parse_telefono($arr[6]);
    $bool_jornada_empleado = parse_jornada_empleado($arr[7]); 
    $bool_isapre_empleado = parse_isapre_empleado($arr[8]); 
    $bool_contrato_empleado = parse_contrato_empleado($arr[9]); 
    $bool_codigo_reserva_empleado = parse_codigo_reserva($arr[10]);
    $bool_codigo_agenda_empleado = parse_codigo_agenda_empleado($arr[11]);
    $bool_fecha_empleado = parse_fecha($arr[12]); # ADMITE NULO
    $bool_monto_empleado = parse_monto($arr[13]);
    $bool_cantidad_personas_empleado = parse_cantidad_personas($arr[14]);
    $bool_estado_disponibilidad_empleado = parse_estado_disponibilidad($arr[15]); # NUEVO
    $bool_numero_viaje_empleado = parse_numero_viaje_empleado($arr[16]); # NUEVO
    $bool_lugar_origen_empleado = parse_lugar_origen_llegada($arr[17]); # NUEVO
    $bool_lugar_llegada_empleado = parse_lugar_origen_llegada($arr[18]); # NUEVO
    $bool_fecha_salida_empleado = parse_fecha($arr[19]); # MISMO FORMATO QUE FECHA???
    $bool_fecha_llegada_empleado = parse_fecha_llegada_empleado($arr[20]); # NO ADMITE NULO 
    $bool_capacidad_empleado = parse_capacidad_empleado($arr[21]); # NUEVO
    $bool_tiempo_estimado_empleado = parse_tiempo_estimado($arr[22]); # NUEVO
    $bool_precio_asiento = parse_precio_asiento($arr[23]); # NUEVO SE PUEDE HACER COMO OTROS FLOAT???
    $bool_empresa_empleado = parse_empresa($arr[24]); # NUEVO
    $bool_tipo_bus_empleado = parse_tipo_bus($arr[25]); # NUEVO
    $bool_comodidades_empleado = parse_comodidades($arr[26]); # NUEVO LISTA
    $bool_escalas_empleado = parse_escalas($arr[27]); # NUEVO LISTA
    $bool_clase_empleado = parse_clase($arr[28]); # NUEVO
    $bool_paradas_empleado = parse_paradas($arr[29]); # NUEVO LISTA
    /**
     * en todos los casos que retorne FALSE es por que es no valido por lo tanto la fila entera se 
     * agrega al archivo de error
     */
    if ($bool_nombre_empleado !== FALSE){
        //echo "NOMBRE empleado: $bool_nombre_empleado\n";
        array_push($arr_correcto, $bool_nombre_empleado);
    }else{echo "NOMBRE empleado mal\n";$correctitud = FALSE; array_push($arr_correcto, "");}

    if ($bool_rut_empleado != FALSE AND $bool_dv_empleado != FALSE){   
        $is_rut = confirm_rut($bool_rut_empleado, $bool_dv_empleado);
        if ($is_rut != FALSE){
            //echo "RUT: $bool_rut_empleado-$bool_dv_empleado \n";
            array_push($arr_correcto, $bool_rut_empleado);
            array_push($arr_correcto, $bool_dv_empleado);
        }}else{echo "RUT: mal\n";$correctitud = FALSE;array_push($arr_correcto, "");array_push($arr_correcto, "");}# lo meto en el archivo de error y salgo de la funcion
    
    if ($bool_correo_empleado !== FALSE){
        //echo "CORREO empleado: $bool_correo_empleado\n";
        array_push($arr_correcto, $bool_correo_empleado);
    } else{echo "CORREO empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_username_empleado !== FALSE){
        //echo "USERNAME empleado: $bool_username_empleado\n";
        array_push($arr_correcto, $bool_username_empleado);
    }else{echo "USERNAME empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_contrasena_empleado !== FALSE){
        //echo "contrasena empleado: $bool_contrasena_empleado\n";
        array_push($arr_correcto, $bool_contrasena_empleado);
    }else{echo "contrasena mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}
    
    if ($bool_telefono_empleado !== FALSE){
        //echo "TELEFONO empleado: $bool_telefono_empleado\n";
        array_push($arr_correcto, $bool_telefono_empleado);
    }else{echo "TELEFONO empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_jornada_empleado !== FALSE){
       //echo "JORNADA empleado: $bool_jornada_empleado\n";
       array_push($arr_correcto, $bool_jornada_empleado);
    }else{echo "JORNADA empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_isapre_empleado !== FALSE){
        //echo "ISAPRE empleado: $bool_isapre_empleado\n";
        array_push($arr_correcto, $bool_isapre_empleado);
    }else{echo "ISAPRE empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_contrato_empleado !== FALSE){
        //echo "CONTRATO empleado: $bool_contrato_empleado\n";
        array_push($arr_correcto, $bool_contrato_empleado);
    }else{echo "CONTRATO empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_codigo_reserva_empleado !== FALSE){
        //echo "CODIGO RESERVA: $bool_codigo_reserva_empleado\n";
        array_push($arr_correcto, $bool_codigo_reserva_empleado);
    }else{echo "CODIGO RESERVA mal\n";$correctitud = FALSE;array_push($arr_correcto, "");} 

    if ($bool_codigo_agenda_empleado !== FALSE){
        //echo "CODIGO AGENDA: $bool_codigo_agenda_empleado\n";
        array_push($arr_correcto, $bool_codigo_agenda_empleado);
    }else{echo "CODIGO AGENDA mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_fecha_empleado !== FALSE){
        //echo "FECHA empleado: $bool_fecha_empleado\n";
        array_push($arr_correcto, $bool_fecha_empleado);
    }else{echo "FECHA empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_monto_empleado !== FALSE){
        //echo "MONTO empleado: $bool_monto_empleado\n";
        array_push($arr_correcto, $bool_monto_empleado);
    }else{echo "MONTO empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_cantidad_personas_empleado !== FALSE){
        //echo "CANTIDAD PERSONAS: $bool_cantidad_personas_empleado\n";
        array_push($arr_correcto, $bool_cantidad_personas_empleado);
    }else{echo "CANTIDAD PERSONAS mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_estado_disponibilidad_empleado !== FALSE){
        //echo "ESTADO DISPONIBILIDAD empleado: $bool_estado_disponibilidad_empleado\n";
        array_push($arr_correcto, $bool_estado_disponibilidad_empleado);
    }else{echo "ESTADP DISPONIBILIDAD empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_numero_viaje_empleado !== FALSE){
        //echo "NUMERO VIAJE empelado: $bool_numero_viaje_empleado\n";
        array_push($arr_correcto, $bool_numero_viaje_empleado);
    }else{echo "NUMERO VIAJE empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_lugar_origen_empleado !== FALSE){
       //echo "lugar origen empleado: $bool_lugar_origen_empleado\n";
       array_push($arr_correcto, $bool_lugar_origen_empleado);
    }else{echo "lugar origen mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_lugar_llegada_empleado !== FALSE){
        //echo "lugar llegada empleado: $bool_lugar_llegada_empleado\n";
        array_push($arr_correcto, $bool_lugar_llegada_empleado);
    }else{echo "lugar llegada empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_fecha_salida_empleado !== FALSE){
        //echo "fecha salida empleado: $bool_fecha_salida_empleado\n";
        array_push($arr_correcto, $bool_fecha_salida_empleado);
    }else{echo "fecha salida empleado: mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_fecha_llegada_empleado !== FALSE){
        //echo "fecha llegada empleado: $bool_fecha_llegada_empleado\n";
        array_push($arr_correcto, $bool_fecha_llegada_empleado);
    }else{echo "fecha llegada empleado: mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_capacidad_empleado !== FALSE){
        //echo "capacidad empleado: $bool_capacidad_empleado\n";
        array_push($arr_correcto, $bool_capacidad_empleado);
    }else{echo "capacidad empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_tiempo_estimado_empleado !== FALSE){
        //echo "tiempo estimado empleado: $bool_tiempo_estimado_empleado\n";
        array_push($arr_correcto, $bool_tiempo_estimado_empleado);
    }else{echo "tiempo estimado empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_precio_asiento !== FALSE){
        //echo "precio asiento: $bool_precio_asiento\n";
        array_push($arr_correcto, $bool_precio_asiento);
    }else{echo "precio asiento mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_empresa_empleado !== FALSE){
        //echo "empresa empleado: $bool_empresa_empleado\n";
        array_push($arr_correcto, $bool_empresa_empleado);
    }else{echo "empresa empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_tipo_bus_empleado !== FALSE){
        //echo "tipo bus empleado: $bool_tipo_bus_empleado\n";
        array_push($arr_correcto, $bool_tipo_bus_empleado);
    }else{echo "tipo bus mal $bool_tipo_bus_empleado\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_comodidades_empleado !== FALSE){
        //echo "comodidades empleado: $bool_comodidades_empleado\n";
        array_push($arr_correcto, $bool_comodidades_empleado);
    }else{echo "comodidades empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_escalas_empleado !== FALSE){
        //echo "escalas empleado: $bool_escalas_empleado\n";
        array_push($arr_correcto, $bool_escalas_empleado);
    }else{echo "escalas empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_clase_empleado !== FALSE){
        //echo "clase empleado: $bool_clase_empleado\n";
        array_push($arr_correcto, $bool_clase_empleado);
    }else{echo "clase empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    if ($bool_paradas_empleado !== FALSE){
        //echo "paradas empleado: $bool_paradas_empleado\n";
        array_push($arr_correcto, $bool_paradas_empleado);
    }else{echo "paradas empleado mal\n";$correctitud = FALSE;array_push($arr_correcto, "");}

    //var_dump($arr_correcto);
    if ($correctitud == FALSE){
        fputcsv($archivo_mal_empleados, $arr_correcto, ",", '"', "\\");
        return "";
    }else{
        return $arr_correcto;
    }
    echo "\n";
   


}
?>

