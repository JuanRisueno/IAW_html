-- 1. Creación de la base de datos 
DROP DATABASE IF EXISTS messenger;
CREATE DATABASE messenger WITH ENCODING = 'UTF8';

\c messenger

-- ==========================================================
-- GESTIÓN DE USUARIOS 
-- ==========================================================
-- 1. Borramos el usuario 'alumno' si ya existía para evitar errores
DROP ROLE IF EXISTS usuario;

-- 2. Creamos el usuario con contraseña
CREATE ROLE usuario WITH LOGIN PASSWORD 'oretania';

-- 3. Le damos permisos sobre la base de datos
GRANT CONNECT ON DATABASE messenger TO usuario;

-- 4. VITAL EN POSTGRES: Permisos sobre el esquema "public"
-- Si no haces esto, el usuario puede entrar pero no puede ver las tablas
GRANT USAGE ON SCHEMA public TO usuario;
GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO usuario;
GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO usuario;

-- 5. Asegurar que las tablas futuras también sean accesibles (Default Privileges)
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT, INSERT, UPDATE, DELETE ON TABLES TO usuario;
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, SELECT ON SEQUENCES TO usuario;

-- 2. Tabla usuario
CREATE TABLE usuario (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL, 
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    rol VARCHAR(10) NOT NULL DEFAULT 'user' check(rol in ('user','admin'))
);

-- 3. Tabla mensaje
CREATE TABLE mensaje (
    id SERIAL PRIMARY KEY,
    id_destinatario INT NOT NULL REFERENCES usuario,
    id_remitente INT NOT NULL REFERENCES usuario,
    asunto VARCHAR(100) NOT NULL DEFAULT 'Sin Asunto',
    texto VARCHAR(250) NOT NULL,
    fecha_hora timestamp NOT NULL DEFAULT current_timestamp
);

-- ==========================================
-- INSERCIÓN DE DATOS (Mismos datos)
-- ==========================================

-- Insertar 2 usuarios
INSERT INTO usuario (username, password, full_name, rol) VALUES
('admin1','oretania','Sergio López','admin'),
('user1','oretania','Daniel Rodríguez','user');
