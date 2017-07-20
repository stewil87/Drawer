<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('class.drawer.php');

$painting = new Drawer(800, 600);

//$painting->drawFrame('black', $style='full', 100, 100, 100, 100);

$painting->createColorPalette('HEX','grey', '#CCCCCC');
//$painting->drawGutter('grey', 25, 25);
//$painting->drawCircle(400, 300, 100, 50, 'black', 10, 'green',0);

//animal
$painting->createColorPalette('HEX','blue', '#99eadf');
$painting->createColorPalette('HEX','lightblue', '#c4fffb');
$painting->createColorPalette('HEX','brown', '#59433b');
$painting->createColorPalette('HEX','lightbrown', '#ab6d52');
$painting->createColorPalette('HEX','darkgrey', '#a49e96');

//background
$color = $painting->getColorCollection();
imagefill($painting->getImageResource(), 0, 0, $color['blue']);
$painting->drawCircle(400, 400, 400, 80, 'lightblue', 0, '',0);

//tail
for ($i=0; $i <=200 ; $i++) { 
	$painting->drawCircle(300 + $i, 330 + ($i*2), 80, 80, 'brown', 0, '',0);
}
//ears
$painting->drawCircle(335, 240, 40, 40, 'brown', 0, '',0);
$painting->drawCircle(465, 240, 40, 40, 'brown', 0, '',0);
//body
for ($i=0; $i <=200 ; $i++) { 
	$painting->drawCircle(400, 300 + $i, 160, 160, 'lightbrown', 0, '',0);
}
//eyes
$painting->drawCircle(370, 290, 20, 20, 'black', 0, '',0);
$painting->drawCircle(430, 290, 20, 20, 'black', 0, '',0);
//teeth
$painting->drawCircle(385, 360, 20, 70, 'white', 0, '',0);
$painting->drawCircle(415, 360, 20, 70, 'white', 0, '',0);
imagefilledrectangle($painting->getImageResource() , 350 , 385 , 430 , 420 , $color['lightbrown'] );
//beard
$painting->drawCircle(380, 345, 55, 40, 'darkgrey', 0, '',0);
$painting->drawCircle(420, 345, 55, 40, 'darkgrey', 0, '',0);
//nose
$painting->drawCircle(400, 330, 40, 30, 'black', 0, '',0);
//background 2
imagefilledrectangle($painting->getImageResource() , 0 , 420, $painting->getImageWidth() , $painting->getImageHeight() , $color['blue'] );

//car brand || ugly
/*$painting->createColorPalette('HEX','green', '#06ff00');
$painting->createColorPalette('HEX','darkgreen', '#077c04');
$painting->createColorPalette('HEX','blue', '#0024ff');*/

/*$painting->drawCircle(400, 300, 300, 150, 'black', 10, 'green',1);
$painting->drawCircle(400, 260, 200, 75, 'black', 10, 'green',1);
$painting->drawCircle(400, 300, 100, 150, 'black', 10, 'green',1);*/

$painting->renderImage();
$painting->destroy();

?>