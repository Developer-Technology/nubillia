-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2024 a las 06:54:03
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
(5, 'Básico', '', 50, '[{\"users\":\"5\",\"stores\":\"1\",\"warehouses\":\"2\"}]', 1, 1, '2024-12-03', '2024-12-06 05:10:02'),
(6, 'Estándar', '', 100, '[{\"users\":\"10\",\"stores\":\"2\",\"warehouses\":\"5\"}]', 1, 1, '2024-12-03', '2024-12-06 05:30:39'),
(7, 'Premium', '', 250, '[{\"users\":\"50\",\"stores\":\"10\",\"warehouses\":\"10\"}]', 2, 1, '2024-12-03', '2024-12-06 05:36:49');

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
-- Estructura de tabla para la tabla `saleadmins`
--

CREATE TABLE `saleadmins` (
  `id_saleadmin` int(11) NOT NULL,
  `id_user_saleadmin` int(11) NOT NULL,
  `id_tenant_saleadmin` int(11) NOT NULL,
  `id_plan_saleadmin` int(11) NOT NULL,
  `method_saleadmin` text NOT NULL,
  `trans_saleadmin` text NOT NULL,
  `money_saleadmin` text NOT NULL,
  `price_saleadmin` float NOT NULL,
  `type_change_saleadmin` float NOT NULL,
  `status_saleadmin` text NOT NULL,
  `created_saleadmin` date NOT NULL,
  `updated_saleadmin` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `saleadmins`
--

INSERT INTO `saleadmins` (`id_saleadmin`, `id_user_saleadmin`, `id_tenant_saleadmin`, `id_plan_saleadmin`, `method_saleadmin`, `trans_saleadmin`, `money_saleadmin`, `price_saleadmin`, `type_change_saleadmin`, `status_saleadmin`, `created_saleadmin`, `updated_saleadmin`) VALUES
(2, 1, 4, 5, 'Plin', '17334618022722325', 'PEN', 50, 3.734, 'pagado', '2024-12-06', '2024-12-06 05:38:52'),
(3, 1, 5, 6, 'Paypal', '17334621814369818', 'USD', 200, 3.734, 'pagado', '2024-12-06', '2024-12-06 05:38:54'),
(4, 1, 6, 7, 'Paypal', '173346324338634a7', 'USD', 3000, 3.734, 'pagado', '2024-12-06', '2024-12-06 05:38:55'),
(5, 1, 7, 7, 'Yape', '17334634087206dfa', 'PEN', 250, 3.734, 'pagado', '2024-12-06', '2024-12-06 05:38:57');

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
(1, 'Nubillia', 'Chanamoth', 'https://chanamoth.com/', '', '$2a$07$azybxcags23425sdg23sdejaPvPDuI1PtPWzomfYn9qds9Uh593Pm.png', 'Gestiona tu empresa, equipos, sucursales, inventarios y ventas desde una plataforma segura, centralizada y fácil de usar, con reportes detallados al alcance de tu mano.<br>', '[\"Nubillia\",\"Chanamoth\",\"SAAS\",\"ERP\"]', 'https://wa.link/9g29eb', '[{\"client_id\":\"AQlSK5pzTMhnsu-u9WCLvFYyONZ2IZHEP5Ft9nSH2xrhyQPeJ3BDCHhGiMjBMFrEDTozlAhQLuOdAUD5\",\"secret_key\":\"EFPeb__QkEQCxj3CunqXVk9nQn6XYdZRLyxIzXE89McT2AiCI_7kKwkJK-NMwfwL8lZW3hx7WDyK5pm8\"}]', '[{\"public_key\":\"\",\"secret_key\":\"\"}]', '[{\"qr_yape\":\"\",\"qr_plin\":\"\",\"cuenta_bancaria\":\"\",\"ncuenta_bancaria\":\"\"}]', '[{\"factura\":{\"serie\":\"\",\"correlativo\":\"\",\"automatico\":\"\"},\"api\":{\"activo\":\"no\",\"token\":\"\",\"secret\":\"\"}}]', 'https://www.youtube.com/@developertechnolog', '[{\"server\":\"si\",\"host\":\"mail.chanamoth.com\",\"user\":\"info@chanamoth.com\",\"pass\":\"Cl@rodeluna199407\",\"security\":\"ssl\",\"port\":\"465\",\"email\":\"info@chanamoth.com\"}]', '[{\"reset_pass\":\"si\",\"register_system\":\"si\",\"social_login\":\"no\"}]', '2024-12-02', '2024-12-06 05:43:43');

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
(2, 4, 'Tienda Principal', 'AAHH 19 DE MAYO MZ B LOTE 1', 1, 1, '2024-12-06', '2024-12-06 05:42:25'),
(3, 5, 'Tienda Principal', 'MZA. A LOTE. 06 URB.  VILLA UNIVERSITARIA  (CALLE 6)', 1, 1, '2024-12-06', '2024-12-06 05:42:29'),
(4, 6, 'Tienda Principal', 'AV. REPÚBLICA DE PANAMÁ NRO. 4050 URB.  LIMATAMBO  (LOS NEGOCIOS 490)', 1, 1, '2024-12-06', '2024-12-06 05:42:31'),
(5, 7, 'Tienda Principal', 'FRANCISCO BOLOGNESI NRO. 550 (A UNA CUADRA DEL OVALO SANTA ANITA)', 1, 1, '2024-12-06', '2024-12-06 05:42:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscriptions`
--

CREATE TABLE `suscriptions` (
  `id_suscription` int(11) NOT NULL,
  `id_tenant_suscription` int(11) NOT NULL,
  `id_user_suscription` int(11) NOT NULL,
  `id_plan_suscription` int(11) NOT NULL,
  `trans_suscription` text NOT NULL,
  `emision_suscription` date NOT NULL,
  `pay_suscription` date NOT NULL,
  `price_suscription` float NOT NULL,
  `method_suscription` text NOT NULL,
  `operation_suscription` text NOT NULL,
  `status_suscription` text NOT NULL,
  `file_suscription` text NOT NULL,
  `created_suscription` date NOT NULL,
  `updated_suscription` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `suscriptions`
--

INSERT INTO `suscriptions` (`id_suscription`, `id_tenant_suscription`, `id_user_suscription`, `id_plan_suscription`, `trans_suscription`, `emision_suscription`, `pay_suscription`, `price_suscription`, `method_suscription`, `operation_suscription`, `status_suscription`, `file_suscription`, `created_suscription`, `updated_suscription`) VALUES
(2, 4, 1, 5, '17334618022722325', '2024-12-06', '2024-12-06', 50, 'Plin', '22222', 'pagado', '', '2024-12-06', '2024-12-06 05:39:30'),
(3, 5, 1, 6, '17334621814369818', '2024-12-06', '2024-12-06', 200, 'Paypal', '1253', 'pagado', '', '2024-12-06', '2024-12-06 05:39:33'),
(4, 6, 1, 7, '173346324338634a7', '2024-12-06', '2024-12-06', 3000, 'Paypal', '57896', 'pagado', '', '2024-12-06', '2024-12-06 05:39:34'),
(5, 7, 1, 7, '17334634087206dfa', '2024-12-06', '2024-12-06', 250, 'Yape', '89741', 'pagado', '', '2024-12-06', '2024-12-06 05:39:36');

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
(4, 5, '10725799093', 'Mario Jhunior Rojas Chanamoth', 'AAHH 19 DE MAYO MZ B LOTE 1', 'mario.rojas.chanamoth@gmail.com', '935852750', '', '', 1, '2025-01-06', '', '[{\"api\":\"no\",\"token\":\"\",\"secret\":\"\"}]', '', '2024-12-06', '2024-12-06 05:33:03'),
(5, 6, '20606455951', 'POLICLINICO MAYOLO S.A.C.', 'MZA. A LOTE. 06 URB.  VILLA UNIVERSITARIA  (CALLE 6)', 'demo@demo.com', '999999999', '', '', 1, '2025-02-06', '', '[{\"api\":\"no\",\"token\":\"\",\"secret\":\"\"}]', '', '2024-12-06', '2024-12-06 05:33:03'),
(6, 7, '20415932376', 'COCA-COLA SERVICIOS DE PERU S.A', 'AV. REPÚBLICA DE PANAMÁ NRO. 4050 URB.  LIMATAMBO  (LOS NEGOCIOS 490)', 'cocacola@demo.com', '888888888', '', '', 1, '2025-12-06', '', '[{\"api\":\"no\",\"token\":\"\",\"secret\":\"\"}]', '', '2024-12-06', '2024-12-06 05:34:03'),
(7, 7, '20505234970', 'PEPSI COLA PANAMERICANA S.R.L.', 'FRANCISCO BOLOGNESI NRO. 550 (A UNA CUADRA DEL OVALO SANTA ANITA)', 'pepsi@demo.com', '777777777', '', '', 1, '0000-00-00', '', '[{\"api\":\"no\",\"token\":\"\",\"secret\":\"\"}]', '', '2024-12-06', '2024-12-06 05:36:48');

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
(1, '[{\"id\":\"4\"},{\"id\":\"5\"},{\"id\":\"6\"},{\"id\":\"7\"}]', '[{\"id\":\"2\"},{\"id\":\"3\"},{\"id\":\"4\"},{\"id\":\"5\"}]', 1, 1, 'superadmin', '$2a$07$azybxcags23425sdg23sdeeKAqt96CqhlXh4xR.Kd9524vrpGvri6', 1, 1, '', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MzM0NjIyOTEsImV4cCI6MTczMzU0ODY5MSwiZGF0YSI6eyJpZCI6MSwiZW1haWwiOiJzdXBlcmFkbWluIn19.JRYtfc391TlzeZewqVUPxo9Cm8yRRfSICt72UaVHiaU', '1733548691', '2024-12-01', '2024-12-06 05:36:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `warehouses`
--

CREATE TABLE `warehouses` (
  `id_warehouse` int(11) NOT NULL,
  `id_tenant_warehouse` int(11) NOT NULL,
  `id_store_warehouse` int(11) NOT NULL,
  `name_warehouse` text NOT NULL,
  `address_warehouse` text NOT NULL,
  `status_warehouse` int(11) NOT NULL,
  `created_warehouse` date NOT NULL,
  `updated_warehouse` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `warehouses`
--

INSERT INTO `warehouses` (`id_warehouse`, `id_tenant_warehouse`, `id_store_warehouse`, `name_warehouse`, `address_warehouse`, `status_warehouse`, `created_warehouse`, `updated_warehouse`) VALUES
(2, 4, 2, 'Almacén Principal', 'AAHH 19 DE MAYO MZ B LOTE 1', 1, '2024-12-06', '2024-12-06 05:10:02'),
(3, 5, 3, 'Almacén Principal', 'MZA. A LOTE. 06 URB.  VILLA UNIVERSITARIA  (CALLE 6)', 1, '2024-12-06', '2024-12-06 05:16:21'),
(4, 6, 4, 'Almacén Principal', 'AV. REPÚBLICA DE PANAMÁ NRO. 4050 URB.  LIMATAMBO  (LOS NEGOCIOS 490)', 1, '2024-12-06', '2024-12-06 05:34:03'),
(5, 7, 5, 'Almacén Principal', 'FRANCISCO BOLOGNESI NRO. 550 (A UNA CUADRA DEL OVALO SANTA ANITA)', 1, '2024-12-06', '2024-12-06 05:36:48');

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
(1, 0, 0, 1, 1, 'Super Administrador', 'admin@admin.com', '935852750', '$2a$07$azybxcags23425sdg23sdehIC1Gf6HUGZDSXV0yFAHmTRH..YFKWK.png', 1, '[{\"birthday\":\"\",\"document\":\"\",\"type\":\"\",\"salary\":\"\",\"horary\":\"\",\"family\":\"\",\"sons\":\"\",\"address\":\"\",\"gender\":\"\",\"enter\":\"\",\"pension\":\"\",\"account\":\"\",\"signature\":\"\"}]', '2024-12-01', '2024-12-05 03:05:25');

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
-- Indices de la tabla `saleadmins`
--
ALTER TABLE `saleadmins`
  ADD PRIMARY KEY (`id_saleadmin`);

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
-- Indices de la tabla `suscriptions`
--
ALTER TABLE `suscriptions`
  ADD PRIMARY KEY (`id_suscription`);

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
-- Indices de la tabla `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id_warehouse`);

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
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT de la tabla `saleadmins`
--
ALTER TABLE `saleadmins`
  MODIFY `id_saleadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `stores`
--
ALTER TABLE `stores`
  MODIFY `id_store` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `suscriptions`
--
ALTER TABLE `suscriptions`
  MODIFY `id_suscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id_tenant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id_warehouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `workers`
--
ALTER TABLE `workers`
  MODIFY `id_worker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
