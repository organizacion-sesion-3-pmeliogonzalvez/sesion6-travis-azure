<?php

// Modelo de objetos que se corresponde con la tabla de MySQL
class Series extends \Illuminate\Database\Eloquent\Model
{
	public $timestamps = false;
}

// Añadir el resto del código aquí
$app->get('/series', function ($req, $res, $args) {

    // Creamos un objeto collection + json con la lista de películas

    // Obtenemos la lista de películas de la base de datos y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $series = json_decode(\Series::all());

    // Mostramos la vista
    return $this->view->render($res, 'serieslist_template.php', [
        'items' => $series
    ]);
})->setName('series');


/*  Obtención de un videojuego en concreto  */
$app->get('/series/{name}', function ($req, $res, $args) {

    // Creamos un objeto collection + json con el videojuego pasada como parámetro

    // Obtenemos el videojuego de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $p = \Series::find($args['name']);  
    $juego = json_decode($p);

    // Mostramos la vista
    return $this->view->render($res, 'series_template.php', [
        'item' => $juego
    ]);

});

/*  Eliminacion de un videojuego en concreto  */
$app->delete('/series/{name}', function ($req, $res, $args) {
	
    // Obtenemos el videojuego de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
    $p = \Series::find($args['name']); 
    $p->delete();

});

/*Crea un nuevo videojuego con los datos recibidos*/
$app->post('/series', function ($req, $res, $args) {
    //Código para peticiones de POST (creación de items)
    $template = $req->getParsedBody();
    $datos = $template['template']['data'];  

    $longitud = count($datos);
    for($i=0; $i<$longitud; $i++)
    {
        switch ($datos[$i]['name']){
        case "name":
            $name = $datos[$i]['value'];
            break;
        case "description":
            $desc = $datos[$i]['value'];
            break;
        case "temporadas":
            $temporadas = $datos[$i]['value'];
            break;
        case "datePublished":
            $date = $datos[$i]['value'];
            break;
        case "embedUrl":
            $embedUrl = $datos[$i]['value'];
            break;		
        }    
    }
  
    $serie = new Serie;
    $serie->name = $name;
    $serie->description = $desc;
    $serie->temporadas =  $temporadas;
    $serie->datePublished = $date;
    $serie->embedUrl = $embedUrl;
  
    $serie->save();
});


//Actualizar videojuego

$app->put('/series/{name}', function ($req, $res, $args) {

	// Creamos un objeto collection + json con el libro pasado como parámetro

	// Obtenemos el libro de la base de datos a partir de su id y la convertimos del formato Json (el devuelto por Eloquent) a un array PHP
	$nueva_serie = \Series::find($args['name']);	

    $template = $req->getParsedBody();

	$datos = $template['template']['data'];
  	foreach ($datos as $item)
  	{ 
		switch($item['name'])
		{
        case "name":
            $name = $item['value'];
            break;
        case "description":
            $description = $item['value'];
            break;
       

        case "temporadas":
            $temporadas = $item['value'];
            break;
				
        case "embedUrl":
            $embedUrl = $item['value'];
            break;
        case "datePublished":
            $datePublished = $item['value'];
            break;
		}
	}

	$nueva_serie['name'] = $name;
	$nueva_serie['description'] = $description;
	
	$nueva_serie['temporadas'] = $temporadas;
	$nueva_serie['embedUrl'] = $embedUrl;
	$nueva_serie['datePublished'] = $datePublished;
	$nueva_serie->save();

});


?>
