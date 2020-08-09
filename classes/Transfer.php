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
                        $stmt = $conn->prepare("SELECT id FROM users WHERE firstname = :firstname");

                        $firstname = $this->getUser();

                        $stmt->bindValue(':firstname', $firstname);
                        $stmt->execute();
                        $receiverid = $stmt->fetch(PDO::FETCH_ASSOC);
                        var_dump($stmt);
                        var_dump($receiverid);

                        $statement1 = $conn->prepare("UPDATE users SET tokens = tokens + :tokens WHERE firstname = :firstname");
                        $statement2 = $conn->prepare("INSERT INTO transfers (senderid, receiverid, tokens, description) values(:senderid, :receiverid, :tokens, :description)");
                        $statement3 = $conn->prepare("UPDATE users SET tokens = tokens - :tokens WHERE id = :senderid;");

                        $senderid = $_SESSION['user_id'];
                        $tokens = $this->getAmount();
                        $description = $this->getTransferMessage();

                        $statement1->bindValue(':tokens', $tokens);
                        $statement1->bindValue(':firstname', $firstname);

                        $statement2->bindValue(':senderid', $senderid);
                        $statement2->bindValue('receiverid', $receiverid['id']);
                        $statement2->bindValue(':tokens', $tokens);
                        $statement2->bindValue(':description', $description);

                        $statement3->bindValue(':tokens', $tokens);
                        $statement3->bindValue(':senderid', $senderid);

                        var_dump($statement1);


                        $result = $statement1->execute();
                        $result2 = $statement2->execute();
                        $result3 = $statement3->execute();
   

                        return $result3;
                }
        }
