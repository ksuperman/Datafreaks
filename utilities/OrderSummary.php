<?php 
    class OrderSummary
    {
               
        private $productid;
        private $quantity;
        private $name;
        private $price;
        private $total;
        
        public function getProductId()   { return $this->productid; }    
        public function getQuantity()   { return $this->quantity; }
        public function getName() { return $this->name; }
        public function getPrice() { return $this->price; }
        public function getTotal() { return $this->total; }
    }
?> 