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
    (2, 'Terraza 2', 'Terraza', 15),
    (3, 'Menjador 1', 'Menjador', 30),
    (4, 'Menjador 2', 'Menjador', 25),
    (5, 'Sala Privada 1', 'Privada', 10),
    (6, 'Sala Privada 2', 'Privada', 8),
    (7, 'Sala Privada 3', 'Privada', 12),
    (8, 'Sala Privada 4', 'Privada', 15);

-- Insertar mesas
INSERT INTO mesas (id_mesa, numero_mesa, id_sala, estado) VALUES
    (1, 101, 1, 'libre'),
    (2, 102, 1, 'libre'),
    (3, 201, 2, 'libre'),
    (4, 202, 2, 'libre'),
    (5, 301, 3, 'libre'),
    (6, 302, 3, 'libre'),
    (7, 401, 4, 'libre'),
    (8, 402, 4, 'libre'),
    (9, 501, 5, 'libre'),
    (10, 502, 5, 'libre'),
    (11, 601, 6, 'libre'),
    (12, 602, 6, 'libre'),
    (13, 701, 7, 'libre'),
    (14, 702, 7, 'libre'),
    (15, 801, 8, 'libre'),
    (16, 802, 8, 'libre');

-- Insertar ocupaciones (registros de ocupación de mesas)
INSERT INTO ocupaciones (id_ocupacion, id_usuario, id_mesa, fecha_inicio, fecha_fin) VALUES
    (1, 1, 1, '2023-11-20 12:30:00', '2023-11-20 14:30:00'),
    (2, 2, 3, '2023-11-20 18:00:00', '2023-11-20 19:30:00'),
    (3, 3, 5, '2023-11-20 20:00:00', '2023-11-20 22:00:00');

