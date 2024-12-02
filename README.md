# ERP NUBILLIA - Sistema de Gestión Empresarial

Este proyecto es un sistema de gestión empresarial (ERP) diseñado bajo el modelo **SaaS (Software as a Service)**, desarrollado con **PHP 8** bajo el patrón **MVC**. El objetivo principal es ofrecer una solución escalable, robusta y segura para empresas de diferentes giros, permitiendo gestionar múltiples sucursales, almacenes, cajas y colaboradores de forma centralizada.

## Características principales
- **Multiempresa**: Permite registrar y gestionar múltiples empresas desde un solo panel de administración.
- **Gestión de usuarios y colaboradores**: Creación y asociación de colaboradores con usuarios, garantizando un acceso seguro y aislado según la empresa.
- **Sistema de autenticación**: Implementación de un sistema de autenticación robusto basado en JWT.
- **Planes de suscripción**: Registro de empresas y usuarios mediante un flujo automatizado de suscripciones (integración con plataformas como PayPal, Yape, Plin, etc.).
- **Diseño modular y extensible**: Estructura preparada para el crecimiento del sistema con un enfoque en buenas prácticas.

## Tecnologías utilizadas
- **Backend**: PHP 8.x
- **Frontend**: Patrón MVC.
- **Base de datos**: MySQL
- **Otros**: Integraciones para pagos y suscripciones.

Este sistema está diseñado para garantizar la seguridad y el aislamiento de datos de cada empresa, asegurando una experiencia intuitiva tanto para administradores como para colaboradores.

## Cambios al 29/11/24
1 Se crea archivos principales del proyecto  
2 Se corrige CORS para cualquier tecnolgía  
3 Se agrega la estructura base de la vista, se implemente la plantilla, la cabecera, el menú lateral y el footer  
4 Se configura las rutas amigables y el error 404

## Cambios al 30/11/24
1 Se configura la vista de login, si no hay sesión se redirige al login  
2 Se configura la vista de forgot con la url amigable  
3 Se configura el error 404 cuando no se tiene sesión

## Cambios al 01/12/24
1 Login funcional  
2 LockScreen funcional

## Cambios al 02/12/24
1 Se crea tabla de configuración y personalización del sistema