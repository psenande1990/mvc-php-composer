<h1>MVC-PHP-COMPOSER</h1>

<p>Estructura básica de un proyecto Modelo-Vista-Controlador en Php nativo</p>

<h3> - Características</h3
<ul>
    <li>Url's amigables</li>
    <li>Conexión a Base de datos</li>
    <li>Utiliza Composer para las depencias externas</li>
    <li>Estructura de vistas que permite Layouts independientes</li>
</ul>

<h3>Dockerfile y docker-compose</h3>
<p>El proyecto cuenta con un Dockerfile y un docker-compose para crear los contenedores tanto del webService como del servicio de base de datos con un Phpmyadmin para gestionarla</p>

<h3> - Instalación</h3>
<p>Modificar los datos de configuración en el archivo app/config.php y ejecutar composer dump-autolad</p>
<p>Si utilizas el Dockerfile y docker-compose, simplemente ejecutas un docker-compose up y ya tienes la infraestructura creada.</p>

<h3> - Plantilla web</h3>
<p>Para la prueba de vista se ha utilizado una template en Html5 con licencia MIT y de libre uso</p>
