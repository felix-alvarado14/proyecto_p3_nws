use ecommerce;

DROP TABLE Libros;

CREATE TABLE Libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(50),
    genero VARCHAR(50),
    publicacion_year INT,
    editora VARCHAR(50),
    precio DECIMAL(10,2) NOT NULL
);

DROP TABLE Tempor;

CREATE TABLE Tempor (
    id_libro INT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL, 
    FOREIGN KEY (id_libro) REFERENCES Libros(id_libro)
);

CREATE TABLE ordenes (
    id_orden VARCHAR(100) PRIMARY KEY,
    id_usuario BIGINT(10) NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario)
        REFERENCES usuario(usercod)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE orden_detalles (
    id_orden VARCHAR(100) NOT NULL,
    id_libro INT NOT NULL,
    CONSTRAINT fk_orden FOREIGN KEY (id_orden)
        REFERENCES ordenes(id_orden)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_libro FOREIGN KEY (id_libro)
        REFERENCES Libros(id_libro)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

DROP TABLE ordenes;

DROP TABLE orden_detalles;

