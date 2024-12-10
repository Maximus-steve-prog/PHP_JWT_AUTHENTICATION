<?php

        require_once(dirname(__FILE__) ."../../Repositories/userRepository.php");
        class userModel extends UserRepository{
                public $user_id;
                public $username;
                public $email;
                public $password;
                public $password_confirmation;
                

                /**
                 * Get the value of password_confirmation
                 */ 
                public function getPassword_confirmation()
                {
                        return $this->password_confirmation;
                }

                /**
                 * Set the value of password_confirmation
                 *
                 * @return  self
                 */ 
                public function setPassword_confirmation($password_confirmation)
                {
                        $this->password_confirmation = $password_confirmation;
                        return $this;
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
                        $this->email = $email;
                        return $this;
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
                        $this->password = $password;
                        return $this;
                }

                /**
                 * Get the value of username
                 */ 
                public function getUsername()
                {
                        return $this->username;
                }

                /**
                 * Set the value of username
                 *
                 * @return  self
                 */ 
                public function setUsername($username)
                {
                        $this->username = $username;
                        return $this;
                }

                /**
                 * Get the value of user_id
                 */ 
                public function getUser_id()
                {
                        return $this->user_id;
                }

                /**
                 * Set the value of user_id
                 *
                 * @return  self
                 */ 
                public function setUser_id($user_id)
                {
                        $this->user_id = $user_id;
                        return $this;
                }
        }


?>