### Entidades fuertes: (existencia propie e identidicador unico)
- Personas:
	 (Pk)id_persona, nombre, contrasena, nombre usuario, telefono, run y dv
- Empleados:
	(Fk)id_persona, correo(Pk), jornadas, contrato, seguro
- Usuario:
	(Fk)id_persona, (Pk)correo, agenda, puntos

// En la relacion Persona empleados usuarios se toma la Sk id_persona en Personas como Pk de esta manera nos podemos permitir tener una Key unica para cada persona
// Despues cada usuario hereda como Fk la id_persona y mantiene para si mismo la Pk correo.
// De esta manera podemos solucionar el problema que ocurre cuando una persona es tanto usuario como empleado, ya que la entidad persona tiene su propio Sk y las entidades Empleados y usuario tienen sus Pk unicos (un empleado que es al mismo tiempo usuario tiene 2 correos).

- Agenda, Pk=correo, etiqueta
- Reserva, Pk=Agenda a la que pertenece ⚠️ surrogate_key: id_reserva
- Hospedaje, Pk=nombre ⚠️ surrogate_key: id_hospedaje
- Hotel, Pk=id_hospedaje como Fk
- airbnb, Pk=nombre, numero de contacto ⚠️ surrogate_key: id_airbnb
- Panoramas, Pk=nombre, empresa ⚠️ surrogate_key: id_panorama


- Seguro, Sk=id_seguro, -> tomados por usuarios es Fk en usuario
- Review, Pk=correo,usuario y reserva


- Transporte, id_transporte(PK, SK)lugar de origen, lugar llegada, empresa, correo empleado
### Entidades debiles: (dependen de otra para existir != de atributos)
- Habitacion hotel, existe dentro del hotel y puede ser de 3 tipos con identificacion unica Pk: id_hotel, id_habitacion(numero)
- Participante panorama, solo existe dentro de la reserva Pk: id, nombre


//Se toma a transporte como una entidad fuerte y padre de trenes buses y aviones
//Se crea la (SK) id_transporte la cual es heredada por id_tren, id_bus e id_avion
- Trenes,id_transporte(FK), id_tren(SK,PK), comodidates, paradas
- Buses, id_transporte(FK), id_bus(SK,PK), comodidates, tipo
- Aviones, id_transporte(FK), id_avion(SK,PK), clase, lista escalas

Paso	Qué hacer
1	Cada entidad → tabla
2	ISA → una tabla por entidad + FK
3	Cada relación → tabla (o FK si 1:N)
4	Establecer FKs y PKs
5	Analizar dependencias funcionales
6	Descomponer si hay violaciones de BCNF



