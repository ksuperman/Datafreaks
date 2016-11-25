<?php

class shopping_cart_items
{
    private $SHOPPINGCARTITEMID;
    private $CARTID;
    private $QUANTITY;

    private $PRODUCTID;
    private $CATALOGID;
    private $NAME;
    private $PRICE;
    private $DESCRIPTION;
    private $IMG;

    public function getSHOPPINGCARTITEMID()
    {
        return $this->SHOPPINGCARTITEMID;
    }


    public function getCARTID()
    {
        return $this->CARTID;
    }

    public function getQUANTITY()
    {
        return $this->QUANTITY;
    }

    public function getPRODUCTID()
    {
        return $this->PRODUCTID;
    }

    public function getCATALOGID()
    {
        return $this->CATALOGID;
    }

    public function getNAME()
    {
        return $this->NAME;
    }

    public function getPRICE()
    {
        return $this->PRICE;
    }

    public function getDESCRIPTION()
    {
        return $this->DESCRIPTION;
    }

    public function getIMG()
    {
        return $this->IMG;
    }


}