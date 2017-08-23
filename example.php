<?php

    require_once 'src/Widgets/ImageProcessor/ImageProcessor.php';
    require_once 'src/Widgets/ImageProcessor/ImageResource.php';

    use Widgets\ImageProcessor\ImageProcessor;

    $image = new ImageProcessor('sample_images/landscape.jpg');
//    $image = new ImageProcessor('sample_images/portrait.jpg');
//    $image = new ImageProcessor('sample_images/square.jpg');
//    $image = new ImageProcessor('sample_images/alpha-channel.png');

    $image
//        ->setObjectFit(ImageProcessor::OBJECT_FIT_COVER)
        ->setObjectFit(ImageProcessor::OBJECT_FIT_CONTAIN)
        ->setCanvasFit(ImageProcessor::CANVAS_FIT_KEEP)
        ->setWidth(200)
        ->setHeight(200)
    ;

    $data = $image->getFileData();

    header('Content-Type: '.$image->getType());
    echo $data;
//    $image->save('test.jpg');