<?php
/**
 * VARIABLES GLOBALES
 * Documentacion:
 * https://www.php.net/manual/es/reserved.variables.globals.php
 */
$key_personasOK=[]; # Key: correo
$key_usuariosOK=[]; # Key: correo
$key_agendaOK=[]; # Key: agenda 
$key_empleadosOK=[]; #
$key_reservasOK=[]; # codigo_agenda codigo_reserva
$key_transportesOK=[];
$key_busesOK=[];
$key_trenesOK=[];
$key_avionesOK=[];
$arreglo_codigos_agenda=[];
$arreglo_codigos_reservas=[];
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
    if (empty($str)){
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
    if (empty($str)){
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
    if (empty($str)){
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
    if (empty($str)){
        return 0;
    }else if ($str < 0){
        return $str*-1;
    }else{
        return $str;
    }
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
    if (empty($str)){
        $str=0;
        array_push($arreglo_codigos_agenda, $str);
        return $str;
    } else if ($str <0){
        $str=$str*-1;
    }
    if(in_array($str, $arreglo_codigos_agenda)!=TRUE){
        array_push($arreglo_codigos_agenda, $str);
        return $str;
    } else{
        return FALSE;
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
    global $arreglo_codigos_reservas;
    if (empty($str)){
        $str=0;
        array_push($arreglo_codigos_reservas, $str);
        return $str;
    } else if ($str <0){
        $str=$str*-1;
    }
    if(in_array($str, $arreglo_codigos_reservas)!=TRUE){
        array_push($arreglo_codigos_reservas, $str);
        return $str;
    } else{
        return FALSE;
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
    if (empty($str)){
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
    if (empty($str)){
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
        return "";
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
     if (empty($str) || $str == "Part time" || $str == "Full time"){
        return $str;
    } else{
        return FALSE;
    }

    return 0;
}
function parse_codigo_reserva_empleado($str){
    /** 
     * Codigo reserva: Integer, co ́digo u ́nico para identificar una reserva, no nulo. 
     */   
    if (empty($str)){
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
    if (empty($str)|| $str == "Disponible" || $str == "No Disponible"){
        return $str;
    }else{
        return FALSE;
    }
}
function parse_numero_viaje_empleado($str){
    /**
     * Numero viaje: Integer, identificador del viaje, no nulo.
     */
    if (empty($str)){
        return FALSE;
    } else if ($str <0){
        $str=$str*-1;
        return $str;
    } else{
        return $str;
    }
}
function parse_lugar_origen_llegada($str){
    /**
     * Lugar origen: String, solo admite letras (sin s ́ımbolos), admite nulo.
     * Documentacion:
     * https://www.php.net/manual/es/function.preg-replace.php
     * https://www.php.net/manual/es/function.empty.php
     */
    if (empty($str)) {
        return NULL;
    } else {
        $str = preg_replace("/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/u", "", $str);
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
        return 0;
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
     *
     */
    $str_saneado=$str;
   
    if ($str_saneado == "Normal" || $str_saneado == "Semi-cama" || $str_saneado == "Cama" 
    || $str_saneado==""){
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

    $str_saneado =$str; 
    if ($str_saneado == "Primera clase" || $str_saneado == "Clase ejecutiva"
     || $str_saneado == "Clase económica"|| $str_saneado==""){
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
function add_personas_OK($nombre, $rut, $dv, $correo, $contrasena, $username, $telefono){
    global $key_personasOK;
    $personas_OK=[];
    $nombre=parse_nombre($nombre);
    $rut=parse_rut($rut);
    $dv=parse_dv($dv);
    $correo=parse_correo($correo);
    $contrasena=parse_contrasena($contrasena);
    $username=parse_username($username);
    $telefono=parse_telefono($telefono);
    $correctitud = TRUE;
    if ($rut != FALSE && $dv != FALSE){
        if(confirm_rut($rut, $dv) != FALSE && $nombre != FALSE && $correo != FALSE 
        && $contrasena != FALSE && $username != FALSE && $telefono != FALSE 
        && in_array($correo , $key_personasOK) != TRUE){
            array_push($key_personasOK, $correo);
            array_push($personas_OK, $nombre);
            array_push($personas_OK, $rut);
            array_push($personas_OK, $dv);
            array_push($personas_OK, $correo);
            array_push($personas_OK, $contrasena);
            array_push($personas_OK, $username);
            array_push($personas_OK, $telefono);
            return $personas_OK;
        } else{
            return FALSE;
        }
    } 
}
function add_usuarios_OK($nombre, $rut, $dv, $correo, $contrasena, $username, $telefono, $puntos){
    global $key_usuariosOK;
    $personas_OK=[];
    $nombre=parse_nombre($nombre);
    $rut=parse_rut($rut);
    $dv=parse_dv($dv);
    $correo=parse_correo($correo);
    $contrasena=parse_contrasena($contrasena);
    $username=parse_username($username);
    $telefono=parse_telefono($telefono); 
    $puntos=parse_puntos($puntos);
    if ($rut != FALSE && $dv != FALSE){
        if(confirm_rut($rut, $dv) != FALSE && $nombre != FALSE && $correo != FALSE 
        && $contrasena != FALSE && $username != FALSE && $telefono != FALSE && $puntos != FALSE
        && in_array($correo , $key_usuariosOK) != TRUE){
            array_push($key_usuariosOK, $correo);
            array_push($personas_OK, $nombre);
            array_push($personas_OK, $rut);
            array_push($personas_OK, $dv);
            array_push($personas_OK, $correo);
            array_push($personas_OK, $contrasena);
            array_push($personas_OK, $username);
            array_push($personas_OK, $telefono);
            array_push($personas_OK, $puntos);
            return $personas_OK;
        } else{
            return FALSE;
        } 
    }
}


function add_empleados_OK($nombre, $rut, $dv, $correo, $contrasena, $username, $telefono, $jornada,
$isapre, $contrato){
    global $key_empleadosOK;
    $empleados_OK=[];
    $nombre=parse_nombre($nombre);
    $rut=parse_rut($rut);
    $dv=parse_dv($dv);
    $correo=parse_correo($correo);
    $contrasena=parse_contrasena($contrasena);
    $username=parse_username($username);
    $telefono=parse_telefono($telefono); 
    $jornada=parse_jornada_empleado($jornada);
    $isapre=parse_isapre_empleado($isapre);
    $contrato=parse_contrato_empleado($contrato);
    if ($rut != FALSE && $dv != FALSE){
        if(confirm_rut($rut, $dv) != FALSE && $nombre != FALSE && $correo != FALSE 
        && $contrasena != FALSE && $username != FALSE && $telefono != FALSE 
        && $jornada!=FALSE && $isapre!=FALSE && $contrato!=FALSE 
        && in_array($correo , $key_empleadosOK) != TRUE){
            array_push($key_empleadosOK, $correo);
            array_push($empleados_OK, $nombre);
            array_push($empleados_OK, $rut);
            array_push($empleados_OK, $dv);
            array_push($empleados_OK, $correo);
            array_push($empleados_OK, $contrasena);
            array_push($empleados_OK, $username);
            array_push($empleados_OK, $telefono);
            array_push($empleados_OK, $jornada);
            array_push($empleados_OK, $isapre);
            array_push($empleados_OK, $contrato);
            return $empleados_OK;
        } else{
            return FALSE;
        } 
    } 
}
function add_agenda_OK($correo, $codigo_agenda, $etiqueta){
    global $key_agendaOK;
    $agenda_OK=[];
    $correo=parse_correo($correo);
    $codigo_agenda=parse_codigo_agenda($codigo_agenda);
    $etiqueta=parse_etiqueta($etiqueta);
    if ($correo!=FALSE && $codigo_agenda!=FALSE && $etiqueta!=FALSE && 
    in_array($codigo_agenda, $key_agendaOK)!=TRUE){
        array_push($key_agendaOK, $codigo_agenda);
        array_push($agenda_OK, $correo);
        array_push($agenda_OK, $codigo_agenda);
        array_push($agenda_OK, $etiqueta);
        return $agenda_OK;
    }else{
        return FALSE;
    }
}

function add_reservas_OK($codigo_agenda, $codigo_reserva, $fecha, $monto, $cantidad_personas, $estado){
    global $key_reservasOK;
    $key=[];
    $arr_reservasOK=[];
    $codigo_agenda=parse_codigo_agenda_empleado($codigo_agenda);
    $codigo_reserva=parse_codigo_reserva_empleado($codigo_reserva);
    $fecha=parse_fecha($fecha);
    $monto=parse_monto($monto);
    $cantidad_personas=parse_cantidad_personas($cantidad_personas);
    $estado=parse_estado_disponibilidad($estado);
    array_push($key, $codigo_agenda);
    array_push($key, $codigo_reserva);
    array_push($key, $estado);
    if($codigo_agenda!==FALSE && $codigo_reserva!==FALSE && $fecha!==FALSE && $monto!==FALSE && 
    $cantidad_personas!==FALSE && $estado!==FALSE && in_array($key, $key_reservasOK)!=TRUE ){
        array_push($key_reservasOK, $key);
        array_push($arr_reservasOK, $codigo_agenda);
        array_push($arr_reservasOK, $codigo_reserva);
        array_push($arr_reservasOK, $fecha);
        array_push($arr_reservasOK, $monto);
        array_push($arr_reservasOK, $cantidad_personas);
        array_push($arr_reservasOK, $estado);
        return  $arr_reservasOK;
    } else{
        return FALSE;
    }


}
function add_transportes_OK($correo, $codigo_reserva, $numero_viaje, $lugar_origen, $lugar_destino,
$capacidad, $tiempo_estimado, $precio_asiento, $empresa, $fecha_salida, $fecha_llegada){
    global $key_transportesOK;
    $key=[];
    $arr_transportesOK=[];

    $correo=parse_correo($correo);
    $codigo_reserva=parse_codigo_reserva_empleado($codigo_reserva);
    $numero_viaje=parse_numero_viaje_empleado($numero_viaje);
    $lugar_origen=parse_lugar_origen_llegada($lugar_origen);
    $lugar_destino=parse_lugar_origen_llegada($lugar_destino);
    $capacidad=parse_capacidad_empleado($capacidad);
    $tiempo_estimado=parse_tiempo_estimado($tiempo_estimado);
    $precio_asiento=parse_precio_asiento($precio_asiento);
    $empresa=parse_empresa($empresa);
    $fecha_salida=parse_fecha($fecha_salida);
    $fecha_llegada=parse_fecha($fecha_llegada);

    array_push($key, $correo);
    array_push($key, $codigo_reserva);

    if($correo!==FALSE && $codigo_reserva!==FALSE && $numero_viaje!==FALSE && $lugar_origen!==FALSE
    && $lugar_destino!==FALSE && $capacidad!==FALSE && $tiempo_estimado!==FALSE && 
    $precio_asiento!==FALSE && $empresa!==FALSE && $fecha_salida!==FALSE && $fecha_llegada!==FALSE
    && in_array($key, $key_transportesOK)!=TRUE){
        array_push($key_transportesOK, $key);
        array_push($arr_transportesOK, $correo);
        array_push($arr_transportesOK, $codigo_reserva);
        array_push($arr_transportesOK, $numero_viaje);
        array_push($arr_transportesOK, $lugar_origen);
        array_push($arr_transportesOK, $lugar_destino);
        array_push($arr_transportesOK, $capacidad);
        array_push($arr_transportesOK, $tiempo_estimado);
        array_push($arr_transportesOK, $precio_asiento);
        array_push($arr_transportesOK, $empresa);
        array_push($arr_transportesOK, $tiempo_estimado);
        array_push($arr_transportesOK, $fecha_salida);
        array_push($arr_transportesOK, $fecha_llegada);
        return $arr_transportesOK;
    }else{
        return FALSE;
    }

}

function add_buses_OK($correo, $codigo_reserva, $numero_viaje, $lugar_origen, $lugar_destino,
$capacidad, $tiempo_estimado, $precio_asiento, $empresa, $tipo, $comodidades, $fecha_salida,
$fecha_llegada){
    global $key_busesOK;
    $key=[];
    $arr_busesOK=[];

    $correo=parse_correo($correo);
    $codigo_reserva=parse_codigo_reserva_empleado($codigo_reserva);
    $numero_viaje=parse_numero_viaje_empleado($numero_viaje);
    $lugar_origen=parse_lugar_origen_llegada($lugar_origen);
    $lugar_destino=parse_lugar_origen_llegada($lugar_destino);
    $capacidad=parse_capacidad_empleado($capacidad);
    $tiempo_estimado=parse_tiempo_estimado($tiempo_estimado);
    $precio_asiento=parse_precio_asiento($precio_asiento);
    $empresa=parse_empresa($empresa);
    $tipo=parse_tipo_bus($tipo);
    $comodidades=parse_comodidades($comodidades);
    $fecha_salida=parse_fecha($fecha_salida);
    $fecha_llegada=parse_fecha($fecha_llegada);

    array_push($key, $correo);
    array_push($key, $codigo_reserva);

    if($correo!==FALSE && $codigo_reserva!==FALSE && $numero_viaje!==FALSE && $lugar_origen!==FALSE
    && $lugar_destino!==FALSE && $capacidad!==FALSE && $tiempo_estimado!==FALSE && $empresa!==FALSE
    && $tipo!==FALSE && $fecha_salida!==FALSE && $fecha_llegada!==FALSE && 
    in_array($key, $key_busesOK)!=TRUE){
        array_push($key_busesOK, $key);
        array_push($arr_busesOK, $correo); 
        array_push($arr_busesOK, $codigo_reserva);
        array_push($arr_busesOK, $numero_viaje);
        array_push($arr_busesOK, $lugar_origen);
        array_push($arr_busesOK, $lugar_destino);
        array_push($arr_busesOK, $capacidad);
        array_push($arr_busesOK, $tiempo_estimado);
        array_push($arr_busesOK, $precio_asiento);
        array_push($arr_busesOK, $empresa);
        array_push($arr_busesOK, $tipo);
        array_push($arr_busesOK, $comodidades);
        array_push($arr_busesOK, $fecha_salida);
        array_push($arr_busesOK, $fecha_llegada);
        return $arr_busesOK;
    } else{
        return FALSE;
    }

}
function add_trenes_OK($correo, $codigo_reserva, $numero_viaje, $lugar_origen, $lugar_destino,
$capacidad, $tiempo_estimado, $precio_asiento, $empresa, $comodidades, $paradas, $fecha_salida,
$fecha_llegada){
    global $key_trenesOK;
    $key=[];
    $arr_trenesOK=[];

    $correo=parse_correo($correo);
    $codigo_reserva=parse_codigo_reserva_empleado($codigo_reserva);
    $numero_viaje=parse_numero_viaje_empleado($numero_viaje);
    $lugar_origen=parse_lugar_origen_llegada($lugar_origen);
    $lugar_destino=parse_lugar_origen_llegada($lugar_destino);
    $capacidad=parse_capacidad_empleado($capacidad);
    $tiempo_estimado=parse_tiempo_estimado($tiempo_estimado);
    $precio_asiento=parse_precio_asiento($precio_asiento);
    $empresa=parse_empresa($empresa);
    $comodidades=parse_comodidades($comodidades);
    $paradas=parse_paradas($paradas);
    $fecha_salida=parse_fecha($fecha_salida);
    $fecha_llegada=parse_fecha($fecha_llegada);

    array_push($key, $correo);
    array_push($key, $codigo_reserva);

    if($correo!==FALSE && $codigo_reserva!==FALSE && $numero_viaje!==FALSE && $lugar_origen!==FALSE
    && $lugar_destino!==FALSE && $capacidad!==FALSE && $tiempo_estimado!==FALSE && $precio_asiento!==FALSE 
    && $empresa!==FALSE && $comodidades!==FALSE && $paradas!==FALSE && $fecha_salida!==FALSE 
    && $fecha_llegada!==FALSE && in_array($key, $key_trenesOK)!=TRUE){
        array_push($key_trenesOK, $key);
        array_push($arr_trenesOK, $correo); 
        array_push($arr_trenesOK, $codigo_reserva);
        array_push($arr_trenesOK, $numero_viaje);
        array_push($arr_trenesOK, $lugar_origen);
        array_push($arr_trenesOK, $lugar_destino);
        array_push($arr_trenesOK, $capacidad);
        array_push($arr_trenesOK, $tiempo_estimado);
        array_push($arr_trenesOK, $precio_asiento);
        array_push($arr_trenesOK, $empresa);
        array_push($arr_trenesOK, $comodidades);
        array_push($arr_trenesOK, $paradas);
        array_push($arr_trenesOK, $fecha_salida);
        array_push($arr_trenesOK, $fecha_llegada);
        return $arr_trenesOK;
    } else{
        return FALSE;
    }
}
function add_aviones_OK($correo, $codigo_reserva, $numero_viaje, $lugar_origen, $lugar_destino,
$capacidad, $tiempo_estimado, $precio_asiento, $empresa, $escalas, $clase, $fecha_salida,
$fecha_llegada){
    global $key_avionesOK;
    $key=[];
    $arr_avionesOK=[];

    $correo=parse_correo($correo);
    $codigo_reserva=parse_codigo_reserva_empleado($codigo_reserva);
    $numero_viaje=parse_numero_viaje_empleado($numero_viaje);
    $lugar_origen=parse_lugar_origen_llegada($lugar_origen);
    $lugar_destino=parse_lugar_origen_llegada($lugar_destino);
    $capacidad=parse_capacidad_empleado($capacidad);
    $tiempo_estimado=parse_tiempo_estimado($tiempo_estimado);
    $precio_asiento=parse_precio_asiento($precio_asiento);
    $empresa=parse_empresa($empresa);
    $escalas=parse_escalas($escalas);
    $clase=parse_clase($clase);
    $fecha_salida=parse_fecha($fecha_salida);
    $fecha_llegada=parse_fecha($fecha_llegada);

    array_push($key, $correo);
    array_push($key, $codigo_reserva);

    if($correo!==FALSE && $codigo_reserva!==FALSE && $numero_viaje!==FALSE && $lugar_origen!==FALSE
    && $lugar_destino!==FALSE && $capacidad!==FALSE && $tiempo_estimado!==FALSE && $precio_asiento!==FALSE 
    && $empresa!==FALSE && $escalas!==FALSE && $clase!==FALSE && $fecha_salida!==FALSE 
    && $fecha_llegada!==FALSE && in_array($key, $key_avionesOK)!=TRUE){
        array_push($key_avionesOK, $key);
        array_push($arr_avionesOK, $correo); 
        array_push($arr_avionesOK, $codigo_reserva);
        array_push($arr_avionesOK, $numero_viaje);
        array_push($arr_avionesOK, $lugar_origen);
        array_push($arr_avionesOK, $lugar_destino);
        array_push($arr_avionesOK, $capacidad);
        array_push($arr_avionesOK, $tiempo_estimado);
        array_push($arr_avionesOK, $precio_asiento);
        array_push($arr_avionesOK, $empresa);
        array_push($arr_avionesOK, $escalas);
        array_push($arr_avionesOK, $clase);
        array_push($arr_avionesOK, $fecha_salida);
        array_push($arr_avionesOK, $fecha_llegada);
        return $arr_avionesOK;
    } else{
        return FALSE;
    }
}


?>

