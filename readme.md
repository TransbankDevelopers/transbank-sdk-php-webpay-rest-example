Proyecto de ejemplo para uso de Onepay con el SDK de Transbank para PHP
--

El siguiente proyecto es una simulacion de un ecommerce el cual utiliza los distintos servicios de webpay rest a traves del SDK de Transbank para php


## Requerimientos
Para ejecutar el proyecto es necesario tener: 
 ```docker``` y ```docker-compose``` ([como instalar Docker](https://docs.docker.com/install/))

## Ejecutar ejemplo
Con el código fuente del proyecto en tu computador, puedes ejecutar en la raíz del proyecto el comando para construir el contenedor docker, si es la primera vez que ejecutas el proyecto:
```bash
docker-compose build
```
Luego, es necesario instalar las dependencias:
```bash
docker-compose run web composer install
```
Finalmente, para correr el proyecto de ejemplo:
```
docker-compose up
```
También puedes iniciar el proyecto simplemente ejecutando el archivo `run.sh` en la raíz del proyecto

En ambos casos el proyecto se ejecutará en http://localhost:8000 (y fallará en caso de que el puerto 8000 no esté disponible)

Es posible ver las operaciones del SDK implementadas en la clase TransactionController,
la cual esta en [Webpay.php](./app/Http/Controllers/Webpay.php)


TODO: mostrar capturas con ejemplos
