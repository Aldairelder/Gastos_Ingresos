-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-12-2023 a las 01:52:42
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mopbersc_gimp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clase` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `clase`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Multas', '-', 1, '2023-12-29 17:57:35', '2023-12-29 17:57:35'),
(2, 'Servicios', '-', 1, '2023-12-29 17:57:40', '2023-12-29 17:57:40'),
(3, 'Licencias', '-', 1, '2023-12-29 17:57:46', '2023-12-29 17:57:46'),
(4, 'Permisos', '-', 1, '2023-12-29 17:58:03', '2023-12-29 17:58:03'),
(5, 'Rust-eze', '-', 1, '2023-12-29 17:59:54', '2023-12-29 17:59:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_gastos`
--

CREATE TABLE `detalles_gastos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idgasto` bigint(20) UNSIGNED NOT NULL,
  `detalle` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_gastos`
--

INSERT INTO `detalles_gastos` (`id`, `idgasto`, `detalle`, `cantidad`, `precio`) VALUES
(1, 1, 'Servicio de Agua Potable', 1, 50),
(2, 1, 'Servicio Electrico', 1, 75),
(4, 3, 'AA', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ingresos`
--

CREATE TABLE `detalles_ingresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idingreso` bigint(20) UNSIGNED NOT NULL,
  `detalle` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_ingresos`
--

INSERT INTO `detalles_ingresos` (`id`, `idingreso`, `detalle`, `cantidad`, `precio`) VALUES
(1, 1, 'Licencia de Local', 1, 100),
(2, 1, 'Permiso de Comercio', 1, 170);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidades`
--

CREATE TABLE `entidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo` char(255) NOT NULL,
  `nrodoc` varchar(255) NOT NULL,
  `entidad` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `entidades`
--

INSERT INTO `entidades` (`id`, `tipo`, `nrodoc`, `entidad`, `direccion`, `telefono`, `email`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'E', '10761421803', 'Mober\'s', 'Av. Programación', '940703240', 'mobers@gmail.com', 1, '2023-12-29 18:00:45', '2023-12-29 18:00:45'),
(2, 'P', '72690505', 'Angelo Sthiwar Merino Sorroza', 'Calle El Tablazo N° 312 - Tumbes.', '939317935', 'angelomerino07@gmail.com', 1, '2023-12-29 18:02:30', '2023-12-29 18:02:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idclase` bigint(20) UNSIGNED NOT NULL,
  `nrodoc` varchar(15) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `total` double NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `idclase`, `nrodoc`, `titulo`, `descripcion`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, '202312251', 'Consumo', '-', 125, 1, '2023-12-30 05:02:06', '2023-12-30 05:02:06'),
(3, 5, '202312251', '1', NULL, 2, 1, '2023-12-30 06:13:31', '2023-12-30 06:13:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idclase` bigint(20) UNSIGNED NOT NULL,
  `identidad` bigint(20) UNSIGNED NOT NULL,
  `nrodoc` varchar(15) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `total` double NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `idclase`, `identidad`, `nrodoc`, `titulo`, `descripcion`, `total`, `estado`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '202312260', 'Permiso de regulaciones', '-', 270, 1, '2023-12-30 07:32:29', '2023-12-30 07:32:29');

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
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_12_29_010246_create_rol_table', 2),
(5, '2023_12_29_010503_create_permisos_table', 2),
(6, '2023_12_29_010556_create_modulo_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nrodoc` varchar(255) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`id`, `nrodoc`, `nombres`, `apellidos`, `telefono`, `email`, `estado`, `created_at`, `updated_at`) VALUES
(1, '76142180', 'Gabriel Santos', 'Benites Portocarrero', '948703240', 'portocarrero.benites.gabriel@gmail.com', 1, '2023-11-12 03:21:45', '2023-11-12 03:21:45'),
(2, '12345678', 'Kevins Stiwar', 'Atoche Icanaque', '933830275', 'katocheicanaque@gmail.com', 1, '2023-12-29 22:49:35', '2023-12-29 22:49:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idtrabajador` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `idtrabajador`, `usuario`, `password`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, '76142180', '$2y$10$0WIdkShsx9olbsw0FMyMUOkpmATMbF0NKpR0KE2MgGtk4/rm8GvDq', 1, '2023-11-12 03:21:45', '2023-11-12 03:21:45'),
(2, 2, '12345678', '$2y$12$lggWD9cohJygvCMTNPTXCuWJAe24r1s3AfgS/s1OsBaD1oZbRqobG', 0, '2023-12-29 23:27:29', '2023-12-30 05:40:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_gastos`
--
ALTER TABLE `detalles_gastos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalles_gastos_idgasto_foreign` (`idgasto`);

--
-- Indices de la tabla `detalles_ingresos`
--
ALTER TABLE `detalles_ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalles_ingresos_idingreso_foreign` (`idingreso`);

--
-- Indices de la tabla `entidades`
--
ALTER TABLE `entidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gastos_idclase_foreign` (`idclase`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingresos_idclase_foreign` (`idclase`),
  ADD KEY `ingresos_identidad_foreign` (`identidad`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trabajador_nrodoc_unique` (`nrodoc`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_idtrabajador_foreign` (`idtrabajador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalles_gastos`
--
ALTER TABLE `detalles_gastos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalles_ingresos`
--
ALTER TABLE `detalles_ingresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `entidades`
--
ALTER TABLE `entidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_gastos`
--
ALTER TABLE `detalles_gastos`
  ADD CONSTRAINT `detalles_gastos_idgasto_foreign` FOREIGN KEY (`idgasto`) REFERENCES `gastos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_ingresos`
--
ALTER TABLE `detalles_ingresos`
  ADD CONSTRAINT `detalles_ingresos_idingreso_foreign` FOREIGN KEY (`idingreso`) REFERENCES `ingresos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `gastos_idclase_foreign` FOREIGN KEY (`idclase`) REFERENCES `clases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_idclase_foreign` FOREIGN KEY (`idclase`) REFERENCES `clases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingresos_identidad_foreign` FOREIGN KEY (`identidad`) REFERENCES `entidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_idtrabajador_foreign` FOREIGN KEY (`idtrabajador`) REFERENCES `trabajador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
