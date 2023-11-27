Nuestra página web está basada en gimnasios, principalmente en las rutinas de estos.

En el siguiente readme se explicarán los diferentes endpoints que nuestro TP presenta.

('rutinas','GET','RutinasController','obtenerRutinas');
En este endpoint, se utiliza un verbo GET, y se obtienen todas las rutinas.

('rutinas/:ID','GET','RutinasController','obtenerRutinaCliente');
Aquí, a diferencia del primero, que también es un get, en este endpoint se pide un parámetro 'ID', para obtener una rutia especifica según su 'ID'.

('rutinas','POST','RutinasController','agregarRutina');
Ahora tenemos un verbo POST, en este lo que se hace es cargar una nueva rutina a la página.

('rutinas/:ID','PUT','RutinasController','actualizarRutina');
Último endpoint, con verbo PUT, aquí se pueden editar rutinas previas.
