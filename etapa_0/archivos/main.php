<?php
/**
 * Main
 * Consideraciones:
 * Documentacion:
 * https://www.php.net/manual/es/function.implode.php
 */
        require "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/E0/archivos/funciones.php";
        $archv_user_resc   = "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/E0/CSV_sucios/usuarios_rescatados.csv";
        $archv_traba_resc  = "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/E0/CSV_sucios/empleados_rescatados.csv";
        if (($archivo = fopen($archv_user_resc, "r")) !== FALSE){
                echo "archivo usuarios existe";
                $archivo_OK_user= "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/E0/CSV_limpios/usuarios_OK.csv";
                $archivo_correcto1 = fopen($archivo_OK_user, "w");
                $arr_inicial = ["nombre", "run", "Dv", "Correo", "Nombre_usuario", "Contrasena", 
                "Telefono_contacto", "Puntos", "Codigo_agenda", "Etiqueta", "Codigo_reserva", "Fecha", "Monto", "Cantidad_personas"];                                
                fputcsv($archivo_correcto1, $arr_inicial, ",", '"', "\\");
                while (($fila = fgetcsv($archivo, NULL,',', '"', "\\")) !== FALSE){
                        #var_dump($fila);
                        #print_r($fila);
                        $arr_correcto = parse_usuarios($fila); # Falta recibir la linea correcta y escribirla en archivo correcto
                        if ($arr_correcto != ""){
                                fputcsv($archivo_correcto1, $arr_correcto, ",", '"', "\\");
                        }
                        
                    }
                fclose($archivo);
                fclose($archivo_correcto1);
        }else{
                echo "archivo usuarios rescatados no existe";
        }
        if (($archivo_2 = fopen($archv_traba_resc, "r")) !== FALSE){
                echo "archivo trabajadores rescatados existe";
                $archivo_OK_traba = "/Users/felipeblasquezcontreras/Desktop/2025-1/Bases de Datos/E0/CSV_limpios/empleados_OK.csv";
                $archivo_correcto2 = fopen($archivo_OK_traba, "w");
                $arr_inicial2 = ["nombre", "run", "Dv", "Correo", "Nombre_usuario", "Contrasena", 
                "Telefono_contacto", "Jornada", "Isapre", "Contrato", "Codigo_reserva", 
                "Codigo_agenda", "Fecha", "Monto", "Cantidad_personas", "Estado_disponibilidad", 
                "Numero_viaje", "Lugar_origen", "Lugar_llegada", "Fecha_salida", "Fecha_llegada",
                "Capacidad", "Tiempo_estimado", "Precio_asiento", "Empresa", "Tipo_de_bus",
                "Comodidades", "Escalas", "Clase", "Paradas"];                                
                fputcsv($archivo_correcto2, $arr_inicial2, ",", '"', "\\");
                while (($fila2 = fgetcsv($archivo_2 , NULL, ",", '"', "\\")) !== FALSE){
                        //print_r($fila);
                        /*
                        $arr_correcto2 = parse_empleados($fila2);
                        if ($arr_correcto2 != ""){
                                fputcsv($archivo_correcto2, $arr_correcto2, ",", '"', "\\");
                        }
                                */
                       

                }
                fclose($archivo_2);
                fclose($archivo_correcto2);
        }else{
                echo "archivo trabajadores rescatados no existe";
        }










?>
