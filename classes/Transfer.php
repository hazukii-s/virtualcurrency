    <?php   
    include_once(__DIR__ . "/Db.php");

    class Transfer{
        private $user;
        private $amount;
        private $message; 
        private $id;

        
        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }
        
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
                echo "te weinig";
            }else{
                $this->amount = $amount;

                return $this;
            }
                
        }

        
        /**
         * Get the value of message
         */ 
        public function getMessage()
        {
                return $this->message;
        }

        /**
         * Set the value of message
         *
         * @return  self
         */ 
        public function setMessage($message)
        {
                $this->message = $message;

                return $this;
        }


               /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getAvailableTokens(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT tokens from users where id = :userid");
            $userid = $this->getId();
            $statement->bindValue('userid', $userid);
            $statement->execute();
    
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            //var_dump($result);
            return $result;

            //als tokens boven limiet gaan? -> error message
            if($_POST['amount'] > $result){
                throw new Exception("U bent boven uw beschikbaar saldo gegaan.");
            } 
        }
    }