<?php

use App\Services\goal\GoalService;
use App\Services\task\TaskService;
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
    {   //TODO
        $apiHandler->processUserPATCHRequest($inputData,$userService);
    }
    /** GET user */
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $inputData)
    {   //TODO
        $apiHandler->processUserGETRequest($inputData,$userService);
    }
    /** DELETE User */
    elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $inputData)
    {   //TODO
        $apiHandler->processUserDELETERequest($inputData,$userService);
    }
}


/** ---------------- GOAL API Requests ------------- */

/** CREATE, UPDATE, DELETE
 * @returns {message}
 */
// api url -> /goals/
else if (preg_match("/^\/goals[\/]?$/", $url))
{
    $goalService = new GoalService();

    /** CREATE Goal POST
     * @expected: (token,title,description,due_date,user_id)!
     */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData)
    {
        $apiHandler->processGoalPOSTRequest($inputData,$goalService);
    }
    /** UPDATE Goal PATCH
     * @expected: (token, user_id, title OR description OR due_date OR Category)!
     */
    elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH' && $inputData)
    {
        $apiHandler->processGoalPATCHRequest($inputData,$goalService);
    }
    /** DELETE Goal
     * @expected: (token, goal_id, user_id)!
     */
    elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $inputData)
    {
        $apiHandler->processGoalDELETERequest($inputData,$goalService);
    }

}
/** GET Single Goal By Goal ID
 * @returns {id,title,description,category,userId,createdOn,dueDate}
 */
// api url -> /goals/1
else if (preg_match("/^\/goals\/\d+$/", $url))
{
    $goal_id = str_replace('/goals/','',$url);
    $goalService = new GoalService();

    /** GET Goal By ID POST
     * @expect (token)
     */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData)
    {
        $apiHandler->processGETSingleGoalRequest($inputData, $goal_id,$goalService);
    }
}
/** GET ALL Goals By User ID
 * @returns {goals => [{id,title,description,category,userId,createdOn,dueDate},{id....}}
 */
// api url -> /goals/user/7
else if (preg_match("/^\/goals\/user\/\d+$/", $url))
{
    $user_id = str_replace('/goals/user/','',$url);
    $goalService = new GoalService();

    /** GET Goal By ID POST
     * @expect (token)
     */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData)
    {
        $apiHandler->processGETAllGoalsRequest($inputData, $user_id, $goalService);
    }

}


/** ---------------- TASK API Requests ------------- */

/** CREATE, UPDATE, DELETE
 * @returns {message}
 */
//api url -> /tasks/
else if (preg_match("/^\/tasks[\/]?$/",$url))
{
    $taskService = new TaskService();
    /** CREATE New Task POST
     * @expected: [token,title,goal_id AND IF description,due_date,priority,status OK]!
     */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData)
    {
        $apiHandler->taskPOSTRequest($inputData,$taskService);
    }
    /** UPDATE Task PATCH
     * @expected: [token,task_id title OR description OR due_date OR progress OR priority OR status OR goal_id]!
     */
    else if ($_SERVER['REQUEST_METHOD'] === 'PATCH' && $inputData)
    {
        $apiHandler->taskPATCHRequest($inputData,$taskService);
    }
    /** DELETE Task
     * @expected: [token,task_id]!
     */
    else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $inputData)
    {
        $apiHandler->taskDELETERequest($inputData,$taskService);
    }
}
//api url -> /tasks/1
/** GET Single Task By Task ID
 * @returns {id,title,description,due_date,created_on,priority,status,goal_id,user_id}
 */
else if (preg_match("/^\/tasks\/\d+$/",$url))
{
    $taskService = new TaskService();
    $task_id = str_replace('/tasks/','',$url);
    /** GET Task By Task ID
     * @expected: [token]!
     */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData)
    {
        $apiHandler->taskGETSingleTaskRequest($inputData,$task_id,$taskService);
    }
}
//api url -> /tasks/goal/1
/** GET ALL Tasks By Goal ID
 * @returns {tasks: [{id,title,description,due_date,created_on,priority,status,goal_id,user_id},{id,title...}]}
 */
else if (preg_match("/^\/tasks\/goal\/\d+$/",$url))
{
    $taskService = new TaskService();
    $goal_id = str_replace('/tasks/goal/','',$url);
    /** GET ALL Task By GOAL ID
     * @expected: [token]!
     */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData)
    {
        $apiHandler->taskGETAllTasksRequest($inputData,$goal_id,$taskService);
    }
}


/** ---------------- SUBTASK API Requests ------------- */


/** ---------------- IDEA API Requests ------------- */

else{
    echo json_encode(['message' => 'Invalid API Request!']);
}