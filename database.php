<?php

// Información de la base de datos
// Ponemos variables de entorno de Heroku por si estamos desplegando allí.
// En caso contrario se cargarán los valores por defecto de una instalación local de XAMPP
// (usuario: 'root' ; password: '' )
// con base de datos llamada 'biblioteca'

// Comprobamos si estamos en Heroku con ClearDB buscando una variable de entorno definida sólo allí

//$os = getenv('CLEARDB_DATABASE_URL');
$os = getenv('MYSQLCONNSTR_localdb');
if ($os) {
	$url = parse_url($os);
}
$settings = array(
    'driver' => 'mysql',
    'host' => $os ? $url["host"] : 'localhost',
    'port' => $os ? 50654 : 3306,
    'database' => $os ? 'localdb' : 'biblioteca',
    'username' => $os ? 'azure' : 'root',
    'password' => $os ? '6#vWHD_$' : '',
    'charset'   => 'utf8',
    'collation' => 'utf8_spanish_ci',
    'prefix' => ''
);
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection($settings);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

?>
