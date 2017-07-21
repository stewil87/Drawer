<?php 

class PictureAnimal extends Drawer {

	public function __construct($width, $height) {
		try {
			parent::__construct($width, $height);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

	public function render(){
		$this->createColorPalette('HEX','grey', '#CCCCCC');

		//animal
		$this->createColorPalette('HEX','blue', '#99eadf');
		$this->createColorPalette('HEX','lightblue', '#c4fffb');
		$this->createColorPalette('HEX','brown', '#59433b');
		$this->createColorPalette('HEX','lightbrown', '#ab6d52');
		$this->createColorPalette('HEX','darkgrey', '#a49e96');

		//background
		$color = $this->getColorCollection();
		imagefill($this->getImageResource(), 0, 0, $color['blue']);
		$this->drawCircle(400, 400, 400, 80, 'lightblue', 0, '',0);

		//tail
		for ($i=0; $i <=200 ; $i++) { 
			$this->drawCircle(300 + $i, 330 + ($i*2), 80, 80, 'brown', 0, '',0);
		}
		//ears
		$this->drawCircle(335, 240, 40, 40, 'brown', 0, '',0);
		$this->drawCircle(465, 240, 40, 40, 'brown', 0, '',0);
		//body
		for ($i=0; $i <=200 ; $i++) { 
			$this->drawCircle(400, 300 + $i, 160, 160, 'lightbrown', 0, '',0);
		}
		//eyes
		$this->drawCircle(370, 290, 20, 20, 'black', 0, '',0);
		$this->drawCircle(430, 290, 20, 20, 'black', 0, '',0);
		//teeth
		$this->drawCircle(385, 360, 20, 70, 'white', 0, '',0);
		$this->drawCircle(415, 360, 20, 70, 'white', 0, '',0);
		imagefilledrectangle($this->getImageResource() , 350 , 385 , 430 , 420 , $color['lightbrown'] );
		//beard
		$this->drawCircle(380, 345, 55, 40, 'darkgrey', 0, '',0);
		$this->drawCircle(420, 345, 55, 40, 'darkgrey', 0, '',0);
		//nose
		$this->drawCircle(400, 330, 40, 30, 'black', 0, '',0);
		//background 2
		imagefilledrectangle($this->getImageResource() , 0 , 420, $this->getImageWidth() , $this->getImageHeight() , $color['blue'] );

		$this->renderImage();
		$this->destroy();
	}

}



?>