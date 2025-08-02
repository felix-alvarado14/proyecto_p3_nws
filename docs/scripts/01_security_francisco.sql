CREATE TABLE
    `usuario` (
        `usercod` bigint(10) NOT NULL AUTO_INCREMENT,
        `useremail` varchar(80) DEFAULT NULL,
        `username` varchar(80) DEFAULT NULL,
        `userpswd` varchar(128) DEFAULT NULL,
        `userfching` datetime DEFAULT NULL,
        `userpswdest` char(3) DEFAULT NULL,
        `userpswdexp` datetime DEFAULT NULL,
        `userest` char(3) DEFAULT NULL,
        `useractcod` varchar(128) DEFAULT NULL,
        `userpswdchg` varchar(128) DEFAULT NULL,
        `usertipo` char(3) DEFAULT NULL COMMENT 'Tipo de Usuario, Normal, Consultor o Cliente',
        PRIMARY KEY (`usercod`),
        UNIQUE KEY `useremail_UNIQUE` (`useremail`),
        KEY `usertipo` (
            `usertipo`,
            `useremail`,
            `usercod`,
            `userest`
        )
    ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;

CREATE TABLE
    `roles` (
        `rolescod` varchar(128) NOT NULL,
        `rolesdsc` varchar(45) DEFAULT NULL,
        `rolesest` char(3) DEFAULT NULL,
        PRIMARY KEY (`rolescod`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE
    `roles_usuarios` (
        `usercod` bigint(10) NOT NULL,
        `rolescod` varchar(128) NOT NULL,
        `roleuserest` char(3) DEFAULT NULL,
        `roleuserfch` datetime DEFAULT NULL,
        `roleuserexp` datetime DEFAULT NULL,
        PRIMARY KEY (`usercod`, `rolescod`),
        KEY `rol_usuario_key_idx` (`rolescod`),
        CONSTRAINT `rol_usuario_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `usuario_rol_key` FOREIGN KEY (`usercod`) REFERENCES `usuario` (`usercod`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE
    `funciones` (
        `fncod` varchar(255) NOT NULL,
        `fndsc` varchar(255) DEFAULT NULL,
        `fnest` char(3) DEFAULT NULL,
        `fntyp` char(3) DEFAULT NULL,
        PRIMARY KEY (`fncod`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE
    `funciones_roles` (
        `rolescod` varchar(128) NOT NULL,
        `fncod` varchar(255) NOT NULL,
        `fnrolest` char(3) DEFAULT NULL,
        `fnexp` datetime DEFAULT NULL,
        PRIMARY KEY (`rolescod`, `fncod`),
        KEY `rol_funcion_key_idx` (`fncod`),
        CONSTRAINT `funcion_rol_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT `rol_funcion_key` FOREIGN KEY (`fncod`) REFERENCES `funciones` (`fncod`) ON DELETE NO ACTION ON UPDATE NO ACTION
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE
    `bitacora` (
        `bitacoracod` int(11) NOT NULL AUTO_INCREMENT,
        `bitacorafch` datetime DEFAULT NULL,
        `bitprograma` varchar(255) DEFAULT NULL,
        `bitdescripcion` varchar(255) DEFAULT NULL,
        `bitobservacion` mediumtext,
        `bitTipo` char(3) DEFAULT NULL,
        `bitusuario` bigint(18) DEFAULT NULL,
        PRIMARY KEY (`bitacoracod`)
    ) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8;

    INSERT INTO funciones (fncod, fndsc, fnest, fntyp) VALUES
('Controllers\\Indexadmin', 'Panel Admin', 'ACT', 'ADM'),
('Controllers\\Checkout\\Catalogo', 'Catálogo de Checkout', 'ACT', 'ADM'),
('Controllers\\Maintenance\\Admin\\Books\\Book', 'Mantenimiento Libros (1)', 'ACT', 'ADM'),
('Controllers\\Maintenance\\Admin\\Books\\Books', 'Mantenimiento Libros (2)', 'ACT', 'ADM'),
('Controllers\\Maintenance\\Admin\\RolUsuario\\Rolusuario', 'Asignación de Roles a Usuarios', 'ACT', 'ADM'),
('Controllers\\Maintenance\\Admin\\Roles\\Roles', 'Gestión de Roles', 'ACT', 'ADM'),
('Controllers\\Maintenance\\Admin\\Usuarios\\Usuario', 'Mantenimiento de Usuario (1)', 'ACT', 'ADM'),
('Controllers\\Maintenance\\Admin\\Usuarios\\Usuarios', 'Gestión de Usuarios', 'ACT', 'ADM');

INSERT INTO funciones_roles (rolescod, fncod, fnrolest) VALUES
('admin', 'Controllers\\Indexadmin', 'ACT'),
('admin', 'Controllers\\Checkout\\Catalogo', 'ACT'),
('admin', 'Controllers\\Maintenance\\Admin\\Books\\Book', 'ACT'),
('admin', 'Controllers\\Maintenance\\Admin\\Books\\Books', 'ACT'),
('admin', 'Controllers\\Maintenance\\Admin\\RolUsuario\\Rolusuario', 'ACT'),
('admin', 'Controllers\\Maintenance\\Admin\\Roles\\Roles', 'ACT'),
('admin', 'Controllers\\Maintenance\\Admin\\Usuarios\\Usuario', 'ACT'),
('admin', 'Controllers\\Maintenance\\Admin\\Usuarios\\Usuarios', 'ACT');

-- Usuario administrador
INSERT INTO usuario (
    useremail, username, userpswd, userfching, userpswdest,
    userest, usertipo
) VALUES (
    'admin@example.com', 'Administrador', 'HASHED_ADMIN_PASSWORD', NOW(), 'ACT',
    'ACT', 'ADM'
);

-- Usuario cliente
INSERT INTO usuario (
    useremail, username, userpswd, userfching, userpswdest,
    userest, usertipo
) VALUES (
    'cliente@example.com', 'Cliente', 'HASHED_CLIENTE_PASSWORD', NOW(), 'ACT',
    'ACT', 'CLI'
);

-- Crear rol admin si no existe
INSERT IGNORE INTO roles (rolescod, rolesdsc, rolesest)
VALUES ('admin', 'Administrador del sistema', 'ACT');

-- Crear rol cliente si no existe
INSERT IGNORE INTO roles (rolescod, rolesdsc, rolesest)
VALUES ('cliente', 'Usuario Cliente', 'ACT');

-- Asignar rol admin al usuario admin (ajusta usercod si necesario)
INSERT INTO roles_usuarios (usercod, rolescod, roleuserest, roleuserfch)
VALUES (1, 'admin', 'ACT', NOW());

-- Asignar rol cliente al usuario cliente (ajusta usercod si necesario)
INSERT INTO roles_usuarios (usercod, rolescod, roleuserest, roleuserfch)
VALUES (2, 'cliente', 'ACT', NOW());

