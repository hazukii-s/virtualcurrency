<?php

class User
{
    private $firstname;
    private $lastname;
    private $email;
    private $password;

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
        if(empty($email)){
            throw new Exception("Gelieve een e-mailadres in te vullen.");
        }elseif(strpos($email, '@student.thomasmore.be') == false){
            throw new Exception("Gelieve een Thomas More studentenmail te gebruiken.");
        }else{
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
        if(empty($password)){
            throw new Exception("Gelieve een wachtwoord in te vullen.");
        }else{
            $this->password = $password;

            return $this;
        }
    
    }
}
