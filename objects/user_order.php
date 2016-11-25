<?php

class user_order
{
    // Order
    private $ORDERID;
    private $STATUS;
    private $ORDERDATE;
    private $USERID;

    // Address
    private $ADDRESSID;
    private $UNITNUMBER;
    private $STREETNAME;
    private $CITY;
    private $STATE;
    private $COUNTRY;
    private $ZIPCODE;

    // Payment
    private $PAYMENTID;
    private $TYPE;
    private $FULLNAME;
    private $CARDNUMBER;
    private $PIN_CVV;
    private $ACCOUNTID;
    private $EXPDATE;

    // Order Functions
    public function getORDERID()
    {
        return $this->ORDERID;
    }

    public function getSTATUS()
    {
        return $this->STATUS;
    }

    public function getORDERDATE()
    {
        return $this->ORDERDATE;
    }

    public function getUSERID()
    {
        return $this->USERID;
    }

    public function getADDRESSID()
    {
        return $this->ADDRESSID;
    }

    public function getPAYMENTID()
    {
        return $this->PAYMENTID;
    }

    // Address Functions
    public function getADDRID()
    {
        return $this->ADDRID;
    }

    public function getUNITNUMBER()
    {
        return $this->UNITNUMBER;
    }

    public function getSTREETNAME()
    {
        return $this->STREETNAME;
    }

    public function getCITY()
    {
        return $this->CITY;
    }

    public function getSTATE()
    {
        return $this->STATE;
    }

    public function getCOUNTRY()
    {
        return $this->COUNTRY;
    }

    public function getZIPCODE()
    {
        return $this->ZIPCODE;
    }

    // Payment Functions
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

    public function getACCOUNTID()
    {
        return $this->ACCOUNTID;
    }

    public function getEXPDATE()
    {
        return $this->EXPDATE;
    }
}