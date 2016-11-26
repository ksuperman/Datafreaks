<?php

/**
 * Created by PhpStorm.
 * User: Parteek
 * Date: 11/19/2016
 * Time: 10:05 PM
 */
class CatalogProduct
{
    private $id;
    private $catalogid;
    private $category;
    private $name;
    private $price;
    private $description;
    private $image;

    public function getId()
    {
        return $this->id;
    }

    public function getCatalogid()
    {
        return $this->catalogid;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }


}

?>