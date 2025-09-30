-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2025 a las 17:52:47
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
-- Base de datos: `barberia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barberos`
--

CREATE TABLE `barberos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `horario` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `barbero_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_hora` datetime NOT NULL,
  `servicio` varchar(100) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'pendiente',
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `usuario_id`, `barbero_id`, `fecha_hora`, `servicio`, `estado`, `email`, `created_at`, `updated_at`) VALUES
(18, 7, NULL, '2025-09-25 14:35:00', 'corte', 'pendiente', 'admin@barberia.com', '2025-09-21 10:35:50', '2025-09-21 10:35:50'),
(19, 13, 20, '2025-10-02 18:00:00', 'Afeitado', 'pendiente', 'carlos3252@gmail.com', '2025-09-26 09:16:10', '2025-09-26 09:16:10'),
(20, 14, 20, '2025-10-02 18:30:00', 'Afeitado', 'pendiente', 'jedavid20037@hotmail.com', '2025-09-26 09:18:10', '2025-09-26 09:18:10'),
(21, 13, 19, '2025-10-02 15:00:00', 'Afeitado', 'pendiente', 'carlos3252@gmail.com', '2025-09-30 09:33:10', '2025-09-30 09:33:10'),
(23, 25, 22, '2025-10-02 17:30:00', 'Afeitado', 'pendiente', 'marcos@gmail.com', '2025-09-30 20:38:42', '2025-09-30 20:38:42'),
(24, 26, 20, '2025-10-10 16:30:00', 'Afeitado', 'cancelada', 'carlos@gmail.com', '2025-09-30 20:42:52', '2025-09-30 20:45:32'),
(25, 26, 19, '2025-10-09 17:30:00', 'Arreglo de barba', 'cancelada', 'carlos@gmail.com', '2025-09-30 20:51:52', '2025-09-30 20:52:09');

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
(1, '2025_09_16_181346_create_usuarios_table', 1),
(2, '2025_09_16_181400_create_barberos_table', 1),
(3, '2025_09_16_181433_create_productos_table', 1),
(4, '2025_09_16_181456_create_citas_table', 1),
(5, '2025_09_16_181508_create_sugerencias_table', 1),
(6, '2025_09_16_184050_create_sessions_table', 1),
(7, '2025_09_22_123456_add_remember_token_to_usuarios_table', 2),
(8, '2025_09_25_162512_add_activo_to_usuarios_table', 3),
(9, '2025_09_26_040640_add_unique_barbero_fecha_hora_to_citas_table', 4),
(10, '2025_09_30_140825_create_ventas_table', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `categoria` varchar(50) NOT NULL DEFAULT '',
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('thYt2j545YyxKELzJ79nZu0dpTVUgMEkrLHx8Nos', 26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVGxGcHY2VW95SU1VeU9XTWtmblpQUEFQOHRrVGRaRUVtWURPYldDbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9oaXN0b3JpYWwiO31zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjQyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vbGlzdGEtdXN1YXJpb3MiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyNjt9', 1759247537);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerencias`
--

CREATE TABLE `sugerencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sugerencias`
--

INSERT INTO `sugerencias` (`id`, `nombre`, `email`, `mensaje`, `created_at`, `updated_at`) VALUES
(1, 'Jesus', 'jedavid2007@hotmail.com', 'fsdfsfsdfsf', '2025-09-21 10:38:29', '2025-09-21 10:38:29'),
(2, 'carlos', 'carlos3252@gmail.com', 'Gracias por tener la barberia', '2025-09-25 19:31:05', '2025-09-25 19:31:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('cliente','admin','barbero') NOT NULL DEFAULT 'cliente',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `telefono`, `email`, `password`, `rol`, `remember_token`, `created_at`, `updated_at`, `activo`) VALUES
(7, 'admin', '1111111111', 'admin@barberia.com', '$2y$12$mbdIyljsjx49t1peNpQ9MOD5SyDFO9IYhFNdnAVibmZW6QiMOOIN6', 'admin', NULL, '2025-09-21 10:32:51', '2025-09-21 10:32:51', 1),
(13, 'carlos', '1111111111', 'carlos3252@gmail.com', '$2y$12$9z23akMJZQknc5DUBnhjuO46n2y07bHg3ovoqTzGCwieF7V6ojR7a', 'cliente', NULL, '2025-09-21 22:14:42', '2025-09-21 22:14:42', 1),
(14, 'JesusDavid150', '1111111111', 'jedavid20037@hotmail.com', '$2y$12$HzJKDT.fhiE5Hdx15dbSQeqiHx3nvFlgOFf43PPbT0Gt.gkWPB24a', 'cliente', NULL, '2025-09-21 22:15:07', '2025-09-21 22:15:07', 1),
(15, 'jesus', '3143360124', 'admissn@barberia.com', '$2y$12$ijm5eG1KjDEzcNfS9Axnf.0kzajKDuW/zWoM1YTH09jjXxAm9L0rq', 'cliente', NULL, '2025-09-21 22:20:14', '2025-09-21 22:20:14', 1),
(19, 'Andres Morales', '3002345678', 'andres.morales@barberia.com', '$2y$12$7fDSQhOPvNnuTvHGGPdWzejS1ylqptPGjmlpDQ13ZPxc63bAwTySO', 'barbero', NULL, '2025-09-22 20:45:23', '2025-09-22 20:45:23', 1),
(20, 'Julian Herrera', '3003456789', 'julian.herrera@barberia.com', '$2y$12$7vQd/WQhXg86C2ZddMqMuen6fAbjGXzr/aF1SBEsgBc8m8HuLcrsK', 'barbero', NULL, '2025-09-22 20:45:23', '2025-09-22 20:45:23', 1),
(21, 'Miguel Torres', '3004567890', 'miguel.torres@barberia.com', '$2y$12$8/HMv0hKPIN2Ko1UjS1HxuvQLHng7u0qfV8voGP4JW/c/.jcYw4e.', 'barbero', NULL, '2025-09-22 20:45:24', '2025-09-25 21:41:54', 0),
(22, 'Fernando Lopez', '3005678901', 'fernando.lopez@barberia.com', '$2y$12$de2p.DOYT9jSjHmvNs.7XO0WiSiOg6NNZgIJpg0v1XBAlvhpNRQQW', 'barbero', NULL, '2025-09-22 20:45:24', '2025-09-22 20:45:24', 1),
(23, 'Santiago', '1111111111', 'santiago@gmail.com', '$2y$12$OedHF5reYjxfIu/JiMfAo.RWtv19q6YQhDq2TYWmcV13F12SBcv6O', 'cliente', NULL, '2025-09-30 09:02:38', '2025-09-30 09:02:38', 1),
(24, 'admin juan', '1111111111', 'adminjuan@barberia.com', '$2y$12$Cx/gEe84cQEvQiOUCBEa4eoUCTuVEuLfs.MZejDywndGoBQtaDnuq', 'admin', NULL, '2025-09-30 09:04:07', '2025-09-30 09:04:07', 1),
(25, 'Marcos', '1111111111', 'marcos@gmail.com', '$2y$12$SZ7O1tVsqtbc9zcu.pnsV.xMud1k0yphwBNwyOE/K4hJoKpry9IGa', 'cliente', NULL, '2025-09-30 19:50:39', '2025-09-30 19:50:39', 1),
(26, 'carlos', '1111111111', 'carlos@gmail.com', '$2y$12$q5QPC6u6Q4NBo9tM3VbOs.syT4.OMxH.ynFDQcOxnq2woCeGuU7vG', 'cliente', NULL, '2025-09-30 20:42:24', '2025-09-30 20:42:24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `barbero_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barberos`
--
ALTER TABLE `barberos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD UNIQUE KEY `citas_barbero_id_fecha_hora_unique` (`barbero_id`,`fecha_hora`),
  ADD KEY `citas_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_email_unique` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `ventas_producto_id_foreign` (`producto_id`),
  ADD KEY `ventas_barbero_id_foreign` (`barbero_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barberos`
--
ALTER TABLE `barberos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_barbero_id_foreign` FOREIGN KEY (`barbero_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `citas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_barbero_id_foreign` FOREIGN KEY (`barbero_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ventas_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
