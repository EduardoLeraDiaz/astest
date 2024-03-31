Hola,
el api utilizada para la prueba es la siguiente: https://boardgamegeek.com/xmlapi
solamente  he imitado una llamada que es para conseguir los datos de un juego de mesa a través de su id.
El api solamente da respuestas xml, yo he hecho una pequeña transformación para conseguir algunos datos en un json.

Para usar este repo deberia de bastar con:
     - composer install
     - symfony start:server

las dependencias son php8.2 con los paquetes que especifica el composer(posiblemente alguno mas)

En cuanto a la gestión de errores puedes verla en la clase
    App\Application\Common\ExceptionListener\HTTPExceptionListener

Ahí convertimos en un 404 vacío todos los fallos de not found y en un 500 con la excepción en json en el entorno dev,
pero vacio en cualquier otro entorno. 

La forma de las carpetas es siguiendo una filosofia DDD. 


