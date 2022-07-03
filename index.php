<?php
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
// api url -> /user/
if (preg_match("/^\/user[\/]?$/", $url))
{
    $userService = 1;
    /** LOGIN / REGISTER */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData)
    {
        $apiHandler->processUserPOSTRequest($inputData);
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH' && $inputData)
    {
        $apiHandler->processUserPATCHRequest($inputData);
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $inputData)
    {
        $apiHandler->processUserGETRequest($inputData);
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $inputData)
    {
        $apiHandler->processUserDELETERequest($inputData);
    }
}

/** ---------------- GOAL API Requests ------------- */


/** ---------------- TASK API Requests ------------- */


/** ---------------- SUBTASK API Requests ------------- */


/** ---------------- IDEA API Requests ------------- */

else{
    echo json_encode(['message' => 'Invalid API Request!']);
}