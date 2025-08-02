CREATE TABLE
    `products` (
        `productId` int(11) NOT NULL AUTO_INCREMENT,
        `productName` varchar(255) NOT NULL,
        `productDescription` text NOT NULL,
        `productPrice` decimal(10, 2) NOT NULL,
        `productImgUrl` varchar(255) NOT NULL,
        `productStock` int(11) NOT NULL DEFAULT 0,
        `productStatus` char(3) NOT NULL,
        PRIMARY KEY (`productId`)
    ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    `carretilla` (
        `usercod` BIGINT(10) NOT NULL,
        `id_libro` int(11) NOT NULL,
        `crrctd` INT(5) NOT NULL,
        `crrprc` DECIMAL(12, 2) NOT NULL,
        `crrfching` DATETIME NOT NULL,
        PRIMARY KEY (`usercod`, `id_libro`),
        INDEX `id_libro_idx` (`id_libro` ASC),
        CONSTRAINT `carretilla_user_key` FOREIGN KEY (`usercod`) REFERENCES `usuario` (`usercod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `carretilla_prd_key` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION
    );

CREATE TABLE `carretillaanon` (
    `anoncod` VARCHAR(128) NOT NULL,
    `id_libro` BIGINT NOT NULL,
    `crrctd` INT(5) NOT NULL,
    `crrprc` DECIMAL(12, 2) NOT NULL,
    `crrfching` DATETIME NOT NULL,
    PRIMARY KEY (`anoncod`, `id_libro`),
    KEY `id_libro_idx` (`id_libro`),
    CONSTRAINT `carretillaanon_prd_key`
        FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);


    DROP TABLE
    `carretilla`

        DROP TABLE
    `products`

    