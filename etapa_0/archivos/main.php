<?php
/**
 * Main
 * Consideraciones:
 * Documentacion:
 * https://www.php.net/manual/es/function.implode.php
 */
require "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/archivos/funciones.php";
$archv_user_resc   = "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_sucios/usuarios_rescatados.csv";
$archv_traba_resc  = "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_sucios/empleados_rescatados.csv";

/**
 * Incializacion de archivos
 */
$ruta_usarios_descartados= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/datos_descartados_usuarios.csv";
$ruta_empleados_descartados= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/datos_descartados_empleados.csv";
$ruta_personas_OK= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/personas_OK.csv";
$ruta_usuarios_OK= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/usuarios_OK.csv";
$ruta_empleados_OK = "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/empleados_OK.csv";
$ruta_agendas_OK= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/agendas_OK.csv";
$ruta_reservas_OK= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/reservas_OK.csv";
$ruta_transportes_OK= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/transportes_OK.csv";
$ruta_buses_OK= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/buses_OK.csv";
$ruta_trenes_OK= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/trenes_OK.csv";
$ruta_aviones_OK= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/bdd_personal/etapa_0/CSV_limpios/aviones_OK.csv";




$file_usuarios_descartados = fopen($ruta_usarios_descartados, "w");
$file_empleados_descartados = fopen($ruta_empleados_descartados, "w");
$file_usuarios_OK = fopen($ruta_usuarios_OK, "w");
$file_personas_OK = fopen($ruta_personas_OK, "w");
$file_empleados_OK = fopen($ruta_empleados_OK, "w");
$file_agendas_OK = fopen($ruta_agendas_OK, "w");
$file_reservas_OK = fopen($ruta_reservas_OK, "w");
$file_transportes_OK = fopen($ruta_transportes_OK, "w");
$file_buses_OK = fopen($ruta_buses_OK, "w");
$file_trenes_OK = fopen($ruta_trenes_OK, "w");
$file_aviones_OK = fopen($ruta_aviones_OK, "w");


$header_usuarios_descartados = ["nombre", "run", "Dv", "Correo", "Nombre_usuario", "Contrasena", 
"Telefono_contacto", "Puntos", "Codigo_agenda", "Etiqueta", "Codigo_reserva", 
"Fecha", "Monto", "Cantidad_personas"];                                
$header_empleados_descartados = ["nombre", "run", "Dv", "Correo", "Nombre_usuario", "Contrasena", 
"Telefono_contacto", "Jornada", "Isapre", "Contrato", "Codigo_reserva", 
"Codigo_agenda", "Fecha", "Monto", "Cantidad_personas", "Estado_disponibilidad", 
"Numero_viaje", "Lugar_origen", "Lugar_llegada", "Fecha_salida", "Fecha_llegada",
"Capacidad", "Tiempo_estimado", "Precio_asiento", "Empresa", "Tipo_de_bus",
"Comodidades", "Escalas", "Clase", "Paradas"];  
$header_usuarios_OK = ["nombre", "run", "Dv", "Correo", "Contrasena", "Nombre_Usuario", 
"Telefono_Contacto"];   
$header_personas_OK = ["nombre", "run", "Dv", "Correo", "Contrasena", "Nombre_Usuario", 
"Telefono_Contacto"];
$header_empleados_OK = ["nombre", "run", "Dv", "Correo", "Contrasena", "Nombre_usuario", 
        "Telefono_contacto", "Jornada", "Isapre", "Contrato"]; 
$header_agendas_OK = ["Correo", "Codigo_Agenda", "Etiqueta"];  
$header_reservas_OK = ["Codigo_agenda", "codigo_reserva", "fecha", "monto", "cantidad_personas",
"estado_disponibilidad"];
$header_transportes_OK = ["correo_empleado", "codigo_reserva", "numero_viaje", "lugar_origen", 
"lugar_llegada", "capacidad", "tiempo_estimado", "precio_asiento", "empresa", "fecha_salida",
"fecha_llegada"];
$header_buses_OK = ["correo", "codigo_reserva", "numero_viaje", "lugar_origen", "lugar_llegada",
"capacidad", "tiempo_estimado", "precio_asiento", "empresa", "tipo", "comodidades", "fecha_salida",
"fecha_llegada"];
$header_trenes_OK = ["correo", "codigo_reserva", "numero_viaje", "lugar_origen", "lugar_llegada",
"capacidad", "tiempo_estimado", "precio_asiento", "empresa", "comodidades", "paradas", "fecha_salida",
"fecha_llegada"];
$header_aviones_OK = ["correo", "codigo_reserva", "numero_viaje", "lugar_origen", "lugar_llegada",
"capacidad", "tiempo_estimado", "precio_asiento", "empresa", "escalas", "clase", "fecha_salida",
"fecha_llegada"];


fputcsv($file_usuarios_descartados, $header_usuarios_descartados, ",", '"', "\\");
fputcsv($file_empleados_descartados, $header_empleados_descartados, ",", '"', "\\");
fputcsv($file_usuarios_OK, $header_usuarios_OK, ",", '"', "\\");
fputcsv($file_personas_OK, $header_personas_OK, ",", '"', "\\");
fputcsv($file_agendas_OK, $header_agendas_OK, ",", '"', "\\");
fputcsv($file_empleados_OK, $header_empleados_OK, ",", '"', "\\");
fputcsv($file_reservas_OK, $header_reservas_OK, ",", '"', "\\");
fputcsv($file_transportes_OK, $header_transportes_OK, ",", '"', "\\");
fputcsv($file_buses_OK, $header_buses_OK, ",", '"', "\\");
fputcsv($file_trenes_OK, $header_trenes_OK, ",", '"', "\\");
fputcsv($file_aviones_OK, $header_aviones_OK, ",", '"', "\\");


/**
 * Keys
 */
$key_personas_OK_correo=[];

                               

# USUARIOS_RESCATADOS
if (($archivo = fopen($archv_user_resc, "r")) !== FALSE){
    while (($arr= fgetcsv($archivo, NULL,',', '"', "\\")) !== FALSE){
        $arr_personas_OK=add_personas_OK($arr[0], $arr[1], $arr[2], $arr[3], $arr[5], $arr[4], $arr[6]);
        $arr_usuarios_OK=add_usuarios_OK($arr[0], $arr[1], $arr[2], $arr[3], $arr[5], $arr[4], $arr[6], $arr[7]);
        $arr_agenda_OK=add_agenda_OK($arr[3], $arr[8], $arr[9]);
        $arr_reservas_OK=add_reservas_OK($arr[8], $arr[10], $arr[11], $arr[12], $arr[13], "");
        if ($arr_personas_OK!=FALSE){
            fputcsv($file_personas_OK, $arr_personas_OK, ",", '"', "\\"); 
        } 
        if ($arr_usuarios_OK!=FALSE){
            fputcsv($file_usuarios_OK, $arr_usuarios_OK, ",", '"', "\\"); 
        }
        if ($arr_agenda_OK!=FALSE){
            fputcsv($file_agendas_OK, $arr_agenda_OK, ",", '"', "\\"); 
        }
        if ($arr_reservas_OK!=FALSE){
            fputcsv($file_reservas_OK, $arr_reservas_OK, ",", '"', "\\"); 
        }
        if($arr_personas_OK==FALSE || $arr_usuarios_OK==FALSE || $arr_agenda_OK==FALSE){
            fputcsv($file_usuarios_descartados, $arr, ",", '"', "\\");
        }

                    
    }
}else{
    echo "archivo usuarios rescatados no existe";
}
# cerramos archivos
fclose($archivo);


if (($archivo_2 = fopen($archv_traba_resc, "r")) !== FALSE){
    while (($arr= fgetcsv($archivo_2 , NULL, ",", '"', "\\")) !== FALSE){
        $arr_empleados_OK=add_empleados_OK($arr[0], $arr[1], $arr[2], $arr[3], $arr[5], $arr[4], $arr[6], $arr[7], 
        $arr[8], $arr[9]);
        $arr_personas_OK=add_personas_OK($arr[0], $arr[1], $arr[2], $arr[3], $arr[5], $arr[4], $arr[6]);
        $arr_reservas_OK=add_reservas_OK($arr[11], $arr[10], $arr[12], $arr[13], $arr[14], $arr[15]);
        $arr_transportes_OK=add_transportes_OK($arr[3], $arr[10], $arr[16], $arr[17], $arr[18],
            $arr[21], $arr[22], $arr[23], $arr[24], $arr[19], $arr[20]);
        $arr_buses_OK=add_buses_OK($arr[3], $arr[10], $arr[16], $arr[17], $arr[18], $arr[21], $arr[22],
            $arr[23], $arr[24], $arr[25], $arr[26], $arr[19], $arr[20]);
        $arr_trenes_OK=add_trenes_OK($arr[3], $arr[10], $arr[16], $arr[17], $arr[18], $arr[21], $arr[22],
            $arr[23], $arr[24], $arr[26], $arr[29], $arr[19], $arr[20]);
        $arr_aviones_OK=add_aviones_OK($arr[3], $arr[10], $arr[16], $arr[17], $arr[18], $arr[21], $arr[22],
            $arr[23], $arr[24], $arr[27], $arr[28], $arr[19], $arr[20]);
        if($arr_empleados_OK!=FALSE){
            fputcsv($file_empleados_OK, $arr_empleados_OK, ",", '"', "\\"); 
        }
        if($arr_personas_OK!=FALSE){
            fputcsv($file_personas_OK, $arr_personas_OK, ",", '"', "\\"); 
        }
        if($arr_reservas_OK!=FALSE){
            fputcsv($file_reservas_OK, $arr_reservas_OK, ",", '"', "\\"); 
        }
        if($arr_transportes_OK!=FALSE){
            fputcsv($file_transportes_OK, $arr_transportes_OK, ",", '"', "\\"); 
        }
        if($arr_buses_OK!==FALSE){
            fputcsv($file_buses_OK, $arr_buses_OK, ",", '"', "\\"); 
        }
        if($arr_trenes_OK!==FALSE){
            fputcsv($file_trenes_OK, $arr_trenes_OK, ",", '"', "\\"); 
        }
        if($arr_aviones_OK!==FALSE){
            fputcsv($file_aviones_OK, $arr_aviones_OK, ",", '"', "\\"); 
        }
        if($arr_empleados_OK===FALSE || $arr_personas_OK===FALSE || $arr_reservas_OK===FALSE 
        || $arr_transportes_OK===FALSE || $arr_buses_OK===FALSE || $arr_trenes_OK===FALSE
        || $arr_aviones_OK===FALSE){
            fputcsv($file_empleados_descartados, $arr, ",", '"', "\\");
        }

        
    }
}else{
        echo "archivo trabajadores rescatados no existe";
}

$num_lineas  = count(file($ruta_empleados_descartados));
$num_lineas0 = count(file($ruta_usarios_descartados));
$num_lineas1 = count(file($ruta_personas_OK));
$num_lineas2 = count(file($ruta_usuarios_OK));
$num_lineas3 = count(file($ruta_empleados_OK));
$num_lineas4 = count(file($ruta_agendas_OK));
$num_lineas5 = count(file($ruta_reservas_OK));
$num_lineas6 = count(file($ruta_transportes_OK));
$num_lineas7 = count(file($ruta_buses_OK));
$num_lineas8 = count(file($ruta_trenes_OK));
$num_lineas9 = count(file($ruta_aviones_OK));
$num_lineas10=count(file($archv_user_resc));
$num_lineas11=count(file($archv_traba_resc));

echo "lineas archivo usuarios original: $num_lineas10\n";
echo "lineas archivo empleados original: $num_lineas11\n";
echo "lineas usuarios_descartados: $num_lineas0\n";
echo "lineas empleados_descartados: $num_lineas\n";
echo "lineas personas_OK: $num_lineas1\n";
echo "lineas usuarios_OK: $num_lineas2\n";
echo "lineas empleados_OK: $num_lineas3\n";
echo "lineas agendas_OK: $num_lineas4\n";
echo "lineas reservas_OK: $num_lineas5\n";
echo "lineas transportes_OK: $num_lineas6\n";
echo "lineas buses_OK: $num_lineas7\n";
echo "lineas trenes_OK: $num_lineas8\n";
echo "lineas aviones_OK: $num_lineas9\n";

fclose($file_personas_OK);
fclose($file_reservas_OK);
fclose($file_transportes_OK);
fclose($file_buses_OK);
fclose($file_trenes_OK);
fclose($file_aviones_OK);
fclose($file_usuarios_OK);
fclose($file_agendas_OK);





?>
