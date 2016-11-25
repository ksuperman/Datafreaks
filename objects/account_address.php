<?php

class account_address
{
    // Address
    private $ADDRID;
    private $UNITNUMBER;
    private $STREETNAME;
    private $CITY;
    private $STATE;
    private $COUNTRY;
    private $ZIPCODE;

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
}