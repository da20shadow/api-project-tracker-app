<?php

use App\Services\goal\GoalService;
use App\Services\user\UserService;

spl_autoload_register();
header('Content-Type: application/json');

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}


$url = str_replace('api-goals-app/', '', $_SERVER['REQUEST_URI']);
$inputData = json_decode(file_get_contents('php://input'), true);
$apiHandler = new ApiHandler();

/** ---------------- USER API Requests ------------- */
// api url -> /users/
if (preg_match("/^\/users[\/]?$/", $url))
{
    $userService = new UserService();
    /** LOGIN / REGISTER */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData)
    {
        $apiHandler->processUserPOSTRequest($inputData,$userService);
    }
    /** UPDATE user */
    elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH' && $inputData)
    {
        $apiHandler->processUserPATCHRequest($inputData,$userService);
    }
    /** GET user */
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $inputData)
    {
        $apiHandler->processUserGETRequest($inputData,$userService);
    }
    /** DELETE User */
    elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $inputData)
    {
        $apiHandler->processUserDELETERequest($inputData,$userService);
    }
}

/** ---------------- GOAL API Requests ------------- */
// api url -> /goals/
else if (preg_match("/^\/goals[\/]?$/", $url))
{
    $goalService = new GoalService();
    /** CREATE Goal */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData)
    {
        $apiHandler->processGoalPOSTRequest($inputData,$goalService);
    }
    /** UPDATE Goal */
    elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH' && $inputData)
    {
        $apiHandler->processGoalPATCHRequest($inputData,$goalService);
    }
    /** GET Goal */
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $inputData)
    {
        $apiHandler->processGoalDELETERequest($inputData,$goalService);
    }
    /** DELETE Goal */
    elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $inputData)
    {
        $apiHandler->processGoalGETRequest($inputData,$goalService);
    }
}

/** ---------------- TASK API Requests ------------- */


/** ---------------- SUBTASK API Requests ------------- */


/** ---------------- IDEA API Requests ------------- */

else{
    echo json_encode(['message' => 'Invalid API Request!']);
}