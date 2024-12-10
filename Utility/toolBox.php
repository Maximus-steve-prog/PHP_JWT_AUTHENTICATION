<?php

    class toolBox {

        //Input method value for Sanitization
        public function validateEmail($email) {
            $email = trim($email);
            $email = stripcslashes($email);
            $email = htmlspecialchars($email);
            $email = strip_tags($email);
            $email = filter_var($email,FILTER_VALIDATE_EMAIL);
            return $email;
        } 
        
        public function configEmail($email) {
            $email = trim($email);
            $email = stripcslashes($email);
            $email = htmlspecialchars($email);
            $email = strip_tags($email);
            $email = filter_var($email,FILTER_SANITIZE_EMAIL);
            return $email;
        }
        
        public function validateInt($value) {
            $value = trim($value);
            $value = stripcslashes($value);
            $value = htmlspecialchars($value);
            $value = strip_tags($value);
            $value = filter_var($value,FILTER_VALIDATE_INT);
            return $value;
        }

        public function validateString($value) {
            // Trim whitespace from the beginning and end of the string
            $value = trim($value);
            $value = stripslashes($value);
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            $value = strip_tags($value);
            return $value;
        }

        function encrypt($plaintext, $key) {
            // Generate a random Initialization Vector (IV)
            $ivLength = openssl_cipher_iv_length('aes-256-cbc');
            $iv = openssl_random_pseudo_bytes($ivLength); // Correct function
            // Encrypt the data
            $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, 0, $iv);
            // The IV is important for decryption, so we store it with the encrypted data
            return base64_encode($iv . $ciphertext); // Combine the IV and ciphertext and encode them
        }
        
        function decrypt($data, $key) {
            // Decode the base64 encoded data
            $data = base64_decode($data);
            // Extract the IV and ciphertext from the combined data
            $ivLength = openssl_cipher_iv_length('aes-256-cbc');
            $iv = substr($data, 0, $ivLength);
            $ciphertext = substr($data, $ivLength);        
            return openssl_decrypt($ciphertext, 'aes-256-cbc', $key, 0, $iv);
        }

    }
?>