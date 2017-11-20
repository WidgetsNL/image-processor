# ImageProcessor
A PHP library to resize / convert images

## Table of contents
- [Requirements](#requirements)
- [Installation](#installation)
    - [Composer](#installation-composer)
    - [Manual installation](#installation-manual)
- [Usage](#usage)
    - [Basic usage](#usage-basic)
    - [Specify image type](#usage-type)
    - [Output to string](#usage-output-raw)
    - [Output to base64 encoded string / base64 data URI](#usage-output-base64)
- [Reference](#reference)
    - [ImageProcessor](#reference-image-processor)
        - [__construct()](#reference-image-processor-constructor)
        - [setResourceFromPath()](#reference-image-processor-set-resource-from-path)
        - [setResourceFromFileData()](#reference-image-processor-set-resource-from-file-data)
        - [getWidth()](#reference-image-processor-get-width)
        - [setWidth()](#reference-image-processor-set-width)
        - [getHeight()](#reference-image-processor-get-height)
        - [setHeight()](#reference-image-processor-set-height)
        - [Object fit](#reference-image-processor-object-fit)
            - [getObjectFit()](#reference-image-processor-get-object-fit)
            - [setObjectFit()](#reference-image-processor-set-object-fit)
        - [Canvas fit](#reference-image-processor-canvas-fit)
            - [getCanvasFit()](#reference-image-processor-get-canvas-fit)
            - [setCanvasFit()](#reference-image-processor-set-canvas-fit)
        - [Type](#reference-image-processor-type)
            - [getType()](#reference-image-processor-get-type)
            - [setType()](#reference-image-processor-set-type)
        - [Quality](#reference-image-processor-quality)
            - [getQuality()](#reference-image-processor-get-quality)
            - [setQuality()](#reference-image-processor-set-quality)
        - [Background](#reference-image-processor-background)
            - [getBackground()](#reference-image-processor-get-background)
            - [setBackground()](#reference-image-processor-set-background)
        - [getFileData()](#reference-image-processor-get-file-data)
        - [save()](#reference-image-processor-save)
    - [ImageResource](#reference-image-resource)

<a name="requirements"></a>
## Requirements
- PHP 7+
- [GD library](http://php.net/manual/en/book.image.php)

<a name="installation"></a>
## Installation

<a name="installation-composer"></a>
#### Using Composer
Run the following command:
```
composer require widgets-nl/image-processor
```

<a name="installation-manual"></a>
### Manual installation
- Clone or download the project
- Copy `ImageProcessor.php` and `ImageResource.php` to your directory of choice.
- Make sure the two files are autoloaded / included e.g.:

```php
require_once 'ImageProcessor.php';
require_once 'ImageResource.php';
```

<a name="usage"></a>
## Usage

<a name="usage-basic"></a>
#### Basic usage

```php
<?php

    use WidgetsNL\ImageProcessor\ImageProcessor;
    
    $image = new ImageProcessor('sample_images/landscape.jpg');
    $image
        ->setWidth(100)
        ->setHeight(100)
        ->save('output.jpg')
    ;
```

<a name="usage-type"></a>
#### Specify image type

```php
<?php

    use WidgetsNL\ImageProcessor\ImageProcessor;
    
    $image = new ImageProcessor('sample_images/landscape.jpg');
    $image
        ->setType(ImageProcessor::TYPE_PNG)
        ->save('output.png')
    ;
```

<a name="usage-output-raw"></a>
#### Output to string

```php
<?php

    use WidgetsNL\ImageProcessor\ImageProcessor;
    
    $image = new ImageProcessor('sample_images/landscape.jpg');
    $image
        ->setWidth(100)
        ->setHeight(100)
    ;
    $imageData = $image->getFileData();
    
    header('Content-Type: image/jpeg');
    echo $imageData;
```

<br/>

<a name="usage-output-base64"></a>
#### Output to base64 encoded string / base64 data URI

```php
<?php

    use WidgetsNL\ImageProcessor\ImageProcessor;
    
    $image = new ImageProcessor('sample_images/landscape.jpg');
    $image
        ->setWidth(100)
        ->setHeight(100)
    ;
//    $imageData = $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64);
    $imageDataURI = $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI);

?>

<img src="<?php echo $imageDataURI; ?>">
<!-- This will output src="data:image/jpeg;base64, ... ... " -->
```

<br/>

<a name="reference"></a>
## Reference

<a name="reference-image-processor"></a>
### `class` ImageProcessor

<a name="reference-image-processor-constructor"></a>
#### `public function` __construct`(string $pathOrFileData = '') : ImageProcessor`
Class constructor

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$pathOrFileData` | `string` | No | `''` | If set, checks whether a file path or raw image data is passed and calls [`setResourceFromPath`](#reference-image-processor-set-resource-from-path) or [`setResourceFromFileData`](#reference-image-processor-set-resource-from-file-data) accordingly.  

**Example:**

```php
$image = new ImageProcessor();

// Or

$image = new ImageProcessor('test.jpg');

// Or

$image = new ImageProcessor(file_get_contents('test.jpg'));
```

<br/>

<a name="reference-image-processor-set-resource-from-path"></a>
#### `public function` setResourceFromPath`(string $path) : ImageProcessor`
Loads image from specified path.
Creates an [`ImageResource`](#reference-image-resource) instance internally.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$path` | `string` | Yes | n/a | Full path to an image file

**Example:**

```php
$image = new ImageProcessor();
$image->setResourceFromPath('test.jpg');
```

<br/>

<a name="reference-image-processor-set-resource-from-file-data"></a>
#### `public function` setResourceFromFileData`(string $fileData) : ImageProcessor`
Loads image from raw image data.
Creates an [`ImageResource`](#reference-image-resource) instance internally.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$fileData` | `string` | Yes | n/a | Raw image data

**Example:**

```php
$image = new ImageProcessor();
$image->setResourceFromFileData(file_get_contents('test.jpg'));
```

<br/>

<a name="reference-image-processor-get-width"></a>
#### `public function` getWidth`() : int`
Returns the current width setting.

<br/>

<a name="reference-image-processor-set-width"></a>
#### `public function` setWidth`(int $width) : ImageProcessor`
Set the width of the output image.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$width` | `int` | Yes | n/a, _but if setWidth is never called, value is inherited from source image_ | Maximum output image width

**Example:**

```php
$image = new ImageProcessor('test.png');
$image
    ->setWidth(100)
    ->save('test_copy.png')
;
```

<br/>

<a name="reference-image-processor-get-height"></a>
#### `public function` getHeight`() : int`
Returns the current height setting.

<br/>

<a name="reference-image-processor-set-height"></a>
#### `public function` setHeight`(int $height) : ImageProcessor`
Set the height of the output image.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$height` | `int` | Yes | n/a, _but if setHeight is never called, value is inherited from source image_ | Maximum output image height

**Example:**

```php
$image = new ImageProcessor('test.png');
$image
    ->setHeight(100)
    ->save('test_copy.png')
;
```

<br/>

<a name="reference-image-processor-object-fit"></a>
#### Object fit
The object fit setting is inspired by the [`object-fit` CSS property](https://developer.mozilla.org/en-US/docs/Web/CSS/object-fit) and works pretty much the same way.

There are 3 possible values:

Value | Constant | Description
---|---|---
`1` | `ImageProcessor::OBJECT_FIT_FILL` | The source image is stretched to match the target dimensions. For most images, you probably do not want to use this, as this messes up the aspect ratio.
`2` | `ImageProcessor::OBJECT_FIT_CONTAIN` | The source image is scaled to fit within the bounding box of the target dimensions, maintaining its aspect-ratio and without cropping. This is the default setting.
`3` | `ImageProcessor::OBJECT_FIT_COVER` | The source image is scaled to fill the full bounding box of the target dimensions. It will be cropped to fit. 

<a name="reference-image-processor-get-object-fit"></a>
#### `public function` getObjectFit`() : int`
Returns the current [`object fit`](#reference-image-processor-object-fit) setting.

<br/>

<a name="reference-image-processor-set-object-fit"></a>
#### `public function` setObjectFit`(int $objectFit = self::OBJECT_FIT_CONTAIN) : ImageProcessor`
Set the [`object fit`](#reference-image-processor-object-fit) setting to be applied to the image upon output.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$objectFit` | `int` | Yes | `2` | Object fit setting to use

**Example:**

```php
$image = new ImageProcessor('test.jpg');
$image
    ->setWidth(100)
    ->setHeight(100)
    ->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
    ->save('test_copy.jpg')
;
```

<br/>

<a name="reference-image-processor-canvas-fit"></a>
#### Canvas fit
The canvas fit setting determines whether or not the output image canvas must be cropped to match the image.
This setting is only relevant when setting the [`object fit`](#reference-image-processor-object-fit) setting to `ImageProcessor::OBJECT_FIT_CONTAIN`

There are 2 possible values:

Value | Constant | Description
---|---|---
`1` | `ImageProcessor::CANVAS_FIT_KEEP` | The canvas will not be cropped. The output image dimensions will always be set to the specified width and height settings.
`2` | `ImageProcessor::CANVAS_FIT_CROP` | The canvas will be cropped to fit the containing image. The output image dimensions may differ from the specified width and height settings. This is the default setting.

<a name="reference-image-processor-get-canvas-fit"></a>
#### `public function` getCanvasFit`() : int`
Returns the current [`canvas fit`](#reference-image-processor-canvas-fit) setting.

<br/>

<a name="reference-image-processor-set-canvas-fit"></a>
#### `public function` setCanvasFit`(int $canvasFit = self::CANVAS_FIT_CROP) : ImageProcessor`
Set the [`canvas fit`](#reference-image-processor-canvas-fit) setting to be applied to the image upon output.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$canvasFit` | `int` | Yes | `2` | Canvas fit setting to use

**Example:**

```php
$image = new ImageProcessor('test.jpg');
$image
    ->setWidth(100)
    ->setHeight(100)
    ->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
    ->save('test_copy.jpg')
;
```

<br/>

<a name="reference-image-processor-type"></a>
#### Type (mimetype)
When loading an image from a file path, the output file type will automatically be of the same type by default.
When no type can be determined (e.g. when loading an image from raw image data), `image/jpeg` will be used by default.

You may also specify an output type to be used.

Currently, there are 3 supported file types:

Value | Constant | Description
---|---|---
`image/jpeg` | `ImageProcessor::TYPE_JPEG` | JPEG image.
`image/png` | `ImageProcessor::TYPE_PNG` | PNG-24 image with alpha channel (if applicable).
`image/gif` | `ImageProcessor::TYPE_GIF` | Gif image with transparency (if applicable).

<a name="reference-image-processor-get-type"></a>
#### `public function` getType`() : string`
Returns the current [`type`](#reference-image-processor-type) setting.

<br/>

<a name="reference-image-processor-set-type"></a>
#### `public function` setType`(string $type = self::TYPE_JPEG) : ImageProcessor`
Set the [`type`](#reference-image-processor-type) to be used on the output image.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$type` | `string` | Yes | `image/jpeg` | Output image mime type

**Example:**

```php
$image = new ImageProcessor('test.jpg');
$image
    ->setType(ImageProcessor::TYPE_PNG)
    ->save('test.png')
;
```

<br/>

<a name="reference-image-processor-quality"></a>
#### Quality
Sets the image quality (compression level) to be used on the output image.

This setting does not apply to `gif` images, and has little to no effect on most `png` images.

The quality setting uses a 1-100 value, but has some built-in defaults:

Value | Constant | Description
---|---|---
`25` | `ImageProcessor::QUALITY_LOW` | Low quality.
`50` | `ImageProcessor::QUALITY_MEDIUM` | Medium quality.
`75` | `ImageProcessor::QUALITY_HIGH` | High quality.
`100` | `ImageProcessor::QUALITY_MAXIMUM` | Highest quality.

<a name="reference-image-processor-get-quality"></a>
#### `public function` getQuality`() : int`
Returns the current [`quality`](#reference-image-processor-quality) setting.

<br/>

<a name="reference-image-processor-set-quality"></a>
#### `public function` setQuality`(int $quality = self::QUALITY_HIGH) : ImageProcessor`
Set the [`quality`](#reference-image-processor-quality) setting to be applied to the image upon output.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$quality` | `int` | Yes | `75` | Quality setting to use

**Example:**

```php
$image = new ImageProcessor('test.jpg');
$image
    ->setQuality(ImageProcessor::QUALITY_LOW)
    ->save('test_copy.jpg')
;
```

<br/>

<a name="reference-image-processor-background"></a>
#### Background fill
Sets the background fill style/color to be used on the output image.

The background may be set to **any valid hex color** (e.g. #FF0000), but the short (#F00) notation is not supported.
The pound/hash sign is optional.

For `png` or `gif` images, you may use the `TRANSPARENT` setting.
Some built-in values:

Value | Constant | Description
---|---|---
`TRANSPARENT` | `ImageProcessor::BACKGROUND_TRANSPARENT` | Transparent fill (`gif` and `png` images only).
`#000000` | `ImageProcessor::BACKGROUND_BLACK` | Black background fill.
`#FFFFFF` | `ImageProcessor::BACKGROUND_WHITE` | Black background fill.

<a name="reference-image-processor-get-background"></a>
#### `public function` getBackground`() : string`
Returns the current [`background`](#reference-image-processor-background) setting.

<br/>

<a name="reference-image-processor-set-background"></a>
#### `public function` setBackground`(string $background = self::QUALITY_HIGH) : ImageProcessor`
Set the [`background`](#reference-image-processor-background) setting to be applied to the image upon output.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$background` | `string` | Yes | `#000000` | Background setting to use

**Example:**

```php
$image = new ImageProcessor('test.png');
$image
//    ->setBackground('#FF0000')
    ->setBackground(ImageProcessor::BACKGROUND_WHITE)
    ->save('test_copy.png')
;
```

<br/>

<a name="reference-image-processor-get-file-data"></a>
#### `public function` getFileData`(int $encoding = self::DATA_ENCODING_RAW) : string`
Returns the output image as a string of image data.

The data encoding may be specified using the `encoding` parameter, which can be set to one of:

Value | Constant | Description
---|---|---
`1` | `ImageProcessor::DATA_ENCODING_RAW` | Raw image data.
`2` | `ImageProcessor::DATA_ENCODING_BASE64` | Base-64 encoded image data.
`3` | `ImageProcessor::DATA_ENCODING_BASE64_DATA_URI` | Base-64 encoded image data with a `data:`_`mimetype`_ prefix that automatically contains the appropriate mime type (e.g. `image/jpeg`).

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$encoding` | `int` | No | `1` | Output setting to use

**Example:**

```php
$image = new ImageProcessor('test.jpg');
$image->setWidth(100);
$rawImageData = $image->getFileData();
```

<br/>

<a name="reference-image-processor-save"></a>
#### `public function` save`(string $outputPath) : ImageProcessor`
Saves the output image to given path.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$outputPath` | `string` | Yes | n/a | Output path to write to

**Example:**

```php
$image = new ImageProcessor('test.png');
$image
    ->setWidth(100)
    ->save('test_copy.jpg')
;
```

<br/>

<a name="reference-image-resource"></a>
### `class` ImageResource
This class is used internally and has no accessible public members or methods.
