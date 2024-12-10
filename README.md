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

## Avances al 29/11/24
1 Se crea archivos principales del proyecto  
2 Se corrige CORS para cualquier tecnolgía  
3 Se agrega la estructura base de la vista, se implemente la plantilla, la cabecera, el menú lateral y el footer  
4 Se configura las rutas amigables y el error 404

## Avances al 30/11/24
1 Se configura la vista de login, si no hay sesión se redirige al login  
2 Se configura la vista de forgot con la url amigable  
3 Se configura el error 404 cuando no se tiene sesión

## Avances al 01/12/24
1 Login funcional  
2 LockScreen funcional

## Avances al 02/12/24
1 Se crea tabla de configuración y personalización del sistema  
2 Se configura las sesiones para el acceso al panel de la empresa con la tienda seleccionada, de momento solo el super administrador podrá tener acceso a todas las empresas y tiendas  
3 Se configura las sesiones para el acceso al panel de la empresa con la tienda seleccionada, se lista las tiendas que el usuario tiene registradas  
4 Se separa de manera dinámica las sesiones al panel del super admin  
5 CRUD planes  
6 Listado de empresas

## Avances al 03/12/24
1 Configuraciones generales funcional  

## Avances al 04/12/24
1 Servidor de correo funcional  
2 Se exporta la base de datos y el json para el postman  
3 Se crea el controlador files.controller.php para manejar la carga, eliminación y creación dinámica del avatar y archivos  
4 Se crear un archivo dinámico dentro de "uploads" para que con el endpoint {{endpoint}}/uploads/index.php se pueda manejar dinámicamente los archivos  
5 Formulario para la carga de favicon

## Avances al 05/12/24
1 Se configura la facturación con el API de facturación  
2 Se configura los medios de pago "Paypal" para los planes y suscripciones  
3 Perfil de empresa desde el panel admin  
4 Se agrega que incluye cada plan como usuarios, tiendas y almacenes  
5 Se mejora la interacción con las respuestas utilizando matpreload y sweetalert  
6 Se crea una función para crear el logo inicial de la empresa con el RUC  
7 Se modifica las tablas para tener varias tablas sin reportes, esto para el perfil de la empresa donde se lita las tiendas y almacenes

## Avances al 06/12/24
1 Formulario de registro de empresa funcional desde el panel admin, al registrar una empresa se crea de manera automatica la tienda y almacén principal, modificando la próxima fecha de facturación según el plan y periodo seleccionado, el id de la empresa y tienda se asigna al usuario  
2 Se corrige la relación de tablas para independizar cada registro que se tiene según la empresa

## Avances al 09/12/24
1 Formulario para editar empresa desde el panel admin  
2 Se agrega los días faltantes para expirar el plan dentro del perfil de la empresa en el panel admin  
3 Se visualiza las ventas realizadas en el panel admin  
4 Listado de usuarios desde el panel admin

## Avances al 10/12/24
1 Registro de usuarios desde el front