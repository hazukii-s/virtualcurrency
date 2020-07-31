<?php
include_once(__DIR__ . "/Db.php");

class User
{
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $id;

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        if (empty($firstname)) {
            throw new Exception("Gelieve een voornaam in te vullen.");
        } else {
            $this->firstname = $firstname;

            return $this;
        }
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        if (empty($lastname)) {
            throw new Exception("Gelieve een achternaam in te vullen.");
        } else {
            $this->lastname = $lastname;

            return $this;
        }
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        if (empty($email)) {
            throw new Exception("Gelieve een e-mailadres in te vullen.");
        } elseif (strpos($email, '@student.thomasmore.be') == false) {
            throw new Exception("Gelieve een Thomas More studentenmail te gebruiken.");
        } else {
            $this->email = $email;

            return $this;
        }
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        if (empty($password)) {
            throw new Exception("Gelieve een wachtwoord in te vullen.");
        } elseif (strlen($password) < 5) {
            throw new Exception("Gelieve meer dan 5 karakters te gebruiken.");
        } else {
            $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 13]);
            $this->password = $password;

            //var_dump($password);
            //echo "hashed";

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

    public function save()
    {
        //set connection PDO
        $conn = Db::getConnection();

        //prepare statement voor de databank
        $statement = $conn->prepare("insert into users(firstname, lastname, email, password, tokens) values (:firstname, :lastname, :email, :password, 10)");

        //bind values = sql injection
        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $email = $this->getEmail();
        $password = $this->getPassword();

        $statement->bindValue(':firstname', $firstname);
        $statement->bindValue(':lastname', $lastname);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);

        //execute statement
        $result = $statement->execute();

        //return result = saved
        return $result;
    }

    public function login(){
        //set connection 
        $conn = Db::getConnection();
        //get values from form 
        $email = $_POST['email'];
        $passwordLogin = $_POST['password'];
        //echo $email;

        //prepare statement
        $statement = $conn->prepare("select id, email, password from users where email = :email ");
        $statement->bindValue(':email', $email);
        //execute statement
        $statement->execute();
        //fetch row to check with database
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        //geen row te vinden? -> geen bestaande user
        if($user === false){
            throw new Exception("Email en/of wachtwoord is incorrect.");
        } else{
            //user gevonden -> wachtwoord checken
            //echo "user found";
            $passwordCheck = password_verify($passwordLogin, $user['password'] );
            var_dump($user['password']);
            var_dump($passwordCheck);

            if($passwordCheck){
                //stel login session vast 
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['logged_in'] = time();
                //redirect naar index.php
                header('Location: index.php');
            } else{
                throw new Exception("Email en/of wachtwoord is incorrect.");
            }
        }

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
    }

   
}
