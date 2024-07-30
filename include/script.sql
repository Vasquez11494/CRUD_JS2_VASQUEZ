
CREATE TABLE grados (
    grad_id SERIAL NOT NULL ,
    grad_nombre VARCHAR (50) NOT NULL,
    PRIMARY KEY (grad_id)
);

CREATE TABLE armas (
    arm_id SERIAL NOT NULL ,
    arm_nombre VARCHAR(50) NOT NULL,
    PRIMARY KEY (arm_id)
);

CREATE TABLE alumnos (
    alu_id SERIAL NOT NULL,
    alu_nombre VARCHAR(50) NOT NULL,
    alu_apellido VARCHAR(50) NOT NULL,
    alu_grado INT NOT NULL,
    alu_arma INT NOT NULL,
    alu_nacionalidad VARCHAR(75) NOT NULL,
    alu_situacion INT DEFAULT 1,
    PRIMARY KEY (alu_id),
    FOREIGN KEY (alu_grado) REFERENCES grados (grad_id),
    FOREIGN KEY (alu_arma) REFERENCES armas (arm_id)
);


-- INSERT EN LA TABLA GRADOS
insert into grados (grad_nombre) values ("Sold. 2da.");
insert into grados (grad_nombre) values ("Sold. 1da.");
insert into grados (grad_nombre) values ("Cabo");
insert into grados (grad_nombre) values ("Sgto. 2do.");
insert into grados (grad_nombre) values ("Sgto. 1ro");
insert into grados (grad_nombre) values ("Especialista");
insert into grados (grad_nombre) values ("Planillero");
insert into grados (grad_nombre) values ("Subteniente");
insert into grados (grad_nombre) values ("Teniente");
insert into grados (grad_nombre) values ("Capitan 2do.");
insert into grados (grad_nombre) values ("Capitan 1ro.");
insert into grados (grad_nombre) values ("Mayor");
insert into grados (grad_nombre) values ("Teniente Coronel");
insert into grados (grad_nombre) values ("Coronel");
insert into grados (grad_nombre) values ("General");

-- INSERTTANDO DATOS EN LA TABLA ARMAS
INSERT INTO armas (arm_nombre) VALUES ("Sin Arma");
INSERT INTO armas (arm_nombre) VALUES ("Infanteria");
INSERT INTO armas (arm_nombre) VALUES ("Artilleria");
INSERT INTO armas (arm_nombre) VALUES ("Caballeria");
INSERT INTO armas (arm_nombre) VALUES ("Marina");
INSERT INTO armas (arm_nombre) VALUES ("Aviacion");
INSERT INTO armas (arm_nombre) VALUES ("Ingenieros");
INSERT INTO armas (arm_nombre) VALUES ("Policia Militar");
INSERT INTO armas (arm_nombre) VALUES ("Transmisiones");
INSERT INTO armas (arm_nombre) VALUES ("Intendencia");
INSERT INTO armas (arm_nombre) VALUES ("Material de Guerra");

-- CREANDO LA TABLA DE MATERIAS

CREATE TABLE MATERIAS (
    MATERIA_ID SERIAL NOT NULL ,
    MATERIA_NOMBRE VARCHAR(50) NOT NULL,
    MATERIA_SITUACION INT DEFAULT 1,
    PRIMARY KEY (MATERIA_ID)
);

CREATE TABLE notas (
    nota_id SERIAL NOT NULL ,
    nota_alu_id INT NOT NULL,
    nota_materia_id INT NOT NULL,
    nota DECIMAL(5, 2) NOT NULL,
    PRIMARY KEY (nota_id),
    FOREIGN KEY (nota_alu_id) REFERENCES alumnos (alu_id),
    FOREIGN KEY (nota_materia_id) REFERENCES MATERIAS (MATERIA_ID),
    UNIQUE (nota_alu_id, nota_materia_id)
);
