<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo">

        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <?php include "views/assets/img/svg/logo.svg"; ?>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2"><?php echo $getSetting->name_system_setting; ?></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>

    </div>

    <div class="menu-divider mt-0"></div>
    <div class="menu-inner-shadow"></div>

    <?php if(!empty($_SESSION["store"])): ?>
    <ul class="menu-inner py-1">

        <!-- Principal -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Principal">Principal</span>
        </li>

        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="/" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- TPV -->
        <li class="menu-item">
            <a href="/pos" class="menu-link">
                <i class='menu-icon tf-icons bx bx-laptop'></i>
                <div data-i18n="Punto de Venta">Punto de Venta</div>
            </a>
        </li>

        <!-- Calendario -->
        <li class="menu-item">
            <a href="/calendar" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Calendario">Calendario</div>
            </a>
        </li>

        <!-- Archivos -->
        <!--<li class="menu-item">
            <a href="/file-manager" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder-open"></i>
                <div data-i18n="Archivos">Archivos</div>
            </a>
        </li>-->

        <!-- Menú de navegación -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Menú de navegación">Menú de navegación</span>
        </li>

        <!-- Caja -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dollar"></i>
                <div data-i18n="Caja">Caja</div>
            </a>

            <ul class="menu-sub">

                <li class="menu-item">
                    <a href="/box" class="menu-link">
                        <div data-i18n="Administrar Caja">Administrar Caja</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/boxes" class="menu-link">
                        <div data-i18n="Histórico Caja">Histórico Caja</div>
                    </a>
                </li>
            </ul>

        </li>

        <!-- Personas -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-user'></i>
                <div data-i18n="Personas">Personas</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/clients"
                        class="menu-link">
                        <div data-i18n="Clientes">Clientes</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/suppliers"
                        class="menu-link">
                        <div data-i18n="Proveedores">Proveedores</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/collaborators"
                        class="menu-link">
                        <div data-i18n="Colaboradores">Colaboradores</div>
                    </a>
                </li>
            </ul>

        </li>

        <!-- Artículos -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-barcode'></i>
                <div data-i18n="Artículos">Artículos</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/brands"
                        class="menu-link">
                        <div data-i18n="Marcas">Marcas</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/categories"
                        class="menu-link">
                        <div data-i18n="Categorías">Categorías</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/products"
                        class="menu-link">
                        <div data-i18n="Productos">Productos</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/kardex"
                        class="menu-link">
                        <div data-i18n="kardex">kardex</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/transfers"
                        class="menu-link">
                        <div data-i18n="Traslados">Traslados</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/adjust-inventory"
                        class="menu-link">
                        <div data-i18n="Ajustar Inventario">Ajustar Inventario</div>
                    </a>
                </li>
            </ul>

        </li>

        <!-- Ventas -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-cart'></i>
                <div data-i18n="Ventas">Ventas</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/sales/add"
                        class="menu-link">
                        <div data-i18n="Nueva Venta">Nueva Venta</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/sales"
                        class="menu-link">
                        <div data-i18n="Histórico Ventas">Histórico Ventas</div>
                    </a>
                </li>
            </ul>

        </li>

        <!-- Cotizaciones -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-file'></i>
                <div data-i18n="Cotizaciones">Cotizaciones</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/quotes/add"
                        class="menu-link">
                        <div data-i18n="Nueva Cotización">Nueva Cotización</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/quotes"
                        class="menu-link">
                        <div data-i18n="Histórico Cotizaciones">Histórico Cotizaciones</div>
                    </a>
                </li>
            </ul>

        </li>

        <!-- Egresos -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-wallet'></i>
                <div data-i18n="Egresos">Egresos</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/purchases/add"
                        class="menu-link">
                        <div data-i18n="Nueva Compra">Nueva Compra</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/purchases"
                        class="menu-link">
                        <div data-i18n="Histórico Compras">Histórico Compras</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/spends"
                        class="menu-link">
                        <div data-i18n="Histórico Gastos">Histórico Gastos</div>
                    </a>
                </li>
            </ul>

        </li>

        <!-- Documentos Electrónicos -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-food-menu'></i>
                <div data-i18n="Doc. Electrónicos">Doc. Electrónicos</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Nota Débito">Nota Débito</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="/n-debits/add" class="menu-link">
                                <div data-i18n="Nueva Nota Débito">Nueva Nota Débito</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/n-debits" class="menu-link">
                                <div data-i18n="Histórico Notas">Histórico Notas</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Nota Crédito">Nota Crédito</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="/n-credits/add" class="menu-link">
                                <div data-i18n="Nueva Nota Crédito">Nueva Nota Crédito</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/n-credits" class="menu-link">
                                <div data-i18n="Histórico Notas">Histórico Notas</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Guía Remisión">Guía Remisión</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="/remitent-public" class="menu-link">
                                <div data-i18n="Remitente T. Público">Remitente T. Público</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/remitent-private" class="menu-link">
                                <div data-i18n="Remitente T. Privado">Remitente T. Privado</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/transportist" class="menu-link">
                                <div data-i18n="Transportista">Transportista</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="/summary" class="menu-link">
                        <div data-i18n="Resumen Diario">Resumen Diario</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/anulate" class="menu-link">
                        <div data-i18n="Comunicación Baja">Comunicación Baja</div>
                    </a>
                </li>
            </ul>

        </li>

        <!-- Contabilidad -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bxs-bank'></i>
                <div data-i18n="Contabilidad">Contabilidad</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Libros Electrónicos">Libros Electrónicos</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="/purchases/register" class="menu-link">
                                <div data-i18n="Registro Compras">Registro Compras</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/sales/register" class="menu-link">
                                <div data-i18n="Registro Ventas">Registro Ventas</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="/banks" class="menu-link">
                        <div data-i18n="Bancos">Bancos</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/banks/accounts" class="menu-link">
                        <div data-i18n="Cuentas Bancarias">Cuentas Bancarias</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/payments" class="menu-link">
                        <div data-i18n="Medio Pagos">Medio Pagos</div>
                    </a>
                </li>
            </ul>
            
        </li>

        <!-- Créditos -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-credit-card'></i>
                <div data-i18n="Créditos">Créditos</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/credits/to-pay" class="menu-link">
                        <div data-i18n="Por Pagar">Por Pagar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/credits/receivable" class="menu-link">
                        <div data-i18n="Por Cobrar">Por Cobrar</div>
                    </a>
                </li>
            </ul>

        </li>

        <!-- RRHH -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-sitemap'></i>
                <div data-i18n="Recursos Humanos">Recursos Humanos</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-logistics-dashboard.html" class="menu-link">
                        <div data-i18n="Variables Laborales">Variables Laborales</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-logistics-fleet.html" class="menu-link">
                        <div data-i18n="Histórico Asistencia">Histórico Asistencia</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-logistics-fleet.html" class="menu-link">
                        <div data-i18n="Cargos">Cargos</div>
                    </a>
                </li>
            </ul>

        </li>

        <!-- Configuraciones -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Configuraciones">Configuraciones</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/company" class="menu-link">
                        <div data-i18n="Empresa">Empresa</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/stores" class="menu-link">
                        <div data-i18n="Tiendas">Tiendas</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/warehouses" class="menu-link">
                        <div data-i18n="Almacenes">Almacenes</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/sales/series" class="menu-link">
                        <div data-i18n="Series & Correlativos">Series & Correlativos</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/users" class="menu-link">
                        <div data-i18n="Cuentas Usuarios">Cuentas Usuarios</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/users/rols" class="menu-link">
                        <div data-i18n="Roles Usuarios">Roles Usuarios</div>
                    </a>
                </li>
            </ul>

        </li>

        <!-- Reportes -->
        <li class="menu-item">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-line-chart'></i>
                <div data-i18n="Reportes">Reportes</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Ventas">Ventas</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="/report/sales-user" class="menu-link">
                                <div data-i18n="Ventas Usuario">Ventas Usuario</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/report/sales-client" class="menu-link">
                                <div data-i18n="Ventas Cliente">Ventas Cliente</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/report/sales-resumen" class="menu-link">
                                <div data-i18n="Resumen">Resumen</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Compras">Compras</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="/report/purchases-user" class="menu-link">
                                <div data-i18n="Compras Usuario">Compras Usuario</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/report/purchases-supplier" class="menu-link">
                                <div data-i18n="Compras Proveedor">Compras Proveedor</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/report/purchases-resumen" class="menu-link">
                                <div data-i18n="Resumen">Resumen</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="/spends/report" class="menu-link">
                        <div data-i18n="Gastos">Gastos</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/banks/accounts" class="menu-link">
                        <div data-i18n="Consolidado">Consolidado</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/payments" class="menu-link">
                        <div data-i18n="Balance Productos">Balance Productos</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/payments" class="menu-link">
                        <div data-i18n="Unidad Productos">Unidad Productos</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/payments" class="menu-link">
                        <div data-i18n="Ingresos VS Egresos">Ingresos VS Egresos</div>
                    </a>
                </li>
            </ul>
            
        </li>

        <!-- Soporte -->
        <?php if($getSetting->whatsapp_setting != '' || $getSetting->youtube_setting != ''): ?>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Soporte">Soporte</span>
        </li>
        <?php endif; ?>

        <?php if($getSetting->whatsapp_setting != ''): ?>
        <li class="menu-item">
            <a href="<?php echo $getSetting->whatsapp_setting; ?>" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bxl-whatsapp"></i>
                <div data-i18n="WhatsApp">WhatsApp</div>
            </a>
        </li>
        <?php endif; ?>

        <?php if($getSetting->youtube_setting != ''): ?>
        <li class="menu-item">
            <a href="<?php echo $getSetting->youtube_setting; ?>" target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bxl-youtube"></i>
                <div data-i18n="Tutoriales">Tutoriales</div>
            </a>
        </li>
        <?php endif; ?>
        
    </ul>
    <?php elseif(!empty($_SESSION["admin"])): ?>
    <ul class="menu-inner py-1">

        <!-- Principal -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Principal">Principal</span>
        </li>

        <!-- Dashboard -->
        <li class="menu-item <?php if (empty($routesArray)): ?>active<?php endif?>">
            <a href="/" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Calendario -->
        <li class="menu-item <?php if (!empty($routesArray) && $routesArray[1] == 'calendar'): ?>active<?php endif?>">
            <a href="/calendar" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Calendario">Calendario</div>
            </a>
        </li>

        <!-- Menú de navegación -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Menú de navegación">Menú de navegación</span>
        </li>

        <!-- Planes -->
        <li class="menu-item <?php if (!empty($routesArray) && $routesArray[1] == 'plans'): ?>active<?php endif?>">
            <a href="/plans" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div data-i18n="Planes">Planes</div>
            </a>
        </li>

        <!-- Empresas -->
        <li class="menu-item <?php if (!empty($routesArray) && $routesArray[1] == 'tenants'): ?>active<?php endif?>">
            <a href="/tenants" class="menu-link">
                <i class="menu-icon tf-icons bx bx-building-house"></i>
                <div data-i18n="Empresas">Empresas</div>
            </a>
        </li>

        <!-- Ventas -->
        <li class="menu-item <?php if (!empty($routesArray) && $routesArray[1] == 'sales'): ?>active<?php endif?>">
            <a href="/sales" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div data-i18n="Ventas">Ventas</div>
            </a>
        </li>

        <!-- Usuarios -->
        <li class="menu-item <?php if (!empty($routesArray) && $routesArray[1] == 'users'): ?>active<?php endif?>">
            <a href="/users" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Usuarios">Usuarios</div>
            </a>
        </li>

        <!-- Configuraciones -->
        <li class="menu-item <?php if (!empty($routesArray) && $routesArray[1] == 'settings'): ?>active<?php endif?>">
            <a href="/settings" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Configuraciones">Configuraciones</div>
            </a>
        </li>
        
    </ul>
    <?php endif; ?>

</aside>