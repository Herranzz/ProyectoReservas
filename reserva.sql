create database if not exists reservaEquiposs;

create table if not exists users(
    nombre varchar(60) not null,
    apellido varchar(60) not null,
    codigo varchar(10) not null primary key,
    email varchar(30) not null,
    password varchar(255) not null,
    role varchar(30) not null,
    created_at timestamp,
    updated_at timestamp
);

create table if not exists tipos(
    id varchar(255) not null,
    tipo varchar(60) not null primary key
);

create table if not exists equipos(
    id int not null auto_increment primary key,
    tipo varchar(60) not null,
    marca varchar(50) not null,
    modelo varchar(255) not null,
    numSerie varchar(255) not null,
        FOREIGN KEY (tipo) references tipos(tipo) on update cascade on delete cascade
);

create table if not exists ubicaciones(
    id int not null,
    aula varchar(50) not null primary key
);

create table if not exists estados(
    id int not null,
    estado varchar(30) not null primary key
);

create table if not exists inventario(
    id int(200) not null auto_increment primary key,
    ubicacion varchar(50) not null,
    idEquipo int not null,
    descripcion varchar(100),
    estado varchar(30) not null,
        FOREIGN KEY (idEquipo) REFERENCES equipos(id) on update cascade on delete cascade,
        FOREIGN KEY (ubicacion) REFERENCES ubicaciones(aula),
        FOREIGN KEY (estado) REFERENCES estados(estado)
);

create table if not exists reservas(
    id int not null auto_increment primary key,
    codigoProfesor varchar(10) not null,
    idEquipo int not null,
    horaInicio time not null,
    horaFin time not null,
    fechaReserva date not null,
        FOREIGN KEY (codigoProfesor) REFERENCES users(codigo) on update cascade on delete cascade,
        FOREIGN KEY (idEquipo) REFERENCES equipos(id)
);