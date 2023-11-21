CREATE DATABASE bd_restaurante;

USE bd_restaurante;

-- Tabla de usuarios para los camareros
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY,
    nombre_user VARCHAR(255),
    contrasena VARCHAR(60)
);

-- Tabla de salas para diferenciar mesas
CREATE TABLE salas (
    id_sala INT PRIMARY KEY,
    nombre_sala VARCHAR(255),
    tipo_sala VARCHAR(50),         -- Tipo de sala (Terraza, Comedor, Sala Privada...)
    capacidad INT                  -- Capacidad de la sala (número de mesas o personas)                    
);

-- Tabla de mesas 
CREATE TABLE mesas (
    id_mesa INT PRIMARY KEY,
    numero_mesa INT,
    id_sala INT,
    estado ENUM('libre','ocupada') DEFAULT ('libre'),   -- El estado de la mesa (libre u ocupada)
    FOREIGN KEY (id_sala) REFERENCES salas(id_sala)     -- Cada mesa está asociada a una sala específica 
);

-- Tabla para los registros de ocupación de las mesas
CREATE TABLE ocupaciones (
    id_ocupacion INT PRIMARY KEY,
    id_usuario INT,
    id_mesa INT,
    fecha_inicio DATETIME DEFAULT CURRENT_TIMESTAMP,    -- Fecha y hora del inicio de la ocupación
    fecha_fin DATETIME DEFAULT CURRENT_TIMESTAMP,       -- Fecha y hora del final de la ocupación
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario), -- Permite saber quién ha hecho una ocupación
    FOREIGN KEY (id_mesa) REFERENCES mesas(id_mesa) -- Permite saber qué mesa ha estado ocupada
);




-- Insertar usuarios (camareros)
INSERT INTO usuarios (id_usuario, nombre_user, contrasena) VALUES
    (1, 'Jorge', '$2y$10$wORRwXyRsJRc9ua8okkNuO6m/GbqBuZouNb4LZbwFPDG6HwNUhOVa'),   -- asdASD123
    (2, 'Olga', '$2y$10$wORRwXyRsJRc9ua8okkNuO6m/GbqBuZouNb4LZbwFPDG6HwNUhOVa'),    -- asdASD123
    (3, 'Miguel', '$2y$10$wORRwXyRsJRc9ua8okkNuO6m/GbqBuZouNb4LZbwFPDG6HwNUhOVa');  -- asdASD123

-- Insertar salas
INSERT INTO salas (id_sala, nombre_sala, tipo_sala, capacidad) VALUES
    (1, 'Terraza 1', 'Terraza', 20),
    (2, 'Terraza 2', 'Terraza', 20),
    (3, 'Terraza 3', 'Terraza', 20),
    (4, 'Menjador 1', 'Menjador', 30),
    (5, 'Menjador 2', 'Menjador', 25),
    (6, 'Sala Privada 1', 'Privada', 10),
    (7, 'Sala Privada 2', 'Privada', 8),
    (8, 'Sala Privada 3', 'Privada', 12),
    (9, 'Sala Privada 4', 'Privada', 15);

-- Insertar mesas en las terrazas (4 mesas en cada terraza)
INSERT INTO mesas (id_mesa, numero_mesa, id_sala, estado) VALUES
-- Mesas Terraza 1
    (1, 101, 1, 'libre'),
    (2, 102, 1, 'libre'),
    (3, 103, 1, 'libre'),
    (4, 104, 1, 'libre'),
-- Mesas Terraza 2
    (5, 201, 2, 'libre'),
    (6, 202, 2, 'libre'),
    (7, 203, 2, 'libre'),
    (8, 204, 2, 'libre'),
-- Mesas Terraza 3
    (9, 301, 3, 'libre'),
    (10, 302, 3, 'libre'),
    (11, 303, 3, 'libre'),
    (12, 304, 3, 'libre');


-- Insertar mesas en los comedores (10 mesas en cada comedor)
INSERT INTO mesas (id_mesa, numero_mesa, id_sala, estado) VALUES
    -- Mesas para el Menjador 1
    (13, 401, 4, 'libre'),
    (14, 402, 4, 'libre'),
    (15, 403, 4, 'libre'),
    (16, 404, 4, 'libre'),
    (17, 405, 4, 'libre'),
    (18, 406, 4, 'libre'),
    (19, 407, 4, 'libre'),
    (20, 408, 4, 'libre'),
    (21, 409, 4, 'libre'),
    (22, 410, 4, 'libre'),
    (23, 411, 4, 'libre'),
    (24, 412, 4, 'libre'),
    -- Mesas para el Menjador 2
    (25, 501, 5, 'libre'),
    (26, 502, 5, 'libre'),
    (27, 503, 5, 'libre'),
    (28, 504, 5, 'libre'),
    (29, 505, 5, 'libre'),
    (30, 506, 5, 'libre'),
    (31, 507, 5, 'libre'),
    (32, 508, 5, 'libre'),
    (33, 509, 5, 'libre'),
    (34, 510, 5, 'libre'),
    (35, 511, 5 ,'libre'),
    (36, 512, 5, 'libre');

    -- Insertar mesas en las salas privadas (1 mesa por sala)
INSERT INTO mesas (id_mesa, numero_mesa, id_sala, estado) VALUES
    (37, 601, 6, 'libre'),
    (38, 701, 7, 'libre'),
    (39, 801, 8, 'libre'),
    (40, 901, 9, 'libre');

-- Insertar ocupaciones (registros de ocupación de mesas)
INSERT INTO ocupaciones (id_ocupacion, id_usuario, id_mesa, fecha_inicio, fecha_fin) VALUES
    (1, 1, 1, '2023-11-20 12:30:00', '2023-11-20 14:30:00'),
    (2, 2, 3, '2023-11-20 18:00:00', '2023-11-20 19:30:00'),
    (3, 3, 5, '2023-11-20 20:00:00', '2023-11-20 22:00:00');
