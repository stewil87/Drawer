<?php

class Drawer{

	protected $imageWidth;
	protected $imageHeight;
	protected $imageResource;

	public function __construct($width, $height){
		
		$this->imageWidth 		= $width;
		$this->imageHeight 		= $height;
		$this->imageResource 	= @imagecreatetruecolor($width, $height);

		// Allocate colors
		$pink = imagecolorallocate($canvas, 255, 105, 180);
		$white = imagecolorallocate($canvas, 255, 255, 255);
		$green = imagecolorallocate($canvas, 132, 135, 28);

		// Draw three rectangles each with its own color
		imagerectangle($canvas, 50, 50, 150, 150, $pink);
		imagerectangle($canvas, 45, 60, 120, 100, $white);
		imagerectangle($canvas, 100, 120, 75, 160, $green);

		// Output and free from memory
		header('Content-Type: image/jpeg');

		imagejpeg($canvas);
		imagedestroy($canvas);
	}

	public function drawFrame($color, $style="left"){
		switch($style){
			case "full":
				//vertical 0
				imageline ( $this->getImageResource(), 0, 0, 0, $this->getImageHeight(), $colorInt);
				//vertical 100
				imageline ( $this->getImageResource(), $this->getImageWidth(), 0, $this->getImageWidth(), $this->getImageHeight(), $colorInt);

				//horizontal 0
				imageline ( $this->getImageResource(), 0, 0, $this->getImageWidth(), 0, $colorInt);
				//horizontal 100
				imageline ( $this->getImageResource(), 0, $this->getImageHeight(), $this->getImageWidth(), $this->getImageHeight(), $colorInt);
			break;

			case "left":
				//vertical 0
				imageline ( $this->getImageResource(), 0, 0, 0, $this->getImageHeight(), $colorInt);
				//horizontal 100
				imageline ( $this->getImageResource(), 0, $this->getImageHeight(), $this->getImageWidth(), $this->getImageHeight(), $colorInt);
			break;

			case "right":
				//vertical 100
				imageline ( $this->getImageResource(), $this->getImageWidth(), 0, $this->getImageWidth(), $this->getImageHeight(), $colorInt);
				//horizontal 100
				imageline ( $this->getImageResource(), 0, $this->getImageHeight(), $this->getImageWidth(), $this->getImageHeight(), $colorInt);
			break;

			case "top":
				//horizontal 0
				imageline ( $this->getImageResource(), 0, 0, $this->getImageWidth(), 0, $colorInt);
			break;

			case "bottom":
				//horizontal 100
				imageline ( $this->getImageResource(), 0, $this->getImageHeight(), $this->getImageWidth(), $this->getImageHeight(), $colorInt);
			break;
		}
	}

	public function createRGBColor($hex){
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		return array($r, $g, $b);
	}

	public function createHexColor($rgb = array()){
		return sprintf("#%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2]);
	}

    /**
     * @return mixed
     */
    public function getImageWidth()
    {
        return $this->imageWidth;
    }

    /**
     * @param mixed $imageWidth
     *
     * @return self
     */
    public function setImageWidth($imageWidth)
    {
        $this->imageWidth = $imageWidth;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageHeight()
    {
        return $this->imageHeight;
    }

    /**
     * @param mixed $imageHeight
     *
     * @return self
     */
    public function setImageHeight($imageHeight)
    {
        $this->imageHeight = $imageHeight;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageResource()
    {
        return $this->imageResource;
    }

    /**
     * @param mixed $imageResource
     *
     * @return self
     */
    public function setImageResource($imageResource)
    {
        $this->imageResource = $imageResource;

        return $this;
    }
}


?>