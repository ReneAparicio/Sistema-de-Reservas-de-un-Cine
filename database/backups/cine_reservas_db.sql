-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2026 a las 01:06:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cine_reservas_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelicula_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `sala` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `asientos_totales` int(11) NOT NULL DEFAULT 50,
  `asientos_disponibles` int(11) NOT NULL DEFAULT 50,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`id`, `pelicula_id`, `fecha`, `hora`, `sala`, `precio`, `asientos_totales`, `asientos_disponibles`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-05-19', '19:00:00', 1, 12.50, 50, 44, '2026-05-19 17:10:37', '2026-05-19 17:10:37'),
(2, 2, '2026-05-19', '21:30:00', 2, 14.00, 50, 46, '2026-05-19 17:10:37', '2026-05-19 17:10:37'),
(3, 3, '2026-05-19', '16:00:00', 3, 10.00, 50, 45, '2026-05-19 17:10:37', '2026-05-19 17:10:37'),
(4, 4, '2026-05-20', '20:00:00', 1, 12.50, 50, 43, '2026-05-19 17:10:37', '2026-05-19 17:10:37'),
(5, 5, '2026-05-20', '18:30:00', 2, 15.00, 50, 47, '2026-05-19 17:10:37', '2026-05-19 17:10:37'),
(6, 6, '2026-05-20', '15:00:00', 3, 8.00, 50, 49, '2026-05-19 17:10:37', '2026-05-19 17:10:37'),
(7, 7, '2026-05-21', '22:00:00', 1, 16.00, 50, 46, '2026-05-19 17:10:37', '2026-05-19 17:10:37'),
(8, 8, '2026-05-21', '17:30:00', 2, 11.00, 50, 48, '2026-05-19 17:10:37', '2026-05-19 17:10:37'),
(9, 9, '2026-05-21', '20:30:00', 3, 13.50, 50, 47, '2026-05-19 17:10:37', '2026-05-19 17:10:37'),
(10, 10, '2026-05-21', '14:30:00', 1, 9.00, 50, 48, '2026-05-19 17:10:37', '2026-05-19 17:10:37'),
(11, 1, '2026-05-20', '11:00:00', 1, 10.00, 60, 50, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(12, 1, '2026-05-20', '14:00:00', 1, 12.50, 60, 51, '2026-05-19 20:25:20', '2026-05-20 02:29:44'),
(13, 1, '2026-05-20', '17:00:00', 1, 12.50, 60, 54, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(14, 1, '2026-05-20', '20:00:00', 1, 14.00, 60, 52, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(15, 1, '2026-05-20', '22:30:00', 1, 14.00, 60, 60, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(16, 2, '2026-05-20', '12:30:00', 2, 11.00, 55, 50, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(17, 2, '2026-05-20', '15:30:00', 2, 13.00, 55, 46, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(18, 2, '2026-05-20', '18:30:00', 2, 13.00, 55, 49, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(19, 2, '2026-05-20', '21:30:00', 2, 15.00, 55, 55, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(20, 3, '2026-05-20', '13:00:00', 3, 10.00, 50, 45, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(21, 3, '2026-05-20', '16:00:00', 3, 11.00, 50, 41, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(22, 3, '2026-05-20', '19:00:00', 3, 11.00, 50, 50, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(23, 4, '2026-05-20', '15:00:00', 4, 10.00, 48, 48, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(24, 4, '2026-05-20', '20:00:00', 4, 12.00, 48, 48, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(25, 5, '2026-05-20', '14:00:00', 5, 13.00, 52, 47, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(26, 5, '2026-05-20', '17:00:00', 5, 14.00, 52, 48, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(27, 5, '2026-05-20', '20:00:00', 5, 15.00, 52, 52, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(28, 6, '2026-05-20', '10:00:00', 6, 8.00, 45, 40, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(29, 6, '2026-05-20', '13:30:00', 6, 9.00, 45, 45, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(30, 6, '2026-05-20', '17:00:00', 6, 9.00, 45, 45, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(31, 7, '2026-05-20', '19:00:00', 1, 16.00, 60, 58, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(32, 7, '2026-05-20', '22:00:00', 1, 17.00, 60, 60, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(33, 8, '2026-05-20', '11:30:00', 2, 11.00, 55, 48, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(34, 8, '2026-05-20', '15:00:00', 2, 11.00, 55, 55, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(35, 8, '2026-05-20', '19:30:00', 2, 13.00, 55, 55, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(36, 9, '2026-05-20', '16:30:00', 3, 15.00, 50, 50, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(37, 9, '2026-05-20', '20:30:00', 3, 16.00, 50, 50, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(38, 10, '2026-05-20', '12:00:00', 4, 9.00, 48, 48, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(39, 10, '2026-05-20', '15:30:00', 4, 9.00, 48, 48, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(40, 10, '2026-05-20', '18:30:00', 4, 10.00, 48, 48, '2026-05-19 20:25:20', '2026-05-19 20:25:20'),
(41, 1, '2026-05-21', '11:00:00', 1, 10.00, 60, 50, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(42, 1, '2026-05-21', '14:00:00', 1, 12.50, 60, 53, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(43, 1, '2026-05-21', '17:00:00', 1, 12.50, 60, 54, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(44, 1, '2026-05-21', '20:00:00', 1, 14.00, 60, 50, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(45, 1, '2026-05-21', '22:30:00', 1, 14.00, 60, 60, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(46, 2, '2026-05-21', '12:30:00', 2, 11.00, 55, 50, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(47, 2, '2026-05-21', '15:30:00', 2, 13.00, 55, 46, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(48, 2, '2026-05-21', '18:30:00', 2, 13.00, 55, 51, '2026-05-19 20:31:08', '2026-05-20 02:54:09'),
(49, 2, '2026-05-21', '21:30:00', 2, 15.00, 55, 55, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(50, 3, '2026-05-21', '13:00:00', 3, 10.00, 50, 45, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(51, 3, '2026-05-21', '16:00:00', 3, 11.00, 50, 41, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(52, 3, '2026-05-21', '19:00:00', 3, 11.00, 50, 50, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(53, 4, '2026-05-21', '15:00:00', 4, 10.00, 48, 48, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(54, 4, '2026-05-21', '20:00:00', 4, 12.00, 48, 48, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(55, 5, '2026-05-21', '14:00:00', 5, 13.00, 52, 46, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(56, 5, '2026-05-21', '17:00:00', 5, 14.00, 52, 47, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(57, 5, '2026-05-21', '20:00:00', 5, 15.00, 52, 52, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(58, 6, '2026-05-21', '10:00:00', 6, 8.00, 45, 39, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(59, 6, '2026-05-21', '13:30:00', 6, 9.00, 45, 45, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(60, 6, '2026-05-21', '17:00:00', 6, 9.00, 45, 45, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(61, 7, '2026-05-21', '19:00:00', 1, 16.00, 60, 54, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(62, 7, '2026-05-21', '22:00:00', 1, 17.00, 60, 60, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(63, 8, '2026-05-21', '11:30:00', 2, 11.00, 55, 48, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(64, 8, '2026-05-21', '15:00:00', 2, 11.00, 55, 50, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(65, 8, '2026-05-21', '19:30:00', 2, 13.00, 55, 55, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(66, 9, '2026-05-21', '16:30:00', 3, 15.00, 50, 45, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(67, 9, '2026-05-21', '20:30:00', 3, 16.00, 50, 50, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(68, 10, '2026-05-21', '12:00:00', 4, 9.00, 48, 44, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(69, 10, '2026-05-21', '15:30:00', 4, 9.00, 48, 48, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(70, 10, '2026-05-21', '18:30:00', 4, 10.00, 48, 48, '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(71, 11, '2026-05-20', '12:15:00', 3, 8.00, 50, 28, '2026-05-20 03:42:02', '2026-05-20 03:43:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_16_061652_create_peliculas_table', 1),
(5, '2026_05_16_061657_create_funciones_table', 1),
(6, '2026_05_16_061702_create_reservas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `duracion` int(11) NOT NULL,
  `clasificacion` varchar(10) NOT NULL,
  `sinopsis` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `titulo`, `genero`, `duracion`, `clasificacion`, `sinopsis`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 'Inception', 'Ciencia Ficción', 148, '+13', 'Un ladrón que roba secretos del subconsciente durante el sueño recibe la oportunidad de borrar su pasado a cambio de implantar una idea en la mente de un empresario.', 'peliculas/m2bU4QUFceTv8T1JqmuRLdbQr02jw9e1qT3wLVee.jpg', '2026-05-19 17:10:23', '2026-05-20 01:33:10'),
(2, 'The Dark Knight', 'Acción', 153, '+13', 'Batman enfrenta a su némesis, el Joker, un criminal psicópata que siembra el caos en Gotham City.', 'peliculas/knYw4NyFKmREglzI7t9Xb70E8NDZmBl4fMOh8ike.jpg', '2026-05-19 17:10:23', '2026-05-20 04:01:25'),
(3, 'Interstellar', 'Ciencia Ficción', 169, 'ATP', 'Un grupo de exploradores viaja a través de un agujero de gusano en busca de un nuevo hogar para la humanidad.', 'peliculas/kx1F3xXHdTKozIjAjUS3eTfXJQJATAKl4A8eEH10.jpg', '2026-05-19 17:10:23', '2026-05-19 23:17:40'),
(4, 'Parasite', 'Drama', 132, '+18', 'Una familia pobre se infiltra en la vida de una familia rica, desatando una serie de eventos inesperados.', 'peliculas/wSy4mcWPqZwD1NsJe7aVy9248jphYzax33NHno4r.jpg', '2026-05-19 17:10:23', '2026-05-20 01:49:04'),
(5, 'Spider-Man: No Way Home', 'Acción', 148, '+13', 'Peter Parker pide ayuda al Doctor Strange para ocultar su identidad, pero el hechizo sale mal y trae villanos de otros universos.', 'peliculas/kdEf45nJq7W1gx37OlatrUkMdrZz7UPlqt4WEqpJ.jpg', '2026-05-19 17:10:23', '2026-05-20 01:33:40'),
(6, 'Toy Story 4', 'Aventura', 100, 'ATP', 'Woody y Buzz emprenden un viaje para rescatar a Forky, un juguete de fabricación casera que no quiere ser un juguete.', 'peliculas/PNRdJIOHHGQXZoRhr96hxKg4JI6FGCiRsEXyfHll.jpg', '2026-05-19 17:10:23', '2026-05-20 01:33:58'),
(7, 'John Wick 4', 'Acción', 169, '+18', 'El legendario asesino a sueldo John Wick descubre un camino para derrotar a la Alta Mesa y recuperar su libertad.', 'peliculas/SMglRhHjqGQ5pVpp2KpFOG2DeL7uhwkugYr3Awul.jpg', '2026-05-19 17:10:23', '2026-05-20 01:34:10'),
(8, 'Barbie', 'Comedia', 114, '+13', 'Barbie es expulsada de Barbieland por no ser perfecta y emprende una aventura en el mundo real.', 'peliculas/rfP7ZBWqQLZb1ZQKIwTDaBqz4blShyuiiZAA9SCH.jpg', '2026-05-19 17:10:23', '2026-05-20 01:34:21'),
(9, 'Oppenheimer', 'Drama', 180, '+18', 'La historia del científico J. Robert Oppenheimer y su papel en la creación de la bomba atómica.', 'peliculas/Y1bUhV8pFZk7E6mtzAhiRQv6eePcjuH6gEZv7ZOj.jpg', '2026-05-19 17:10:23', '2026-05-20 01:34:52'),
(10, 'The Super Mario Bros Movie', 'Aventura', 92, 'ATP', 'Mario y Luigi viajan al Reino Champiñón para ayudar a la Princesa Peach a detener a Bowser.', 'peliculas/zefWX5pQpMSxthWtOrUowZozBCznNr4DXq9Er1gG.jpg', '2026-05-19 17:10:23', '2026-05-20 01:34:43'),
(11, 'Ready Player One', 'Ciencia Ficción', 140, '+13', 'Cuando muere el creador de una realidad virtual llamada el OASIS, hace un reto póstumo a todos los usuarios de OASIS para que encuentren su Huevo de Pascua, que le dará al buscador su fortuna y el control de su mundo.', 'peliculas/pVYxlguDkvlj1rVtYudFtrs2yVGMN5jnFY3VXw5Z.jpg', '2026-05-20 03:40:59', '2026-05-20 03:40:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `funcion_id` bigint(20) UNSIGNED NOT NULL,
  `cliente_nombre` varchar(100) NOT NULL,
  `cliente_email` varchar(100) NOT NULL,
  `cantidad_asientos` int(11) NOT NULL,
  `codigo_reserva` varchar(50) NOT NULL,
  `estado` enum('confirmada','cancelada') NOT NULL DEFAULT 'confirmada',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `funcion_id`, `cliente_nombre`, `cliente_email`, `cantidad_asientos`, `codigo_reserva`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'Carlos Pérez', 'carlos.perez@email.com', 2, 'CINE-A1B2C3D4', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(2, 1, 'Ana Gómez', 'ana.gomez@email.com', 3, 'CINE-E5F6G7H8', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(3, 1, 'Luis Martínez', 'luis.martinez@email.com', 1, 'CINE-I9J0K1L2', 'confirmada', '2026-05-19 15:29:38', '2026-05-19 15:29:38'),
(4, 2, 'María López', 'maria.lopez@email.com', 4, 'CINE-M3N4O5P6', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(5, 2, 'Juan Rodríguez', 'juan.rodriguez@email.com', 2, 'CINE-Q7R8S9T0', 'cancelada', '2026-05-18 17:29:38', '2026-05-18 17:29:38'),
(6, 3, 'Sofía Fernández', 'sofia.fernandez@email.com', 3, 'CINE-U1V2W3X4', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(7, 3, 'Diego Sánchez', 'diego.sanchez@email.com', 2, 'CINE-Y5Z6A7B8', 'confirmada', '2026-05-19 14:29:38', '2026-05-19 14:29:38'),
(8, 4, 'Laura Torres', 'laura.torres@email.com', 5, 'CINE-C9D0E1F2', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(9, 4, 'Pedro Ramírez', 'pedro.ramirez@email.com', 2, 'CINE-G3H4I5J6', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(10, 5, 'Carmen Vega', 'carmen.vega@email.com', 3, 'CINE-K7L8M9N0', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(11, 6, 'Roberto Díaz', 'roberto.diaz@email.com', 1, 'CINE-O1P2Q3R4', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(12, 7, 'Verónica Castro', 'veronica.castro@email.com', 4, 'CINE-S5T6U7V8', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(13, 8, 'Ricardo Medina', 'ricardo.medina@email.com', 2, 'CINE-W9X0Y1Z2', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(14, 9, 'Patricia Silva', 'patricia.silva@email.com', 3, 'CINE-A3B4C5D6', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(15, 10, 'Gabriel Ortiz', 'gabriel.ortiz@email.com', 2, 'CINE-E7F8G9H0', 'confirmada', '2026-05-19 17:29:38', '2026-05-19 17:29:38'),
(16, 11, 'Carlos Pérez', 'carlos.perez@gmail.com', 2, 'CINE-MAN-001', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(17, 11, 'Ana Gómez', 'ana.gomez@hotmail.com', 3, 'CINE-MAN-002', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(18, 11, 'Luis Martínez', 'luis.martinez@gmail.com', 1, 'CINE-MAN-003', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(19, 11, 'María Rodríguez', 'maria.rodriguez@gmail.com', 4, 'CINE-MAN-004', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(20, 12, 'Javier Fernández', 'javier.fernandez@gmail.com', 2, 'CINE-MAN-005', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(21, 12, 'Sofía López', 'sofia.lopez@hotmail.com', 3, 'CINE-MAN-006', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(22, 12, 'Diego Sánchez', 'diego.sanchez@gmail.com', 2, 'CINE-MAN-007', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(23, 13, 'Laura Torres', 'laura.torres@gmail.com', 4, 'CINE-MAN-008', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(24, 13, 'Pedro Ramírez', 'pedro.ramirez@hotmail.com', 2, 'CINE-MAN-009', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(25, 14, 'Carmen Vega', 'carmen.vega@gmail.com', 5, 'CINE-MAN-010', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(26, 14, 'Roberto Díaz', 'roberto.diaz@gmail.com', 3, 'CINE-MAN-011', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(27, 16, 'Patricia Silva', 'patricia.silva@gmail.com', 2, 'CINE-MAN-012', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(28, 16, 'Gabriel Ortiz', 'gabriel.ortiz@gmail.com', 3, 'CINE-MAN-013', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(29, 17, 'Verónica Castro', 'veronica.castro@hotmail.com', 4, 'CINE-MAN-014', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(30, 17, 'Ricardo Medina', 'ricardo.medina@gmail.com', 2, 'CINE-MAN-015', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(31, 17, 'Fernanda Ruiz', 'fernanda.ruiz@gmail.com', 3, 'CINE-MAN-016', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(32, 18, 'Alejandro Mora', 'alejandro.mora@hotmail.com', 2, 'CINE-MAN-017', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(33, 18, 'Daniela Flores', 'daniela.flores@gmail.com', 4, 'CINE-MAN-018', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(34, 20, 'Raúl Jiménez', 'raul.jimenez@gmail.com', 3, 'CINE-MAN-019', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(35, 20, 'Mónica Pérez', 'monica.perez@hotmail.com', 2, 'CINE-MAN-020', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(36, 21, 'Oscar Herrera', 'oscar.herrera@gmail.com', 4, 'CINE-MAN-021', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(37, 21, 'Claudia Reyes', 'claudia.reyes@gmail.com', 2, 'CINE-MAN-022', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(38, 21, 'Héctor Fuentes', 'hector.fuentes@hotmail.com', 3, 'CINE-MAN-023', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(39, 25, 'Lorena Méndez', 'lorena.mendez@gmail.com', 3, 'CINE-MAN-024', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(40, 25, 'Eduardo Castro', 'eduardo.castro@yahoo.com', 2, 'CINE-MAN-025', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(41, 26, 'Natalia Ríos', 'natalia.rios@gmail.com', 4, 'CINE-MAN-026', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(42, 33, 'Francisco Vega', 'francisco.vega@hotmail.com', 2, 'CINE-MAN-027', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(43, 33, 'Valentina Paz', 'valentina.paz@gmail.com', 5, 'CINE-MAN-028', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(44, 28, 'Andrés Silva', 'andres.silva@gmail.com', 3, 'CINE-MAN-029', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(45, 28, 'Camila Torres', 'camila.torres@gmail.com', 2, 'CINE-MAN-030', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(46, 31, 'Emiliano Rojas', 'emiliano.rojas@gmail.com', 2, 'CINE-MAN-031', 'confirmada', '2026-05-19 20:25:21', '2026-05-19 20:25:21'),
(47, 12, 'Rene', 'reneaparicio@gmail.com', 2, 'CINE-6A0CC8386B5C0', 'confirmada', '2026-05-20 02:29:44', '2026-05-20 02:29:44'),
(48, 41, 'Carlos Pérez', 'carlos.perez@gmail.com', 2, 'CINE-21-001', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(49, 41, 'Ana Gómez', 'ana.gomez@hotmail.com', 3, 'CINE-21-002', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(50, 41, 'Luis Martínez', 'luis.martinez@gmail.com', 1, 'CINE-21-003', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(51, 41, 'María Rodríguez', 'maria.rodriguez@gmail.com', 4, 'CINE-21-004', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(52, 42, 'Javier Fernández', 'javier.fernandez@gmail.com', 2, 'CINE-21-005', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(53, 42, 'Sofía López', 'sofia.lopez@hotmail.com', 3, 'CINE-21-006', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(54, 42, 'Diego Sánchez', 'diego.sanchez@gmail.com', 2, 'CINE-21-007', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(55, 43, 'Laura Torres', 'laura.torres@gmail.com', 4, 'CINE-21-008', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(56, 43, 'Pedro Ramírez', 'pedro.ramirez@hotmail.com', 2, 'CINE-21-009', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(57, 44, 'Carmen Vega', 'carmen.vega@gmail.com', 5, 'CINE-21-010', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(58, 44, 'Roberto Díaz', 'roberto.diaz@gmail.com', 3, 'CINE-21-011', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(59, 44, 'Patricia Silva', 'patricia.silva@gmail.com', 2, 'CINE-21-012', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(60, 46, 'Gabriel Ortiz', 'gabriel.ortiz@gmail.com', 3, 'CINE-21-013', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(61, 46, 'Verónica Castro', 'veronica.castro@hotmail.com', 2, 'CINE-21-014', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(62, 47, 'Ricardo Medina', 'ricardo.medina@gmail.com', 4, 'CINE-21-015', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(63, 47, 'Fernanda Ruiz', 'fernanda.ruiz@gmail.com', 2, 'CINE-21-016', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(64, 47, 'Alejandro Mora', 'alejandro.mora@hotmail.com', 3, 'CINE-21-017', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(65, 48, 'Daniela Flores', 'daniela.flores@gmail.com', 4, 'CINE-21-018', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(66, 48, 'Raúl Jiménez', 'raul.jimenez@gmail.com', 2, 'CINE-21-019', 'cancelada', '2026-05-19 20:31:08', '2026-05-20 02:54:09'),
(67, 50, 'Mónica Pérez', 'monica.perez@hotmail.com', 3, 'CINE-21-020', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(68, 50, 'Oscar Herrera', 'oscar.herrera@gmail.com', 2, 'CINE-21-021', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(69, 51, 'Claudia Reyes', 'claudia.reyes@gmail.com', 4, 'CINE-21-022', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(70, 51, 'Héctor Fuentes', 'hector.fuentes@hotmail.com', 2, 'CINE-21-023', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(71, 51, 'Lorena Méndez', 'lorena.mendez@gmail.com', 3, 'CINE-21-024', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(72, 55, 'Eduardo Castro', 'eduardo.castro@yahoo.com', 2, 'CINE-21-025', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(73, 55, 'Natalia Ríos', 'natalia.rios@gmail.com', 4, 'CINE-21-026', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(74, 56, 'Francisco Vega', 'francisco.vega@hotmail.com', 3, 'CINE-21-027', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(75, 56, 'Valentina Paz', 'valentina.paz@gmail.com', 2, 'CINE-21-028', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(76, 63, 'Andrés Silva', 'andres.silva@gmail.com', 3, 'CINE-21-029', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(77, 63, 'Camila Torres', 'camila.torres@gmail.com', 4, 'CINE-21-030', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(78, 64, 'Emiliano Rojas', 'emiliano.rojas@gmail.com', 2, 'CINE-21-031', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(79, 64, 'Paula Mendoza', 'paula.mendoza@gmail.com', 3, 'CINE-21-032', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(80, 58, 'Santiago Ríos', 'santiago.rios@gmail.com', 2, 'CINE-21-033', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(81, 58, 'Valeria Castro', 'valeria.castro@gmail.com', 3, 'CINE-21-034', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(82, 58, 'Mateo Flores', 'mateo.flores@hotmail.com', 1, 'CINE-21-035', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(83, 61, 'Renata Peña', 'renata.pena@gmail.com', 2, 'CINE-21-036', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(84, 61, 'Tomás Gutiérrez', 'tomas.gutierrez@gmail.com', 4, 'CINE-21-037', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(85, 66, 'Isabella Soto', 'isabella.soto@gmail.com', 2, 'CINE-21-038', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(86, 66, 'Nicolás Vargas', 'nicolas.vargas@gmail.com', 3, 'CINE-21-039', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(87, 68, 'Julieta León', 'julieta.leon@gmail.com', 4, 'CINE-21-040', 'confirmada', '2026-05-19 20:31:08', '2026-05-19 20:31:08'),
(88, 71, 'Osmin', 'Osminruiz@gmail.com', 2, 'CINE-6A0CD97175E3C', 'confirmada', '2026-05-20 03:43:13', '2026-05-20 03:43:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6QXcmFIN8s5J83uvEInhVS3e96LZ7b28FgKRZF1r', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlJKamc1eE9SblZyM0xVTjJqRlluTTJmQTF2NVVEazhpb1FVeHB6ViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXNlcnZhcyI7czo1OiJyb3V0ZSI7czoxNDoicmVzZXJ2YXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1779231177);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funciones_pelicula_id_foreign` (`pelicula_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservas_codigo_reserva_unique` (`codigo_reserva`),
  ADD KEY `reservas_funcion_id_foreign` (`funcion_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD CONSTRAINT `funciones_pelicula_id_foreign` FOREIGN KEY (`pelicula_id`) REFERENCES `peliculas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_funcion_id_foreign` FOREIGN KEY (`funcion_id`) REFERENCES `funciones` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
