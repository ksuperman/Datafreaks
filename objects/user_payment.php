<?php

class user_payment
{
    private $ID;
    private $TYPE;
    private $FULLNAME;
    private $CARDNUMBER;
    private $PIN_CVV;
    private $ADDRESSID;
    private $ACCOUNTID;
    private $EXPDATE;

    public function getID()
    {
        return $this->ID;
    }

    public function getTYPE()
    {
        return $this->TYPE;
    }

    public function getFULLNAME()
    {
        return $this->FULLNAME;
    }

    public function getCARDNUMBER()
    {
        return $this->CARDNUMBER;
    }

    public function getPINCVV()
    {
        return $this->PIN_CVV;
    }

    public function getADDRESSID()
    {
        return $this->ADDRESSID;
    }

    public function getACCOUNTID()
    {
        return $this->ACCOUNTID;
    }

    public function getEXPDATE()
    {
        return $this->EXPDATE;
    }
}