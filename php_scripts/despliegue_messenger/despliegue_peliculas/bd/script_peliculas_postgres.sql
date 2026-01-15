-- 1. Creación de la base de datos 
DROP DATABASE IF EXISTS peliculas;
CREATE DATABASE peliculas WITH ENCODING = 'UTF8';

\c peliculas

-- ==========================================================
-- GESTIÓN DE USUARIOS 
-- ==========================================================
-- 1. Borramos el usuario 'alumno' si ya existía para evitar errores
DROP ROLE IF EXISTS usuario;

-- 2. Creamos el usuario con contraseña
CREATE ROLE usuario WITH LOGIN PASSWORD 'oretania';

-- 3. Le damos permisos sobre la base de datos
GRANT CONNECT ON DATABASE peliculas TO usuario;

-- 4. VITAL EN POSTGRES: Permisos sobre el esquema "public"
-- Si no haces esto, el usuario puede entrar pero no puede ver las tablas
GRANT USAGE ON SCHEMA public TO usuario;
GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO usuario;
GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO usuario;

-- 5. Asegurar que las tablas futuras también sean accesibles (Default Privileges)
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT, INSERT, UPDATE, DELETE ON TABLES TO usuario;
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, SELECT ON SEQUENCES TO usuario;

-- 6. Creación de las tablas
CREATE TABLE usuario (
    id serial PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL, 
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    rol VARCHAR(10) NOT NULL DEFAULT 'user' check(rol in('user', 'admin'))
);

CREATE TABLE plataforma (
    id serial PRIMARY KEY,
    nombre varchar(100) not null unique,
    descripcion varchar(250)
);

CREATE TABLE serie (
    id serial PRIMARY KEY,
    titulo varchar(100) not null,
    id_plat int not null references plataforma,
    fecha_publi date not null
);

CREATE TABLE favorito (
    id serial PRIMARY KEY,
    id_serie int not null references serie,
    id_usuario int not null references usuario,
    puntuacion int not null check(puntuacion between 1 and 5),
    comentario varchar(250),
    fecha date default now(),
    unique(id_serie, id_usuario)
);


-- ==========================================
-- INSERCIÓN DE DATOS (Mismos datos)
-- ==========================================

-- Insertar 2 usuarios con rol user y uno con rol admin
INSERT INTO usuario (username, password, full_name, rol) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sergio López', 'admin'),
('user1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Daniel Rodríguez', 'user'),
('user2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Antonio Torres', 'user');

--Insertar plataformas de prueba
INSERT INTO plataforma (nombre, descripcion) VALUES 
('Netflix', 'Plataforma líder en streaming con una amplia variedad de series, películas y documentales originales.'),
('Prime Video', 'Servicio de streaming de Amazon que incluye películas, series de televisión y deportes en directo.'),
('Disney+', 'Plataforma con contenido de Disney, Pixar, Marvel, Star Wars, National Geographic y Star.'),
('HBO Max', 'Servicio que ofrece el catálogo de Warner Bros., HBO, DC, Cartoon Network y Max Originals.');

--Insertar algunas series de prueba
INSERT INTO serie (titulo, id_plat, fecha_publi) VALUES 
('Stranger Things', 1, '2016-07-15'),
('The Crown', 1, '2016-11-04'),
('The Boys', 2, '2019-07-26'),
('The Marvelous Mrs. Maisel', 2, '2017-03-17'),
('The Mandalorian', 3, '2019-11-12'),
('WandaVision', 3, '2021-01-15'),
('The Last of Us', 4, '2023-01-15'),
('Succession', 4, '2018-06-03'),
('Black Mirror', 1, '2011-12-04'),
('Loki', 3, '2021-06-09');

-- Insertar algunos favoritos para el usuario user1 de ejemplo
INSERT INTO favorito (id_serie, id_usuario, puntuacion, comentario) VALUES 
(1, 2, 5, 'Increíble ambientación de los 80, me encanta Eleven.'),
(7, 2, 4, 'Una adaptación muy fiel al videojuego, excelente actuación.'),
(3, 3, 5, 'La mejor vuelta de tuerca al género de superhéroes.'),
(8, 3, 4, 'Diálogos brillantes, aunque a veces los personajes son odiosos.'),
(5, 2, 3, 'Visualmente espectacular, pero la trama avanza un poco lento.');

