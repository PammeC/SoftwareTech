CREATE SCHEMA `ventas7` DEFAULT CHARACTER SET utf8mb4;
 
USE ventas7;
 
CREATE TABLE usuarios (

    id_usuario INT AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    email VARCHAR(50),
    password TEXT(50),
    fechaCaptura DATE,
    PRIMARY KEY (id_usuario)
);
 
CREATE TABLE imagenes (

    id_imagen INT AUTO_INCREMENT,
    nombre VARCHAR(500),
    ruta VARCHAR(500),
    fechaSubida DATE,
    PRIMARY KEY (id_imagen),
);
 
CREATE TABLE articulos (

    id_producto INT AUTO_INCREMENT,
    id_imagen INT NOT NULL,
    id_usuario INT NOT NULL,
    nombre VARCHAR(50),
    descripcion VARCHAR(500),
    cantidad INT,
    precio FLOAT,
    fechaCaptura DATE,
    PRIMARY KEY (id_producto),
    FOREIGN KEY (id_imagen) REFERENCES imagenes(id_imagen),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)

);
 
CREATE TABLE clientes (

    id_cliente INT AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    nombre VARCHAR(200),
    apellido VARCHAR(200),
    cedula INT (10),
    direccion VARCHAR(200),
    email VARCHAR(200),
    telefono VARCHAR(200),
    PRIMARY KEY (id_cliente),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
                
CREATE TABLE ventas (

    id_venta int not null,
    id_cliente INT,
    id_producto INT,
    id_usuario INT,
    precio FLOAT,
    fechaCompra DATE,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_producto) REFERENCES articulos(id_producto),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);