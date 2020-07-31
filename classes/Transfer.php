    <?php   
    include_once(__DIR__ . "/Db.php");

    class Transfer{
        private $user;
        private $amount;
        private $message; 
        private $id;

        /**
         * Get the value of amount
         */ 
        public function getAmount()
        {
                return $this->amount;
        }

        /**
         * Set the value of amount
         *
         * @return  self
         */ 
        public function setAmount($amount)
        {
            if(empty($amount)){
                throw new Exception("Het bedrag mag niet minder dan 1 token zijn.");
            }else{
                $this->amount = $amount;

                return $this;
            }
                
        }
    }