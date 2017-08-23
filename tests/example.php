<?php

    require_once '../ImageProcessor.php';
    require_once '../ImageResource.php';

    use WidgetsNL\ImageProcessor\ImageProcessor;

    $image = new ImageProcessor('sample_images/landscape.jpg');
//    $image = new ImageProcessor('sample_images/portrait.jpg');
//    $image = new ImageProcessor('sample_images/square.jpg');
//    $image = new ImageProcessor('sample_images/alpha-channel.png');

    $image
        ->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
        ->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
        ->setWidth(200)
        ->setHeight(200)
    ;

    $data = $image->getFileData();

    header('Content-Type: '.$image->getType());
    echo $data;
//    $image->save('test.jpg');