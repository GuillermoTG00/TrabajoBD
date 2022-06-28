DROP TABLE alquiler;
DROP TABLE cliente;
DROP TABLE empresa;

CREATE TABLE cliente (
    cedula                        INT(10) PRIMARY KEY,
    nombre                        VARCHAR(40) NOT NULL,
    username                      VARCHAR(40) NOT NULL,
    fechanacimiento               DATE NOT NULL,
    sexo                          VARCHAR(40) NOT NULL,
    paisorigen                    VARCHAR(40) NOT NULL,
    celular                       INT(10),
    correo                        VARCHAR(40),
    contraseña                    VARCHAR(40)
);

CREATE TABLE empresa (
    nit              INT(10) PRIMARY KEY,
    nombre           VARCHAR(40) NOT NULL,
    presupuesto      INT(50) NOT NULL
);

CREATE TABLE alquiler (
    cedulacliente           INT(10) REFERENCES cliente(cedula),
    nitempresa              INT(10) REFERENCES empresa(nit),
    codigo                  INT(10) PRIMARY KEY,
    fechacompraalquiler     DATE NOT NULL,
    valoralquiler           INT(10) NOT NULL,
    direccion               VARCHAR(50) NOT NULL
);