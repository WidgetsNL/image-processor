<?php

require_once '../ImageProcessor.php';
require_once '../ImageResource.php';

use WidgetsNL\ImageProcessor\ImageProcessor;

?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">

	<title>ImageProcessor</title>

    <style>
        img {
            outline: 2px solid #F00;
        }
    </style>

</head>

<body>

<div class="container-fluid">

    <h1>PNG with alpha</h1>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>PNG, keep alpha</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/alpha-channel.png');
                $image->setWidth(100)->setHeight(100)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>PNG on white</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/alpha-channel.png');
                $image->setWidth(100)->setHeight(100)->setBackground(ImageProcessor::BACKGROUND_WHITE)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>JPEG on red</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/alpha-channel.png');
                $image->setWidth(100)->setHeight(100)->setType(ImageProcessor::TYPE_JPEG)->setBackground('#ff0000')
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>

    <h1>CanvasFit:crop ObjectFit:Contain</h1>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(100)->setHeight(100)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(100)->setHeight(300)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(300)->setHeight(100)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(100)->setHeight(100)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(100)->setHeight(300)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(300)->setHeight(100)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Square > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(100)->setHeight(100)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Square > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(100)->setHeight(300)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Square > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(300)->setHeight(100)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>

    <hr>

    <h1>CanvasFit:crop ObjectFit:Cover</h1>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(100)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(100)->setHeight(300)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(300)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(100)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(100)->setHeight(300)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(300)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Square > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(100)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Square > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(100)->setHeight(300)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Square > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(300)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>

    <hr>
    <hr>
    <hr>

    <h1>CanvasFit:keep ObjectFit:Contain</h1>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(100)->setHeight(100)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(100)->setHeight(300)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(300)->setHeight(100)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(100)->setHeight(100)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(100)->setHeight(300)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(300)->setHeight(100)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Square > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(100)->setHeight(100)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Square > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(100)->setHeight(300)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Square > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(300)->setHeight(100)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>

    <hr>

    <h1>CanvasFit:keep ObjectFit:Cover</h1>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(100)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(100)->setHeight(300)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Landscape > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/landscape.jpg');
                $image->setWidth(300)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(100)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(100)->setHeight(300)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Portrait > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/portrait.jpg');
                $image->setWidth(300)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <h2>Square > 100x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(100)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Square > 100x300</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(100)->setHeight(300)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <h2>Square > 300x100</h2>
            <div class="well">
                <?php
                $image = new ImageProcessor('sample_images/square.jpg');
                $image->setWidth(300)->setHeight(100)->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
                ?>
                <img src="<?php echo $image->getFileData(ImageProcessor::DATA_ENCODING_BASE64_DATA_URI); ?>" alt="">
            </div>
        </div>

    </div>

</div>

<br>

</body>

</html>
