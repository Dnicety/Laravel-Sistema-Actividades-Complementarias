# Sistemas de actividades complementarias

Software de aplicaci贸n para la gesti贸n de actividades complementarias.

### Pre-requisitos 馃敡

------------

-  Composer
- NodeJS
- Base de datos MySQL


### Instalaci贸n 馃敡
------------
Situarse en la raiz del proyecto y ejecutar en consola los comandos:

    Composer Install

	npm install


### Configuraci贸n 鈿欙笍
------------
En el archivo .env

Configuraci贸n base de datos

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="DB_NAME"
DB_USERNAME=root
DB_PASSWORD=
```

Configuraci贸n mail
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME="EMAIL ADDRESS"
MAIL_PASSWORD=篓EMAIL PASSWORD篓
MAIL_ENCRYPTION=SSL
MAIL_FROM_ADDRESS="EMAIL ADDRESS"
MAIL_FROM_NAME="${APP_NAME}"
```

### Mas informaci贸n 馃摉
https://drive.google.com/file/d/1wdLgqol_5nBkkzGQe6ftlKcq7nGA0W0k/view?usp=sharing

### Construido con 馃洜锔?
--------------
[- Laravel 8](https://laravel.com/ "- Laravel 8")
[- Tailwind CSS](https://tailwindcss.com/ "- Tailwind CSS")
[- Laravel - Excel](https://laravel-excel.com/ "- Laravel - Excel")
