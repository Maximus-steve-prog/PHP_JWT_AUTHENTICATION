<?php

    // Correct file path with consistent directory separator.
    require_once(dirname(__FILE__) . '../../IRepositories/userIRepository.php');
    require_once(dirname(__FILE__) . '../../DbConfiguration/Configuration.php');
    require_once(dirname(__FILE__) . '../../Utility/toolBox.php');
    require_once(dirname(__FILE__) . '../../vendor/autoload.php');
    use \Firebase\JWT\JWT;


    class UserRepository implements UserIRepository {
        

        private $connection; // Define connection without instantiation
        private $tool;
        private $secretKey = '3cfa76ef14937c1c0ea519f8fc057a80fcd04a7420f8e8bcd0a7567c272e007b'; // Change this
        private const key = 'Steve688086860';
        // Constructor to initialize connection
        public function __construct() {
            $this->tool = new toolBox();
            $dbConfig = new PDODatabaseConfiguration();
            $this->connection = $dbConfig->getConnection();
            // Assuming getConnection() returns a PDO instance
        }
    
        public function register($userModal) {
            //This is the query to create a new user
            $query = 'INSERT INTO user(username,email,password)
                        VALUES (:username,:email,:password)';
            $statement = $this->connection->prepare($query);
            // Use password_hash to create a secure password hash
            $hashedPassword = password_hash($userModal->password, PASSWORD_DEFAULT);

            // Execute the statement with hashed password
            $statement->execute([
                'username' => $userModal->username,
                'email' => $userModal->email,
                'password' => $hashedPassword
            ]);

            // Optionally return a success message or the new user's ID
            return true; // or return the new user's ID, or another success indicator
        }

        public function delete($id) {
            $query = 'DELETE FROM user WHERE user_id=:id';
            $statement = $this->connection->prepare($query);    
            $statement->execute(['id'=> $id]);
            return true;
            // Implementation code goes here
        }

        public function update($userModal) {
            $query = 'UPDATE user SET username=:username,
                    email=:email,password=:password
                    WHERE user_id=:id';
            $statement = $this->connection->prepare($query);
            $statement->execute(['username'=> $userModal->username, 
                                        'email'=> $userModal->email,
                                        'password'=> $userModal->password,
                                        'id'=>$userModal->user_id]);
        }

        public function isExistEmail($email) {
            $query = 'SELECT * FROM user WHERE email=:email';
            $statement = $this->connection->prepare($query);
            $statement->execute(['email'=> $email]);
            $statement->fetch(PDO::FETCH_OBJ);
            return $statement->rowCount();
        }

        public function findAll(): array { // Assuming you want to return an array of userModals
            $query = 'SELECT * FROM user';
            $statement = $this->connection->prepare($query);    
            $statement->execute();
            // while ($row = $statement->fetchAll()){
            //     $userList[] = $row;
            // }
            foreach ($statement->fetchAll() as $row){
                $userList[]=$row;
            }
            return $userList; // Return an array for demonstration
        }

        public function findById($id) {
            // Find a user by ID and return it
            $query = 'SELECT * FROM user WHERE user_id=:id';
            $statement = $this->connection->prepare($query);
            $statement->execute(['id'=> $id]);
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
            // Or return the found user
        }

        public function login($email, $password) {
            // SQL query to select user 
            $query = 'SELECT * FROM user WHERE email = :email';
            // Prepare statement
            $statement = $this->connection->prepare($query);
            // Execute statement with prepared values
            $statement->execute(['email' => $email]);
        
            // Check if user exists
            if ($statement->rowCount() > 0) {
                // Fetch user data
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                // Verify the password (using hashed passwords)
                if (password_verify($password, $row['password'])) {
                    // Generate and return JWT token
                    return $this->generateJWT($row['user_id'], $row['username']);
                } else {
                    // Password does not match
                    return false; // Consider a custom error here or throw an exception
                }
            } else {
                // No user found with provided email
                return false; // Consider a custom error here or throw an exception
            }
        }

        public function generateJWT($id, $username) {
            try {
                $payload = [
                    'iat' => time(),
                    'exp' => time() + (60 * 60), // Token expires in 1 hour
                    'uid' => $id,
                    'username' => $username,
                ];           
                return JWT::encode($payload, $this->secretKey, 'HS256');
            } catch (Exception $e) {
                echo 'Error encoding JWT: ' . $e->getMessage();
                return false;
            }
        }

        public function isLoggedIn(){

        }
        public function logout(){

        }
        public function isLoggedOut(){

        }
        public function changePassword(){

        }

        public function updatePassword(){
            
        }
        
    }


    // $UserRepository = new UserRepository();
    // echo($UserRepository->login('steven@gmail.com', '123123')); 
?>