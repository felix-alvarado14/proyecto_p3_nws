use ecommerce;

CREATE TABLE Libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(50),
    genero VARCHAR(50),
    publicacion_year INT,
    editora VARCHAR(50)
);