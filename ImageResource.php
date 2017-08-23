<?php

namespace WidgetsNL\ImageProcessor;

class ImageResource {

    /**
     * @var \resource
     */
    private $resource;

    /**
     * @return \resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param \resource $resource
     * @return ImageResource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return is_resource($this->resource) ? imagesx($this->resource) : null;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return is_resource($this->resource) ? imagesy($this->resource) : null;
    }

}