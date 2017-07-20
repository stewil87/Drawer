<?php

class Drawer{

	protected $imageWidth;
	protected $imageHeight;
	protected $imageResource;
	protected $colorCollection = array();

	protected $gapfromLeft;
	protected $gapfromRight;
	protected $gapfromTop;
	protected $gapfromBottom;

	public function __construct($width, $height){
		
		$this->imageWidth 					= $width;
		$this->imageHeight 					= $height;
		$this->imageResource 				= @imagecreatetruecolor($width, $height);
		$this->colorCollection['white'] 	= imagecolorallocate($this->imageResource,255,255,255);
		$this->colorCollection['black'] 	= imagecolorallocate($this->imageResource,0,0,0);

		imagefill($this->imageResource, 0, 0, $this->colorCollection['white']);
	}

	public function createColorPalette($typeColor="RGB", $colorName, $colorValue){
		switch($typeColor){
			case "RGB":
			$colors = explode($colorValue);
			break;

			case "HEX":
			$colors = $this->createRGBColor($colorValue);
			break;
		}

		$this->colorCollection[$colorName] = imagecolorallocate($this->getImageResource(), $colors[0], $colors[1], $colors[2]);
	}

	public function renderImage(){
		header('Content-Type: image/jpeg');
		imagejpeg($this->imageResource);
	}

	public function destroy(){
		imagedestroy($this->getImageResource());
	}

	public function drawGutter($color, $spaceX, $spaceY){
		$colorArray = $this->getColorCollection();

		$numVerticalLines = ($this->getImageWidth() - (($this->getGapfromLeft() + $this->getGapfromRight())+2)) / $spaceX;
		$numHorizontalLines = ($this->getImageHeight() - (($this->getGapfromTop() + $this->getGapfromBottom())+2)) / $spaceY;
		$PositionX = 0;
		$PositionY = 0;

		for($x=1; $x<=$numVerticalLines; $x++){

			$PositionX = $x * $spaceX + 1;

			imageline ( $this->getImageResource(), $PositionX + $this->getGapfromLeft(), 0 + $this->getGapfromBottom(), $PositionX + $this->getGapfromLeft(), $this->getImageHeight() - $this->getGapfromTop(), $colorArray[$color]);
		}

		for($y=1; $y<=$numHorizontalLines; $y++){

			$PositionY = $y * $spaceY + 1;

			imageline ( $this->getImageResource(), 0 + $this->getGapfromLeft(), $PositionY + $this->getGapfromBottom(), $this->getImageWidth() - $this->getGapfromRight(), $PositionY + $this->getGapfromBottom()  ,$colorArray[$color]);
		}
	}

	public function drawFrame($color, $style="left", $gapfromLeft=0, $gapfromRight=0, $gapfromTop=0, $gapfromBottom=0){ 

		$this->setGapfromLeft($gapfromLeft);
		$this->setGapfromRight($gapfromRight);
		$this->setGapfromTop($gapfromTop);
		$this->setGapfromBottom($gapfromBottom);

		$colorArray = $this->getColorCollection();

		switch($style){
			case "full":
				//vertical 0
				imageline ( $this->getImageResource(), 0 + $this->getGapfromLeft(), 0 + $this->getGapfromTop(), 0 + $this->getGapfromLeft(), $this->getImageHeight() - $this->getGapfromBottom(), $colorArray[$color]);
				//vertical 100
				imageline ( $this->getImageResource(), $this->getImageWidth() - $this->getGapfromRight(), 0 + $this->getGapfromTop(), $this->getImageWidth() - $this->getGapfromRight(), $this->getImageHeight() - $this->getGapfromBottom(), $colorArray[$color]);

				//horizontal 0
				imageline ( $this->getImageResource(), 0 + $this->getGapfromLeft() , 0 + $this->getGapfromTop(), $this->getImageWidth() - $this->getGapfromRight(), 0 + $this->getGapfromTop(), $colorArray[$color]);
				//horizontal 100
				imageline ( $this->getImageResource(), 0 + $this->getGapfromLeft(), $this->getImageHeight() - $this->getGapfromBottom(), $this->getImageWidth() - $this->getGapfromRight(), $this->getImageHeight() - $this->getGapfromBottom(), $colorArray[$color]);
			break;

			case "left":
				//vertical 0
				imageline ( $this->getImageResource(), 0 + $this->getGapfromLeft(), 0 + $this->getGapfromTop(), 0 + $this->getGapfromLeft(), $this->getImageHeight() - $this->getGapfromBottom(), $colorArray[$color]);
				//horizontal 100
				imageline ( $this->getImageResource(), 0 + $this->getGapfromLeft(), $this->getImageHeight() - $this->getGapfromBottom(), $this->getImageWidth() - $this->getGapfromRight(), $this->getImageHeight() - $this->getGapfromBottom(), $colorArray[$color]);
			break;

			case "right":
				//vertical 100
				imageline ( $this->getImageResource(), $this->getImageWidth() - $this->getGapfromRight(), 0 + $this->getGapfromTop(), $this->getImageWidth() - $this->getGapfromRight(), $this->getImageHeight() - $this->getGapfromBottom(), $colorArray[$color]);
				//horizontal 100
				imageline ( $this->getImageResource(), 0 + $this->getGapfromLeft(), $this->getImageHeight() - $this->getGapfromBottom(), $this->getImageWidth() - $this->getGapfromRight(), $this->getImageHeight() - $this->getGapfromBottom(), $colorArray[$color]);
			break;

			case "top":
				//horizontal 0
				imageline ( $this->getImageResource(), 0 + $this->getGapfromLeft() , 0 + $this->getGapfromTop(), $this->getImageWidth() - $this->getGapfromRight(), 0 + $this->getGapfromTop(), $colorArray[$color]);
			break;

			case "bottom":
				//horizontal 100
				imageline ( $this->getImageResource(), 0 + $this->getGapfromLeft(), $this->getImageHeight() - $this->getGapfromBottom(), $this->getImageWidth() - $this->getGapfromRight(), $this->getImageHeight() - $this->getGapfromBottom(), $colorArray[$color]);
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


	public function drawCircle($centerX, $centerY, $sizeX, $sizeY, $color, $border=0, $borderColor, $transparent=0) {

		$colorArray = $this->getColorCollection();

		if($transparent==0){
			if($border!=0){
				imagefilledellipse($this->getImageResource(), $centerX, $centerY, $sizeX, $sizeY, $colorArray[$borderColor]);	
			}
			imagefilledellipse($this->getImageResource(), $centerX, $centerY, $sizeX - $border, $sizeY - $border, $colorArray[$color]);
		} else{
			for($x=0; $x<=$border; $x++){
				imageellipse($this->getImageResource(), $centerX, $centerY, $sizeX -$x, $sizeY -$x, $colorArray[$borderColor]);
			}
		}
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

    /**
     * @return mixed
     */
    public function getColorCollection()
    {
        return $this->colorCollection;
    }

    /**
     * @param mixed $colorCollection
     *
     * @return self
     */
    public function setColorCollection($colorCollection)
    {
        $this->colorCollection[] = $colorCollection;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageWidthGap()
    {
        return $this->imageWidthGap;
    }

    /**
     * @param mixed $imageWidthGap
     *
     * @return self
     */
    public function setImageWidthGap($imageWidthGap)
    {
        $this->imageWidthGap = $imageWidthGap;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGapfromLeft()
    {
        return $this->gapfromLeft;
    }

    /**
     * @param mixed $gapfromLeft
     *
     * @return self
     */
    public function setGapfromLeft($gapfromLeft)
    {
        $this->gapfromLeft = $gapfromLeft;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGapfromRight()
    {
        return $this->gapfromRight;
    }

    /**
     * @param mixed $gapfromRight
     *
     * @return self
     */
    public function setGapfromRight($gapfromRight)
    {
        $this->gapfromRight = $gapfromRight;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGapfromTop()
    {
        return $this->gapfromTop;
    }

    /**
     * @param mixed $gapfromTop
     *
     * @return self
     */
    public function setGapfromTop($gapfromTop)
    {
        $this->gapfromTop = $gapfromTop;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGapfromBottom()
    {
        return $this->gapfromBottom;
    }

    /**
     * @param mixed $gapfromBottom
     *
     * @return self
     */
    public function setGapfromBottom($gapfromBottom)
    {
        $this->gapfromBottom = $gapfromBottom;

        return $this;
    }
}


?>