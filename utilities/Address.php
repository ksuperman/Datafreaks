<?php 
    class Address
    {
               
        private $id;
        private $unitnumber;
        private $streetname;
        private $city;
        private $state;
        private $country;
        private $zipcode;
        
        public function getId()   { return $this->id; }    
        public function getUnitNumber()   { return $this->unitnumber; }
        public function getStreetName()   { return $this->streetname; }
        public function getCity() { return $this->city; }
        public function getState() { return $this->state; }
        public function getCountry() { return $this->country; }
        public function getZipCode() { return $this->zipcode; }
    }
?> 