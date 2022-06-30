# Proyecto Saar
Proyecto laravel para el aeropuerto manuel piar puerto ordaz

## Informacion / datos


1. **Conexion SSH**
	- Usuario: root
	- Host: 172.16.2.108
	- Pass: Centos2015
	- ruta de proyecto : cd /var/www/html/saar

	### Como conectarse

   1. Ejecutar `ssh root@172.16.2.108`
   2. Insertar clave 
---

2. **BDD mysql (server) :**

- User: vmpradob
- Pass: 24559444

	### Como conectarse
	
	1. Entrar por SSH 
	2. Ir a la ruta `cd /var/www/html` 
	3. Ejecutar `mysql -uvmpradob -p ` e ingresar el password

---

### Exportar Base de datos (Realizar respaldo)

1. Conectarse por SSH
2. Entrar a la ruta `cd /var/www/html`
3.  `mysqldump -u vmpradob -p saar > nombre_del_exportado.sql`
4. Salir de SSH (`$ exit`)
5. Copiar con scp el archivo a local, desde el pc 
`scp root@172.16.2.108:/var/www/html/nombre_del_exportado.sql Descargas`
Ingresar la password del user , en este caso Centos2015


### Importar base de datos (Ingresar la base de datos al local)
1. Realizar el backup del server 
2. Mover el backup al proyecto, y abrir una terminal dentro del proyecto
3. copiar el archivo sql al contenedor `sudo docker cp nombre_del_exportado.sql mysql-5.6:/` 
4. Entrar a la consola del contenedor docker `sudo docker exec -it mysql-5.6 /bin/bash`
5. Drop a bdd saar (con cuidado si es en local o server ), crear base de datos (todo por dbveaver)
6. Ejecutar comando de importacion `mysql -uroot -p saar < nombre_del_exportado.sql` (para alfonzzoj la la pw root es root)


## Comandos necesarios para ejecutar el proyecto en linux:

1. Detener y desabilitar mysql local 
	`sudo systemctl stop mysql`
	`sudo systemctl disable mysql`
2. Encender mysql docker
	    `sudo docker start mysql-5.6`

3. `sudo php artisan serve`

## Errores comunes:

- ssh: connect to host 172.16.2.108 port 22: Connection refused
		No tiene coneccion ethernet
