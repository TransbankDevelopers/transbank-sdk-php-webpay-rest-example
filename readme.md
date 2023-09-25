Proyecto de ejemplo de uso del SDK de Transbank para PHP
--

El siguiente proyecto es una simulacion de un ecommerce el cual utiliza los distintos servicios de webpay rest a traves del SDK de Transbank para php


## Requerimientos
Para ejecutar el proyecto es necesario tener: 
 ```docker``` y ```docker-compose``` ([como instalar Docker](https://docs.docker.com/install/))

## Ejecutar ejemplo
Para iniciar el proyecto, se usa `docker` y `docker-compose`. Puedes utilizar los siguientes comandos:

### Iniciar proyecto
Este comando construirá el contenedor la primera vez que se ejecute, además de iniciar el proyecto.
```bash
docker-compose up
```
Esto levantará el servidor de prueba en [http://localhost:8000](http://localhost:8000) (y fallará en caso de que el puerto 8000 no esté disponible)
### Detener proyecto
```bash
docker-compose down
```

### Otros comandos

#### Detener y eliminar las imágenes
```bash
docker-compose down -v --rmi all --remove-orphans
```




Es posible ver las operaciones del SDK implementadas en los controladores ubicados en `app/Http/Controllers/`. 

