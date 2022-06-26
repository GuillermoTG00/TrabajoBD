DROP TABLE paquete;
DROP TABLE cliente;

CREATE TABLE cliente (
    cedula                         INT(10) PRIMARY KEY,
    nombre                         VARCHAR(40) NOT NULL,
    apellido                       VARCHAR(40) NOT NULL,
    sexo                           VARCHAR(40) NOT NULL,
    telefono                       INT(10),
    correo                         VARCHAR(40)
);

CREATE TABLE paquete (
    cedula_del_receptor            INT(10),
    id                             INT(10) PRIMARY KEY,
    nivel_de_resistencia           INT(10) NOT NULL,
    peso                           INT(10) NOT NULL,
    dimensiones                    VARCHAR(20) NOT NULL,
    fecha_envio                    DATE NOT NULL,
    FOREIGN KEY (cedula_del_receptor) REFERENCES cliente(cedula) ON DELETE CASCADE
);