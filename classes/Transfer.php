    <?php
        include_once(__DIR__ . "/Db.php");

        class Transfer
        {
                private $user;
                private $amount;
                private $transferMessage;
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
                        if (empty($user)) {
                                throw new Exception("Gelieve een naam in te vullen.");
                        } else {
                                $this->user = $user;

                                return $this;
                        }
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
                        if (empty($amount) || $amount <= 0) {
                                throw new Exception("Het bedrag mag niet minder dan 1 token zijn.");
                                echo "te weinig";
                        } else {
                                $this->amount = $amount;

                                return $this;
                        }
                }


                /**
                 * Get the value of message
                 */
                public function getTransferMessage()
                {
                        return $this->message;
                }

                /**
                 * Set the value of message
                 *
                 * @return  self
                 */
                public function setTransferMessage($transferMessage)
                {
                        if (empty($transferMessage)) {
                                throw new Exception("Gelieve een reden voor overdracht te geven.");
                        } else {
                                $this->message = $transferMessage;

                                return $this;
                        }
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

                public static function getAvailableTokens()
                {
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("SELECT tokens from users where id = :userid");
                        $userid = $_SESSION['user_id'];
                       // var_dump($userid);
                        $statement->bindValue('userid', $userid);
                        $statement->execute();

                        $result = $statement->fetch(PDO::FETCH_ASSOC);
                        //var_dump($result);
                        return $result;
                }

                public function userSuggestion()
                {
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("SELECT * FROM users WHERE firstname LIKE :firstname ");
                        $username = $this->getUser();
                        $statement->bindValue(':firstname', $username);
                        $statement->execute();
                        $result = $statement->fetch(PDO::FETCH_ASSOC);
                        //var_dump($result);

                        if ($result === false) {
                                throw new Exception("Deze gebruiker bestaat niet.");
                        } else {
                                throw new Exception("DEZE GEBRUIKER BESTAAT");
                        }
                }

                public function completeTransfer(){
                        $conn = Db::getConnection();
                        $statement = $conn->prepare("UPDATE users SET tokens = tokens + :tokens WHERE firstname = :firstname; INSERT INTO transfer(users_id, tokens, description) values(:users_id, :tokens, :description); UPDATE users SET tokens = tokens - :tokens WHERE id = :users_id;");
                        
                        $firstname = $this->getUser();
                        $users_id = $this->$_SESSION['user_id'];
                        $tokens = $this->getAmount();
                        $description = $this->getTransferMessage();

                        $statement->bindValue(':tokens', $tokens);
                        $statement->bindValue(':firstname', $firstname);
                        $statement->bindValue(':users_id', $users_id);
                        $statement->bindValue(':description', $description);

                        $result = $statement->execute();

                        return $result;


                }
        }
