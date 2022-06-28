/* ENTIDAD USUARIO CON SUS SUBTIPOS */

CREATE TABLE usuario (
    identificacion NUMBER(10) PRIMARY KEY,
    nombre_completo VARCHAR(30) NOT NULL,
    fecha_de_nacimiento DATE NOT NULL,
    celular NUMBER(10) NOT NULL,
    correo_electronico VARCHAR(30) NOT NULL,
    genero CHAR(1) NOT NULL CHECK(genero = 'M' OR genero = 'F'),    /* validacion genero */
    pais_origen VARCHAR(30) NOT NULL,
    nombre_de_usuario VARCHAR(20) NOT NULL UNIQUE,
    contraseña VARCHAR(30) NOT NULL,
    tipo CHAR(1) NOT NULL CHECK(tipo = 'C' OR tipo = 'E')           /* columna adicional subtipos */
);

CREATE TABLE cliente (
    identificacion NUMBER(10) PRIMARY KEY REFERENCES usuario,
    celular_de_emergencia NUMBER(10) NOT NULL,
    correo_de_emergencia VARCHAR(30) NOT NULL
);

CREATE TABLE empleado (
    identificacion NUMBER(10) REFERENCES usuario,
    codigo_empleado NUMBER(10),
    fecha_inicio_labores DATE NOT NULL,
    salario NUMBER(7) NOT NULL,
    PRIMARY KEY(identificacion, codigo_empleado)
);

/* ENTIDAD FACTURA */

CREATE TABLE factura (
  codigo NUMBER(10) PRIMARY KEY,
  fecha_compra DATE NOT NULL,
  /* CLAVES FORANEAS */
  cedcliente NUMBER(10) NOT NULL REFERENCES cliente,
  codpaquete NUMBER(10) NOT NULL REFERENCES paquete,
  /* NOTAS */
  CHECK (
      fecha_compra <= (SELECT fecha_salida FROM viaje WHERE viaje.paquete_viaje_ida = codpaquete)
      )
);

/* ENTIDAD PAQUETE */

CREATE TABLE paquete (
  codigo NUMBER(10) PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL,
  numero_personas NUMBER(2) NOT NULL,
  costo NUMBER(8) NOT NULL,
  habitacion NUMBER(3) NOT NULL,
  dias NUMBER(2) NOT NULL,
  noches NUMBER(2) NOT NULL,
  fecha_inicio_reservacion DATE NOT NULL,
  fecha_fin_reservacion DATE NOT NULL,
  alimentacion CHAR(2) NOT NULL CHECK(alimentacion = 'SI' OR alimentacion = 'NO'),
  nombre_aseguradora VARCHAR(30),
  cobertura_seguro VARCHAR(50),
  /* CLAVES FORANEAS */
  cedcliente NUMBER(10) NOT NULL REFERENCES cliente,
  codhotel NUMBER(10) NOT NULL REFERENCES hotel,
  cod_paquete_interno NUMBER(10) REFERENCES paquete,
  /* NOTAS */
  UNIQUE(cedcliente, fecha_inicio_reservacion),
  UNIQUE(cedcliente, fecha_fin_reservacion)
  /* Las validaciones:

     el viaje de ida del paquete 1 debe ser antes del viaje de ida del paquete 2
     el viaje de vuelta del paquete 1 debe ser después del viaje de vuelta del paquete 2
     fecha inicio reserva del paquete 1 debe ser antes de fecha inicio reserva del paquete 2
     fecha fin reserva del paquete 1 debe ser después de fecha fin reserva del paquete 2

     Además, debe controlarse que tanto paquete externo como paquete interno hayan sido adquiridos por el mismo cliente

     debe controlarse que no exista otro paquete adquirido por el mismo cliente cuyas fechas de reservación se solapen,
     es decir, sean paquete 1 y paquete 2 adquiridos por el mismo cliente:
     fecha fin reservación de paquete 1 debe ser menor que fecha inicio reservación de paquete 2
     o
     fecha inicio reservación de paquete 1 debe ser mayor que fecha fin reservación de paquete 2

     deben ser realizadas a través de código, no es posible realizarlas con una cláusula CHECK
     dado que sería necesario realizar un SELECT dentro de la cláusula CHECK, y esto no es permitido o
     no es posible.

   */
);

/* ENTIDAD VIAJE */

CREATE TABLE viaje (
    codigo NUMBER(10) PRIMARY KEY,
    identificacion_pasajero NUMBER(10) NOT NULL,
    nombre_pasajero VARCHAR(30) NOT NULL,
    duracion_viaje NUMBER(3,1) NOT NULL,
    fecha_salida DATE NOT NULL,
    fecha_llegada DATE NOT NULL,
    /* CLAVES FORANEAS */
    ciudad_origen NUMBER(10) NOT NULL REFERENCES ciudad,
    pais_origen NUMBER(10) NOT NULL REFERENCES pais,
    ciudad_destino NUMBER(10) NOT NULL REFERENCES ciudad,
    pais_destino NUMBER(10) NOT NULL REFERENCES pais,
    paquete_viaje_ida NUMBER(10) NOT NULL REFERENCES paquete,
    paquete_viaje_vuelta NUMBER(10) NOT NULL REFERENCES paquete,
    /* ARCO */
    codcrucero NUMBER(10),
    habitacion_crucero NUMBER(3),
    codvuelo NUMBER(10),
    silla_vuelo VARCHAR(4),
    FOREIGN KEY(codcrucero, habitacion_crucero) REFERENCES crucero,
    FOREIGN KEY(codvuelo, silla_vuelo) REFERENCES vuelo,
    CHECK(
        (codcrucero IS NOT NULL AND habitacion_crucero IS NOT NULL) AND (codvuelo IS NULL AND silla_vuelo IS NULL)
        OR
        (codcrucero IS NULL AND habitacion_crucero IS NULL) AND (codvuelo IS NOT NULL AND silla_vuelo IS NOT NULL)
        ),
    /* NOTAS */
    UNIQUE(identificacion_pasajero, fecha_salida),
    UNIQUE(identificacion_pasajero, fecha_llegada),
    CHECK(fecha_salida <= fecha_llegada)
);

/* ENTIDAD CRUCERO */

CREATE TABLE crucero (
    codigo NUMBER(10),
    habitacion NUMBER(3),
    nombre_operador VARCHAR(30) NOT NULL,
    puerto_origen VARCHAR(30) NOT NULL,
    puerto_destino VARCHAR(30) NOT NULL,
    tiquete VARCHAR(50) NOT NULL,
    PRIMARY KEY(codigo, habitacion)
    /* La validación: cada crucero esté vinculado únicamente a un operador, puerto origen y puerto destino
       debe ser realizada a través de código, no es posible realizarla con una cláusula CHECK
       dado que sería necesario realizar un SELECT dentro de la cláusula CHECK, y esto no es permitido o
       no es posible. */

);

/* ENTIDAD VUELO */

CREATE TABLE vuelo (
    codigo NUMBER(10),
    silla VARCHAR(4),
    nombre_aerolinea VARCHAR(30) NOT NULL,
    aeropuerto_origen VARCHAR(30) NOT NULL,
    aeropuerto_destino VARCHAR(30) NOT NULL,
    tiquete VARCHAR(50) NOT NULL,
    PRIMARY KEY(codigo, silla)
    /* La validación: se debe controlar que cada vuelo esté vinculado únicamente a una aerolinea, aeropuerto origen y aeropuerto destino.
       debe ser realizada a través de código, no es posible realizarla con una cláusula CHECK dado que sería necesario realizar un SELECT
       dentro de la cláusula CHECK, y esto no es permitido o no es posible. */
);

/* ENTIDAD HOTEL */

CREATE TABLE hotel (
    codigo NUMBER(10) PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    estrellas NUMBER(1) NOT NULL,
    direccion VARCHAR(50) NOT NULL,
    /* CLAVES FORANEAS */
    codpais NUMBER(10) NOT NULL REFERENCES pais,
    codciudad NUMBER(10) NOT NULL REFERENCES ciudad,
    /* NOTAS */
    UNIQUE(codciudad, codpais, direccion)
);

/* ENTIDAD PAIS */

CREATE TABLE pais (
    codigo NUMBER(10) PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL UNIQUE
);

/* ENTIDAD CIUDAD */

CREATE TABLE ciudad (
    codigo NUMBER(10) PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    /* CLAVES FORANEAS */
    codpais NUMBER(10) NOT NULL REFERENCES pais
);

/* ENTIDAD EMPRESA */

CREATE TABLE empresa (
    nit NUMBER(10) PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    presupuesto NUMBER(10) NOT NULL,
    /* CLAVE FORANEA */
    cedgerente NUMBER(10) REFERENCES cliente
);

/* ENTIDAD ALQUILER */

CREATE TABLE alquiler (
    codigo NUMBER(10) PRIMARY KEY,
    fecha_compra_alquiler DATE NOT NULL,
    valor_alquiler NUMBER(10) NOT NULL,
    direccion VARCHAR(50) NOT NULL,
    /* CLAVES FORANEAS */
    nitempresa NUMBER(10) REFERENCES empresa,
    cedgerente NUMBER(10) REFERENCES cliente
    codpais NUMBER(10) NOT NULL REFERENCES pais,
    codciudad NUMBER(10) NOT NULL REFERENCES ciudad
);
