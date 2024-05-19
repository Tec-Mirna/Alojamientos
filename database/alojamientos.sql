CREATE DATABASE alojamientos;

CREATE TABLE IF NOT EXISTS alojamientos(
id_alojamiento INT  AUTO_INCREMENT PRIMARY KEY,
imagen VARCHAR(255) NOT NULL,
nombre VARCHAR(150) NOT NULL,
ubicacion VARCHAR(132) NOT NULL,
descripcion TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS usuarios(
id_usuario INT AUTO_INCREMENT PRIMARY KEY,
id_rol INT NOT NULL,
usuario VARCHAR(23) NOT NULL,
contrasenia VARCHAR(8) NOT NULL,
nombre_completo VARCHAR(53) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);

CREATE TABLE IF NOT EXISTS roles(
id_rol INT AUTO_INCREMENT PRIMARY KEY,
nombre_rol VARCHAR(14) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO alojamientos(imagen, nombre, ubicacion, descripcion)
VALUES("https://cf.bstatic.com/xdata/images/hotel/max1024x768/124412066.jpg?k=39851cef5608cd2dcc9555be4a5780ce527c9961232fc7f8e01a70dd33cadac2&o=&hp=1", "Barceló San Salvador", " Boulevard del Hipodromo, Avenida Las Magnolias Colonia San Benito n/a, 01101 San Salvador, El Salvador",  "El Barcelo San Salvador, que cuenta con piscina al aire libre y centro de spa. Todas las habitaciones incluyen baño privado. También se proporciona TV LCD de 37 pulgadas. Todas las habitaciones ofrecen vistas a la ciudad o al volcán. Hay servicio de habitaciones las 24 horas.");


INSERT INTO alojamientos(imagen, nombre, ubicacion, descripcion)
VALUES("https://cf.bstatic.com/xdata/images/hotel/max1024x768/77996957.jpg?k=4fbb3fa9a223009b9a802faf1509499510fb23a24974b9a160e6c8ffc6fe6af7&o=&hp=1", "Hostal Cumbres del Volcan Flor Blanca", "6-10 Calle Poniente #1937 Colonia Flor Blanca, 01101 San Salvador, El Salvador ",  "Hostal Cumbres del Volcan Flor Blanca está en San Salvador, a 7 km de Parque Bicentenario, y dispone de alojamiento con jardín, parking privado gratis, salón de uso común y terraza. Este alojamiento ofrece cocina compartida y servicio de habitaciones, además de wifi gratis en todo el alojamiento. Algunas habitaciones del alojamiento tienen un balcón con vistas al jardín.
En el albergue, las habitaciones incluyen patio.");




INSERT INTO roles(nombre_rol) VALUES('usuario_comun');


INSERT INTO roles(nombre_rol) VALUES('administrador');

INSERT INTO usuarios(id_rol, usuario, contrasenia, nombre_completo)
VALUES(1, 'mirnare', '9876', 'Mirna Recinos');

INSERT INTO usuarios(id_rol, usuario, contrasenia, nombre_completo)
VALUES(2, 'Mirna20', '050703', 'Mirna Zuleyma Lemus Recinos' );


-- mostrar registros de la tabla usuarios
SELECT u.id_usuario,  r.nombre_rol, u.usuario, u.contrasenia, u.nombre_completo
FROM usuarios u
INNER JOIN roles r ON u.id_rol = r.id_rol;