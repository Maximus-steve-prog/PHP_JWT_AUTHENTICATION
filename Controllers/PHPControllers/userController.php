<?php

    require_once(dirname(__FILE__) ."../../../Models/userModel.php");
    require_once(dirname(__FILE__) ."../../../Utility/toolBox.php");
    require_once(dirname(__FILE__) ."../../../Responses/Response.php");

    class UserController {

        private $response;
        public  $user;
        private $tool;
        public function __construct() {
            $this->response = new Response('',0);
            $this->user = new userModel();
            $this->tool = new toolBox();
        }
        public function registerUser() {
            $this->tool->validateString($this->user->getUsername());
            $this->tool->configEmail($this->user->getEmail());
            $this->tool->validateString($this->user->getPassword());
            if($this->tool->validateEmail($this->user->getEmail())) {
                if($this->user->isExistEmail($this->user->getEmail()) <= 0){
                    $this->user->register($this->user);
                    $this->response = new Response('created successfully',200);
                }else{
                    $this->response = new Response($this->user->getEmail().' already exists',201);
                }
            }else{
                $this->response = new Response($this->user->getEmail().'is not valid',202);
            }
            return json_encode([
                "content"=>$this->response->getContent(),
                "statusCode"=>$this->response->getStatusCode()
            ]);
        }

        public function updateUser() {
            $this->response = new Response("",0);
            $this->tool->validateString($this->user->getUsername());
            $this->tool->configEmail($this->user->getEmail());
            $this->tool->validateString($this->user->getPassword());
        }

        public function deleteUser() {
            if($this->tool->validateInt($this->user->getUser_id())){
                $this->user->delete($this->user->getUser_id());
                $this->response = new Response("Deleted Successfully",200);
            }else{
                $this->response = new Response($this->user->getUser_id()." is not valid",0);
            }
            echo json_encode([
                "content"=>$this->response->getContent(),
                "statusCode"=>$this->response->getStatusCode()
            ]);
        }

        public function getUser() {
            echo json_encode([
                $this->user->findAll()
            ]);
        }

        public function getLogin(){
            $this->tool->configEmail($this->user->getEmail());
            $this->tool->validateString($this->user->getPassword());
            if($this->tool->validateEmail($this->user->getEmail())) {
                $token = $this->user->login($this->user->getEmail(), $this->user->getPassword());
                if($token){
                    $this->response = new Response( $token,200);
                }else{
                    $this->response = new Response($this->user->getEmail()." doesn't exist",400);
                }
            }else{
                $this->response = new Response($this->user->getEmail()." is not valid",400);
            }

            return json_encode([
                "content"=>$this->response->getContent(),
                "statusCode"=>$this->response->getStatusCode()
            ]);
        }
    
    }




?>