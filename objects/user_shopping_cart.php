<?php

class user_shopping_cart
{
    private $SHOPPINGCARTID;
    private $ACCOUNTID;
    private $STATUS;

    public function getSHOPPINGCARTID()
    {
        return $this->SHOPPINGCARTID;
    }

    public function getACCOUNTID()
    {
        return $this->ACCOUNTID;
    }

    public function getSTATUS()
    {
        return $this->STATUS;
    }
}