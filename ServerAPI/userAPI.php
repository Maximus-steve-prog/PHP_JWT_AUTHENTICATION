<?php

// session_start();
require_once(dirname(__FILE__) . "../../Models/userModel.php");
require_once(dirname(__FILE__) . "../../Controllers/PHPControllers/userController.php");
$Controller = new UserController();
header("Content-Type: application/json");
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "POST":
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (isset($data["action"])) {
            switch ($data["action"]) {
                case "register":
                    $Controller->user->setUsername($data["username"]);
                    $Controller->user->setEmail($data["email"]);
                    $Controller->user->setPassword($data["password"]);
                    $response = $Controller->registerUser();
                    echo $response;
                    break;
                case "login":
                    $Controller->user->setEmail($data["email"]);
                    $Controller->user->setPassword($data["password"]);
                    $response = $Controller->getLogin();   
                    echo $response; // Ensure getLogin() returns JSON
                    break;
                default:
                    echo json_encode(["message" => "Action not found"]);
                    break;
            }
        } else {
            echo json_encode(["message" => "Action parameter is missing"]);
        }
        break; // Added break for POST

    default:
        echo json_encode(["message" => "Invalid request method."]);
        break;
}
?>