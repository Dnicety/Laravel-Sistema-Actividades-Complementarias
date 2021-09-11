# Sistemas de actividades complementarias

Software de aplicación para la gestión de actividades complementarias.

### Pre-requisitos 🔧

------------

-  Composer
- NodeJS
- Base de datos MySQL


### Instalación 🔧
------------
Situarse en la raiz del proyecto y ejecutar en consola los comandos:

    Composer Install

	npm install


### Configuración ⚙️
------------
En el archivo .env

Configuración base de datos

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="DB_NAME"
DB_USERNAME=root
DB_PASSWORD=
```

Configuración mail
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME="EMAIL ADDRESS"
MAIL_PASSWORD=¨EMAIL PASSWORD¨
MAIL_ENCRYPTION=SSL
MAIL_FROM_ADDRESS="EMAIL ADDRESS"
MAIL_FROM_NAME="${APP_NAME}"
```

### Mas información 📖
https://drive.google.com/file/d/1wdLgqol_5nBkkzGQe6ftlKcq7nGA0W0k/view?usp=sharing

### Construido con 🛠️
--------------
[- Laravel 8](https://laravel.com/ "- Laravel 8")
[- Tailwind CSS](https://tailwindcss.com/ "- Tailwind CSS")
[- Laravel - Excel](https://laravel-excel.com/ "- Laravel - Excel")
