-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2024 a las 07:46:39
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nubillia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banks`
--

CREATE TABLE `banks` (
  `id_bank` int(11) NOT NULL,
  `id_tenant_bank` int(11) NOT NULL,
  `id_store_bank` int(11) NOT NULL,
  `name_bank` text NOT NULL,
  `status_bank` int(11) NOT NULL,
  `created_bank` date NOT NULL,
  `updated_bank` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plans`
--

CREATE TABLE `plans` (
  `id_plan` int(11) NOT NULL,
  `name_plan` text NOT NULL,
  `description_plan` text NOT NULL,
  `price_plan` float NOT NULL,
  `content_plan` text NOT NULL,
  `sales_plan` int(11) NOT NULL,
  `status_plan` int(11) NOT NULL,
  `created_plan` date NOT NULL,
  `updated_plan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `plans`
--

INSERT INTO `plans` (`id_plan`, `name_plan`, `description_plan`, `price_plan`, `content_plan`, `sales_plan`, `status_plan`, `created_plan`, `updated_plan`) VALUES
(5, 'Básico', '<p>Plan Básico</p>', 50, '', 0, 1, '2024-12-03', '2024-12-04 04:52:43'),
(6, 'Estándar', '<p>Plan Estándar</p>', 100, '', 0, 1, '2024-12-03', '2024-12-04 05:26:57'),
(7, 'Premium', '<p><b>Plan</b> Premium</p>', 250, '', 0, 1, '2024-12-03', '2024-12-04 06:41:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions`
--

CREATE TABLE `positions` (
  `id_position` int(11) NOT NULL,
  `id_tenant_position` int(11) NOT NULL,
  `id_store_position` int(11) NOT NULL,
  `name_position` text NOT NULL,
  `status_position` int(11) NOT NULL,
  `created_position` date NOT NULL,
  `updated_position` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `positions`
--

INSERT INTO `positions` (`id_position`, `id_tenant_position`, `id_store_position`, `name_position`, `status_position`, `created_position`, `updated_position`) VALUES
(1, 0, 0, 'Super Administrador', 1, '2024-12-01', '2024-12-02 02:35:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

CREATE TABLE `rols` (
  `id_rol` int(11) NOT NULL,
  `id_tenant_rol` int(11) NOT NULL,
  `id_store_rol` int(11) NOT NULL,
  `name_rol` text NOT NULL,
  `access_rol` text NOT NULL,
  `created_rol` date NOT NULL,
  `updated_rol` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rols`
--

INSERT INTO `rols` (`id_rol`, `id_tenant_rol`, `id_store_rol`, `name_rol`, `access_rol`, `created_rol`, `updated_rol`) VALUES
(1, 0, 0, 'Super Administrador', '[]', '2024-12-01', '2024-12-02 06:00:04'),
(2, 0, 0, 'Administrador', '[]', '2024-12-02', '2024-12-02 06:00:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id_setting` int(11) NOT NULL,
  `name_system_setting` text NOT NULL,
  `name_company_setting` text NOT NULL,
  `web_setting` text NOT NULL,
  `logo_setting` text NOT NULL,
  `favicon_setting` text NOT NULL,
  `description_setting` text NOT NULL,
  `keywords_setting` text NOT NULL,
  `whatsapp_setting` text NOT NULL,
  `paypal_setting` text NOT NULL,
  `culqi_setting` text NOT NULL,
  `bank_setting` text NOT NULL,
  `invoice_setting` text NOT NULL,
  `youtube_setting` text NOT NULL,
  `server_setting` text NOT NULL,
  `extras_setting` text NOT NULL,
  `created_setting` date NOT NULL,
  `updated_setting` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id_setting`, `name_system_setting`, `name_company_setting`, `web_setting`, `logo_setting`, `favicon_setting`, `description_setting`, `keywords_setting`, `whatsapp_setting`, `paypal_setting`, `culqi_setting`, `bank_setting`, `invoice_setting`, `youtube_setting`, `server_setting`, `extras_setting`, `created_setting`, `updated_setting`) VALUES
(1, 'Nubillia', 'Chanamoth', 'https://chanamoth.com/', '', '', '<span style=\"text-align: center;\">Gestiona tu empresa, equipos, sucursales, inventarios y ventas desde una plataforma segura, centralizada y fácil de usar, con reportes detallados al alcance de tu mano.</span>', '[\"Nubillia\",\"Chanamoth\",\"SAAS\",\"ERP\"]', 'https://wa.link/9g29eb', '[{\"client_id\":\"AQlSK5pzTMhnsu-u9WCLvFYyONZ2IZHEP5Ft9nSH2xrhyQPeJ3BDCHhGiMjBMFrEDTozlAhQLuOdAUD5\",\"secret_key\":\"EFPeb__QkEQCxj3CunqXVk9nQn6XYdZRLyxIzXE89McT2AiCI_7kKwkJK-NMwfwL8lZW3hx7WDyK5pm8\"}]', '[{\"public_key\":\"\",\"secret_key\":\"\"}]', '[{\"qr_yape\":\"\",\"qr_plin\":\"\",\"cuenta_bancaria\":\"\",\"ncuenta_bancaria\":\"\"}]', '[{\"estado\":\"activo\",\"factura\":{\"serie\":\"F001\",\"correlativo\":12},\"empresa\":{\"ruc\":\"11111111111\",\"razonSocial\":\"EMPRESA DEMOSTRACION SAC\",\"nombreComercial\":\"DEMO\",\"departamento\":\"LIMA\",\"provincia\":\"LIMA\",\"distrito\":\"LOS OLIVOS\",\"ubigeo\":\"150117\",\"direccion\":\"AVENIDA DEMOSTRACION 132\",\"telefono\":\"999999999\",\"email\":\"demo@gmail.com\"},\"sunat\":{\"modo\":\"beta\",\"usuarioSol\":\"MODDATOS\",\"claveSol\":\"moddatos\",\"claveCertificado\":\"\",\"expiraCertificado\":\"\"}}]', 'https://www.youtube.com/@developertechnolog', '[{\"server\":\"si\",\"host\":\"mail.chanamoth.com\",\"user\":\"info@chanamoth.com\",\"pass\":\"Cl@rodeluna199407\",\"security\":\"ssl\",\"port\":\"465\",\"email\":\"info@chanamoth.com\"}]', '[{\"reset_pass\":\"si\",\"register_system\":\"si\",\"social_login\":\"no\"}]', '2024-12-02', '2024-12-04 06:14:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stores`
--

CREATE TABLE `stores` (
  `id_store` int(11) NOT NULL,
  `id_tenant_store` int(11) NOT NULL,
  `name_store` text NOT NULL,
  `address_store` text NOT NULL,
  `status_store` int(11) NOT NULL,
  `type_store` int(11) NOT NULL,
  `created_store` date NOT NULL,
  `updated_store` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stores`
--

INSERT INTO `stores` (`id_store`, `id_tenant_store`, `name_store`, `address_store`, `status_store`, `type_store`, `created_store`, `updated_store`) VALUES
(1, 1, 'Principal', 'Avenida Demo 123', 1, 1, '2024-12-01', '2024-12-02 02:36:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tenants`
--

CREATE TABLE `tenants` (
  `id_tenant` int(11) NOT NULL,
  `id_plan_tenant` int(11) NOT NULL,
  `ruc_tenant` text NOT NULL,
  `name_tenant` text NOT NULL,
  `address_tenant` text NOT NULL,
  `email_tenant` text NOT NULL,
  `phone_tenant` text NOT NULL,
  `logo_tenant` text NOT NULL,
  `web_tenant` text NOT NULL,
  `status_tenant` int(11) NOT NULL,
  `prox_bill_tenant` date NOT NULL,
  `server_tenant` text NOT NULL,
  `sunat_tenant` text NOT NULL,
  `modules_tenant` text NOT NULL,
  `created_tenant` date NOT NULL,
  `updated_tenant` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tenants`
--

INSERT INTO `tenants` (`id_tenant`, `id_plan_tenant`, `ruc_tenant`, `name_tenant`, `address_tenant`, `email_tenant`, `phone_tenant`, `logo_tenant`, `web_tenant`, `status_tenant`, `prox_bill_tenant`, `server_tenant`, `sunat_tenant`, `modules_tenant`, `created_tenant`, `updated_tenant`) VALUES
(1, 5, '10725799093', 'ROJAS CHANAMOTH MARIO JHUNIOR', 'AAHH 19 DE MAYO MZ B LT 1', 'info@chanamoth.com', '935852750', '', 'https//chanamoth.com', 1, '0000-00-00', '[{\"server\":\"no\",\"host\":\"\",\"user\":\"\",\"pass\":\"\",\"security\":\"\",\"port\":\"\",\"document\":\"\",\"marketing\":\"\"}]', '[{\"api\":\"no\",\"token\":\"\",\"secret\":\"\",\"departament\":\"\",\"province\":\"\",\"district\":\"\",\"ubigee\":\"\",\"phase\":\"\",\"user_sol\":\"\",\"pass_sol\":\"\",\"exp_cert\":\"\",\"pass_cert\":\"\"}]', '[]', '2024-12-01', '2024-12-04 04:52:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_tenant_user` text NOT NULL,
  `id_store_user` text NOT NULL,
  `id_worker_user` int(11) NOT NULL,
  `id_rol_user` int(11) NOT NULL,
  `username_user` text NOT NULL,
  `password_user` text NOT NULL,
  `status_user` int(11) NOT NULL,
  `chat_user` int(11) NOT NULL,
  `extras_user` text NOT NULL,
  `token_user` text NOT NULL,
  `token_exp_user` text NOT NULL,
  `created_user` date NOT NULL,
  `updated_user` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `id_tenant_user`, `id_store_user`, `id_worker_user`, `id_rol_user`, `username_user`, `password_user`, `status_user`, `chat_user`, `extras_user`, `token_user`, `token_exp_user`, `created_user`, `updated_user`) VALUES
(1, '[]', '[{\"id\":\"1\"}]', 1, 1, 'superadmin', '$2a$07$azybxcags23425sdg23sdeeKAqt96CqhlXh4xR.Kd9524vrpGvri6', 1, 1, '', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MzMyOTQ3NDcsImV4cCI6MTczMzM4MTE0NywiZGF0YSI6eyJpZCI6MSwiZW1haWwiOiJzdXBlcmFkbWluIn19.Q53fMT4qn_Vosynmerd9SBKs8y8C2ilBPBwg3yEeeS8', '1733381147', '2024-12-01', '2024-12-04 06:45:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workers`
--

CREATE TABLE `workers` (
  `id_worker` int(11) NOT NULL,
  `id_tenant_worker` int(11) NOT NULL,
  `id_store_worker` int(11) NOT NULL,
  `id_position_worker` int(11) NOT NULL,
  `id_bank_worker` int(11) NOT NULL,
  `name_worker` text NOT NULL,
  `email_worker` text NOT NULL,
  `phone_worker` text NOT NULL,
  `photo_worker` text NOT NULL,
  `status_worker` int(11) NOT NULL,
  `rrhh_worker` text NOT NULL,
  `created_worker` date NOT NULL,
  `updated_worker` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `workers`
--

INSERT INTO `workers` (`id_worker`, `id_tenant_worker`, `id_store_worker`, `id_position_worker`, `id_bank_worker`, `name_worker`, `email_worker`, `phone_worker`, `photo_worker`, `status_worker`, `rrhh_worker`, `created_worker`, `updated_worker`) VALUES
(1, 0, 0, 1, 1, 'Super Administrador', 'admin@admin.com', '935852750', '', 1, '[{\"birthday\":\"\",\"document\":\"\",\"type\":\"\",\"salary\":\"\",\"horary\":\"\",\"family\":\"\",\"sons\":\"\",\"address\":\"\",\"gender\":\"\",\"enter\":\"\",\"pension\":\"\",\"account\":\"\",\"signature\":\"\"}]', '2024-12-01', '2024-12-02 05:59:41');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indices de la tabla `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id_plan`);

--
-- Indices de la tabla `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id_position`);

--
-- Indices de la tabla `rols`
--
ALTER TABLE `rols`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indices de la tabla `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id_store`);

--
-- Indices de la tabla `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id_tenant`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id_worker`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banks`
--
ALTER TABLE `banks`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plans`
--
ALTER TABLE `plans`
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `id_position` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rols`
--
ALTER TABLE `rols`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `stores`
--
ALTER TABLE `stores`
  MODIFY `id_store` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id_tenant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `workers`
--
ALTER TABLE `workers`
  MODIFY `id_worker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
