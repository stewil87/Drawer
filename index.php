<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('class.drawer.php');
require_once('class.PictureAnimal.php');

//$painting = new Drawer(800, 600);

//Animal
$painting = new PictureAnimal(800, 600);
$painting->render();

//$painting->drawFrame('black', $style='full', 100, 100, 100, 100);

//$painting->renderImage();
//$painting->destroy();

?>