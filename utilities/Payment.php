<?php 
    class Payment
    {

        // ID    | TYPE       | FULLNAME  | CARDNUMBER | PIN_CVV | ADDRESSID | ACCOUNTID | EXPDATE 
               
        private $type;
        private $fullname;
        private $cardnumber;
        private $pin_cvv;
        private $expdate;        
        
        public function getType()   { return $this->type; }    
        public function getFullName()   { return $this->fullname; }
        public function getCardNumber()   { return $this->cardnumber; }
        public function getPinCVV() { return $this->pin_cvv; }
        public function getExpDate() { return $this->expdate; }
        
    }
?> 