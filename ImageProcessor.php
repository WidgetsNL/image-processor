<?php

namespace WidgetsNL\ImageProcessor;

class ImageProcessor {

    const OBJECT_FIT_STRETCH = 1;
    const OBJECT_FIT_CONTAIN = 2;
    const OBJECT_FIT_COVER = 3;

    const CANVAS_FIT_KEEP = 1;
    const CANVAS_FIT_CROP = 2;

    const TYPE_JPEG = 'image/jpeg';
    const TYPE_PNG = 'image/png';
    const TYPE_GIF = 'image/gif';

    const QUALITY_LOW = 25;
    const QUALITY_MEDIUM = 50;
    const QUALITY_HIGH = 75;
    const QUALITY_MAXIMUM = 100;

    const BACKGROUND_TRANSPARENT = 'TRANSPARENT';
    const BACKGROUND_WHITE = '#FFFFFF';
    const BACKGROUND_BLACK = '#000000';

    const DATA_ENCODING_RAW = 1;
    const DATA_ENCODING_BASE64 = 2;
    const DATA_ENCODING_BASE64_DATA_URI = 3;

    /**
     * @var ImageResource
     */
    private $source;

    /**
     * @var ImageResource
     */
    private $target;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $objectFit = self::OBJECT_FIT_CONTAIN;

    /**
     * @var int
     */
    private $canvasFit = self::CANVAS_FIT_CROP;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $quality = self::QUALITY_HIGH;

    /**
     * @var string
     */
    private $background;

    /**
     * @param string $pathOrFileData
     */
    function __construct(string $pathOrFileData = '')
    {
        if ( $pathOrFileData ) {
            if ( is_file($pathOrFileData) ) {
                $this->setResourceFromPath($pathOrFileData);
            } else {
                $this->setResourceFromFileData($pathOrFileData);
            }
        }
        $this->target = new ImageResource();
    }

    /**
     * @param string $path
     * @return $this
     * @throws \Exception
     */
    public function setResourceFromPath(string $path)
    {
        if ( !file_exists($path) ) {
            throw new \Exception('File not found.');
        }
        if ( !is_readable($path) ) {
            throw new \Exception('File not readable.');
        }

        // Guess output type
        $info = pathinfo($path);
        if ( isset($info['extension']) ) {
            switch ( strtolower($info['extension']) ) {
                case 'gif':
                    if ( !$this->type ) $this->setType(self::TYPE_GIF);
                    if ( !$this->background ) $this->setBackground(self::BACKGROUND_TRANSPARENT);
                    break;

                case 'png':
                    if ( !$this->type ) $this->setType(self::TYPE_PNG);
                    if ( !$this->background ) $this->setBackground(self::BACKGROUND_TRANSPARENT);
                    break;

                default:
                    if ( !$this->type ) $this->setType(self::TYPE_JPEG);
            }
        }
        $this->setResourceFromFileData(file_get_contents($path));
        return $this;
    }

    /**
     * @param string $fileData
     * @return $this
     */
    public function setResourceFromFileData(string $fileData)
    {
        $source = new ImageResource();
        $source->setResource(imagecreatefromstring($fileData));
        $this->setSource($source);
        return $this;
    }

    /**
     * @return int
     */
    public function getObjectFit()
    {
        return $this->objectFit;
    }

    /**
     * @param int $objectFit
     * @return ImageProcessor
     */
    public function setObjectFit(int $objectFit = self::OBJECT_FIT_CONTAIN)
    {
        $this->objectFit = $objectFit;
        return $this;
    }

    /**
     * @return int
     */
    public function getCanvasFit(): int
    {
        return $this->canvasFit;
    }

    /**
     * @param int $canvasFit
     */
    public function setCanvasFit(int $canvasFit = self::CANVAS_FIT_CROP)
    {
        $this->canvasFit = $canvasFit;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ImageProcessor
     */
    public function setType(string $type = self::TYPE_JPEG)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * @param int $quality
     * @return ImageProcessor
     */
    public function setQuality(int $quality = self::QUALITY_HIGH)
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * @return string
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * @param string $background
     * @return ImageProcessor
     */
    public function setBackground(string $background = self::BACKGROUND_TRANSPARENT)
    {
        $this->background = $background;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return $this
     */
    public function setWidth(int $width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function setHeight(int $height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileData(int $encoding = self::DATA_ENCODING_RAW)
    {

        $this->render();
        $data = $this->getImageData();

        switch ( $encoding ) {
            case self::DATA_ENCODING_BASE64:
                return base64_encode($data);

            case self::DATA_ENCODING_BASE64_DATA_URI:
                return 'data:'.$this->getType().';base64,'.base64_encode($data);

            default:
                return $data;
        }
    }

    /**
     * @param string $outputPath
     * @return $this
     * @throws \Exception
     */
    public function save(string $outputPath)
    {
        if ( !is_writable($outputPath) ) {
            throw new \Exception('File not writable.');
        }
        file_put_contents($outputPath, $this->getFileData(self::DATA_ENCODING_RAW));
        return $this;
    }

    /**
     * @return ImageResource
     */
    private function getSource()
    {
        return $this->source;
    }

    /**
     * @param ImageResource $source
     * @return ImageProcessor
     */
    private function setSource(ImageResource $source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return ImageResource
     */
    private function getTarget()
    {
        return $this->target;
    }

    /**
     * @param ImageResource $target
     * @return ImageProcessor
     */
    private function setTarget(ImageResource $target)
    {
        $this->target = $target;
        return $this;
    }

    private function render() {

        $sourceWidth = $this->getSource()->getWidth();
        $sourceHeight = $this->getSource()->getHeight();

        $sourceRatio = $sourceWidth / $sourceHeight;
        $sourceOrientation = $sourceRatio > 1 ? 'LANDSCAPE' : 'PORTRAIT';

        $targetWidth = $this->getWidth();
        $targetHeight = $this->getHeight();

        $canvasWidth = $targetWidth;
        $canvasHeight = $targetHeight;

        if ( $this->getObjectFit() == self::OBJECT_FIT_COVER ) {
            if ( $sourceOrientation === 'LANDSCAPE' ) {
                $canvasWidth = $targetWidth;
                $targetWidth = $targetHeight * $sourceRatio;

            } else {
                $canvasHeight = $targetHeight;
                $targetHeight = $targetWidth / $sourceRatio;
            }

            if ( $targetWidth < $canvasWidth ) {
                $targetWidth = $canvasWidth;
                $targetHeight = $targetWidth / $sourceRatio;

            } else if ( $targetHeight < $canvasHeight ) {
                $targetHeight = $canvasHeight;
                $targetWidth = $targetHeight * $sourceRatio;
            }

        } else if ( $this->getObjectFit() === self::OBJECT_FIT_CONTAIN ) {
            if ( $sourceOrientation === 'PORTRAIT' ) {
                $targetWidth = $targetHeight * $sourceRatio;
            } else {
                $targetHeight = $targetWidth / $sourceRatio;
            }
            if ( $this->getCanvasFit() == self::CANVAS_FIT_CROP ) {
                $canvasWidth = $targetWidth;
                $canvasHeight = $targetHeight;
            }
        }

        $targetX = round(($canvasWidth - $targetWidth) / 2);
        $targetY = round(($canvasHeight - $targetHeight) / 2);

        $canvas = imagecreatetruecolor($canvasWidth, $canvasHeight);

        if ( $this->getBackground() === self::BACKGROUND_TRANSPARENT ) {
            if ( $this->getType() === self::TYPE_PNG ) {
                imagesavealpha($canvas, true);
                imagealphablending($canvas, false);
                imagefill($canvas, 0, 0, imagecolorallocatealpha($canvas, 255, 255, 255, 127));
            } else {
                $trans_color = imagecolortransparent($canvas);
                imagecolortransparent(
                    $canvas,
                    imagecolorallocate($canvas, $trans_color['red'], $trans_color['green'], $trans_color['blue'])
                );
            }
        } else {
            imagefill($canvas, 0, 0, hexdec(ltrim($this->getBackground(), '#')));
        }

        imagecopyresampled(
            $canvas,
            $this->getSource()->getResource(),
            $targetX,
            $targetY,
            0,
            0,
            $targetWidth,
            $targetHeight,
            $sourceWidth,
            $sourceHeight
        );

        $target = new ImageResource();
        $target->setResource($canvas);
        $this->setTarget($target);

    }

    private function getImageData() {

        ob_start();

        switch ( $this->getType() ) {
            case self::TYPE_GIF:
                imagegif($this->getTarget()->getResource());
                break;

            case self::TYPE_PNG:
                imagepng($this->getTarget()->getResource(), null, $this->getQuality());
                break;

            default:
                imagejpeg($this->getTarget()->getResource(), null, $this->getQuality());
        }

        $data = ob_get_contents();
        ob_end_clean();

        imagedestroy($this->getSource()->getResource());
        imagedestroy($this->getTarget()->getResource());

        return $data;
    }

}