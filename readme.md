Proyecto de ejemplo para uso de Onepay con el SDK de Transbank para PHP
--

El siguiente proyecto es una simulacion de un ecommerce el cual utiliza los distintos servicios de webpay rest a traves del SDK de Transbank para php


## Requerimientos
Para ejecutar el proyecto es necesario tener: 
 ```docker``` y ```docker-compose``` ([como instalar Docker](https://docs.docker.com/install/))

## Ejecutar ejemplo
Para iniciar el proyecto, se usa `docker` y `docker-compose`. Para simplificar el proceso se crearon algunos scripts. 

### Iniciar proyecto
Estos comandos construirán el contenedor la primera vez que se ejecute, además de iniciar el proyecto.
```bash
./update
./start
```

### Detener proyecto
```bash
./stop
```

### Otros comandos

#### Detener y eliminar las imágenes
```bash
./purge
```

#### Entrar a la máquina 
```bash
./shell
```

#### Instalar dependencias de composer
```bash
./update
```


Esto levantará el servidor de prueba en [http://localhost:8000](http://localhost:8000) (y fallará en caso de que el puerto 8000 no esté disponible)

Es posible ver las operaciones del SDK implementadas en la clase los controladores ubicados en `app/Http/Controllers/`. 

