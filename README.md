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
        - [setResourceFromPath()](#reference-image-processor-set-source-from-path)
        - [setResourceFromFileData()](#reference-image-processor-set-source-from-file-data)
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

## Requirements<a name="requirements"></a>
- PHP 7+
- [GD library](http://php.net/manual/en/book.image.php)

## Installation<a name="installation"></a>

#### Using Composer<a name="installation-composer"></a>
Add the repository to your `composer.json`
```
"repositories": [
        {
            "type": "git",
            "url": "https://github.com/WidgetsNL/image-processor"
        }
    ]
```

Run the following command:
```
composer require widgets-nl/image-processor
```

### Manual installation<a name="installation-manual"></a>
- Clone the project
- Copy `ImageProcessor.php` and `ImageResource.php` to your directory of choice.
- Make sure the two files are included/required/autoloaded, e.g.:

```php
require_once 'ImageProcessor.php';
require_once 'ImageResource.php';
```

## Usage<a name="usage"></a>

#### Basic usage<a name="usage-basic"></a>

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

#### Specify image type<a name="usage-type"></a>

```php
<?php

    use WidgetsNL\ImageProcessor\ImageProcessor;
    
    $image = new ImageProcessor('sample_images/landscape.jpg');
    $image
        ->setType(ImageProcessor::TYPE_PNG)
        ->save('output.png')
    ;
```

#### Output to string<a name="usage-output-raw"></a>

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


#### Output to base64 encoded string / base64 data URI<a name="usage-output-base64"></a>

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


## Reference<a name="reference"></a>

### `class` ImageProcessor<a name="reference-image-processor"></a>

#### `public function` __construct`(string $pathOrFileData = '') : ImageProcessor`<a name="reference-image-processor-constructor"></a>
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


#### `public function` setResourceFromPath`(string $path) : ImageProcessor`<a name="reference-image-processor-set-resource-from-path"></a>
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


#### `public function` setResourceFromFileData`(string $fileData) : ImageProcessor`<a name="reference-image-processor-set-resource-from-file-data"></a>
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


#### `public function` getWidth`() : int`<a name="reference-image-processor-get-width"></a>
Returns the current width setting.


#### `public function` setWidth`(int $width) : ImageProcessor`<a name="reference-image-processor-set-width"></a>
Set the width of the output image.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$width` | `int` | Yes | _Inherited from source image_ | Maximum output image width

**Example:**

```php
$image = new ImageProcessor('test.png');
$image
    ->setWidth(100)
    ->save('test_copy.png')
;
```


#### `public function` getHeight`() : int`<a name="reference-image-processor-get-height"></a>
Returns the current height setting.


#### `public function` setHeight`(int $height) : ImageProcessor`<a name="reference-image-processor-set-height"></a>
Set the height of the output image.

For chainability, this method returns the `ImageProcessor` instance.

**Parameters**

Name | Type | Required | Default value | Description
---|---|---|---|---
`$height` | `int` | Yes | _Inherited from source image_ | Maximum output image height

**Example:**

```php
$image = new ImageProcessor('test.png');
$image
    ->setHeight(100)
    ->save('test_copy.png')
;
```

 
#### Object fit<a name="reference-image-processor-object-fit"></a>
The object fit setting is inspired by the [`object-fit` CSS property](https://developer.mozilla.org/en-US/docs/Web/CSS/object-fit) and works pretty much the same way.

There are 3 possible values:

Value | Constant | Description
---|---|---
`1` | `ImageProcessor::OBJECT_FIT_FILL` | The source image is stretched to match the target dimensions. For most images, you probably do not want to use this, as this messes up the aspect ratio.
`2` | `ImageProcessor::OBJECT_FIT_CONTAIN` | The source image is scaled to fit within the bounding box of the target dimensions, maintaining its aspect-ratio and without cropping. This is the default setting.
`3` | `ImageProcessor::OBJECT_FIT_COVER` | The source image is scaled to fill the full bounding box of the target dimensions. It will be cropped to fit. 

#### `public function` getObjectFit`() : int`<a name="reference-image-processor-get-object-fit"></a>
Returns the current [`object fit`](#reference-image-processor-object-fit) setting.


#### `public function` setObjectFit`(int $objectFit = self::OBJECT_FIT_CONTAIN) : ImageProcessor`<a name="reference-image-processor-set-object-fit"></a>
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

 
#### Canvas fit<a name="reference-image-processor-canvas-fit"></a>
The canvas fit setting determines whether or not the output image canvas must be cropped to match the image.
This setting is only relevant when setting the [`object fit`](#reference-image-processor-object-fit) setting to `ImageProcessor::OBJECT_FIT_CONTAIN`

There are 2 possible values:

Value | Constant | Description
---|---|---
`1` | `ImageProcessor::CANVAS_FIT_KEEP` | The canvas will not be cropped. The output image dimensions will always be set to the specified width and height settings.
`2` | `ImageProcessor::CANVAS_FIT_CROP` | The canvas will be cropped to fit the containing image. The output image dimensions may differ from the specified width and height settings. This is the default setting.

#### `public function` getCanvasFit`() : int`<a name="reference-image-processor-get-canvas-fit"></a>
Returns the current [`canvas fit`](#reference-image-processor-canvas-fit) setting.


#### `public function` setCanvasFit`(int $canvasFit = self::CANVAS_FIT_CROP) : ImageProcessor`<a name="reference-image-processor-set-canvas-fit"></a>
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

 
#### Type (mimetype)<a name="reference-image-processor-type"></a>
When loading an image from a file path, the output file type will automatically be of the same type by default.
When no type can be determined (e.g. when loading an image from raw image data), `image/jpeg` will be used by default.

You may also specify an output type to be used.

Currently, there are 3 supported file types:

Value | Constant | Description
---|---|---
`image/jpeg` | `ImageProcessor::TYPE_JPEG` | JPEG image.
`image/png` | `ImageProcessor::TYPE_PNG` | PNG-24 image with alpha channel (if applicable).
`image/gif` | `ImageProcessor::TYPE_GIF` | Gif image with transparency (if applicable).

#### `public function` getType`() : string`<a name="reference-image-processor-get-type"></a>
Returns the current [`type`](#reference-image-processor-type) setting.


#### `public function` setType`(string $type = self::TYPE_JPEG) : ImageProcessor`<a name="reference-image-processor-set-type"></a>
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

 
#### Quality<a name="reference-image-processor-quality"></a>
Sets the image quality (compression level) to be used on the output image.

This setting does not apply to `gif` images, and has little to no effect on most `png` images.

The quality setting uses a 1-100 value, but has some built-in defaults:

Value | Constant | Description
---|---|---
`25` | `ImageProcessor::QUALITY_LOW` | Low quality.
`50` | `ImageProcessor::QUALITY_MEDIUM` | Medium quality.
`75` | `ImageProcessor::QUALITY_HIGH` | High quality.
`100` | `ImageProcessor::QUALITY_MAXIMUM` | Highest quality.

#### `public function` getQuality`() : int`<a name="reference-image-processor-get-quality"></a>
Returns the current [`quality`](#reference-image-processor-quality) setting.


#### `public function` setQuality`(int $quality = self::QUALITY_HIGH) : ImageProcessor`<a name="reference-image-processor-set-quality"></a>
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

 
#### Background fill<a name="reference-image-processor-background"></a>
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

#### `public function` getBackground`() : string`<a name="reference-image-processor-get-background"></a>
Returns the current [`background`](#reference-image-processor-background) setting.


#### `public function` setBackground`(string $background = self::QUALITY_HIGH) : ImageProcessor`<a name="reference-image-processor-set-background"></a>
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


#### `public function` getFileData`(int $encoding = self::DATA_ENCODING_RAW) : string`<a name="reference-image-processor-get-file-data"></a>
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


#### `public function` save`(string $outputPath) : ImageProcessor`<a name="reference-image-processor-save"></a>
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


### `class` ImageResource<a name="reference-image-resource"></a>
This class is used internally and has no accessible public members or methods.