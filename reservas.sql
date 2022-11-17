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

create table if not exists equipos(
    id int not null auto_increment primary key,
    numSobremesa int(100) not null,
    numPortatil int(100) not null,
    numTablets int(100) not null
);

create table if not exists ubicaciones(
    id int not null auto_increment primary key,
    aula varchar(30) not null
);

create table if not exists inventario(
    numInventario int(200) not null auto_increment primary key,
    ubicacion int not null,
    idEquipo int not null,
    descripcion varchar(100) not null,
    estado varchar(30) not null,
        FOREIGN KEY (idEquipo) REFERENCES equipos(id) on update cascade on delete cascade,
        FOREIGN KEY (ubicacion) REFERENCES ubicaciones(id)
);

create table if not exists reservas(
    codigoProfesor varchar(10) not null primary key,
    idEquipo int not null,
    hora time not null,
    fecha date not null,
    horaInicio time not null,
    horaFin time not null,
    fechaReserva date not null,
    created_at timestamp,
        FOREIGN KEY (codigoProfesor) REFERENCES users(codigo) on update cascade on delete cascade,
        FOREIGN KEY (idEquipo) REFERENCES equipos(id)
)