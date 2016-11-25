<?php

class user_account
{
    // User
    private $UID;
    private $FIRSTNAME;
    private $MIDDLENAME;
    private $LASTNAME;
    private $USERNAME;
    private $DOB;

    // Account
    private $AID;
    private $EMAIL;
    private $PASSWORD;
    private $ADDRESSID;

    public function getUserId()
    {
        return $this->UID;
    }

    public function getFirstName()
    {
        return $this->FIRSTNAME;
    }

    public function getMiddleName()
    {
        return $this->MIDDLENAME;
    }

    public function getLastName()
    {
        return $this->LASTNAME;
    }

    public function getUserName()
    {
        return $this->USERNAME;
    }

    public function getDOB()
    {
        return $this->DOB;
    }

    public function getAccountId()
    {
        return $this->AID;
    }

    public function getEmail()
    {
        return $this->EMAIL;
    }

    public function getPassword()
    {
        return $this->PASSWORD;
    }

    public function getAddressId()
    {
        return $this->ADDRESSID;
    }
}