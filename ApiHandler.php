<?php

use App\Services\user\UserService;

spl_autoload_register();

class ApiHandler
{
    /** ---------------- USER Requests --------------- */

    /** --> USER POST <-- */
    public function processUserPOSTRequest($userInputs, UserService $userService)
    {
        /** LOGIN User */
        if (count($userInputs) == 2) {
            $userService->login($userInputs);
        } /** CREATE User */
        else {
            $userService->register($userInputs);
        }
    }

    /** --> USER PATCH <-- */
    public function processUserPATCHRequest($userInputs, UserService $userService)
    {
        //TODO: update user info
        http_response_code(200);
        echo json_encode([
            'message' => 'Update user Not Done Yet!',
            'Your Input' => $userInputs
        ]);
    }

    /** --> USER DELETE <-- */
    public function processUserDELETERequest($userInputs, UserService $userService)
    {
        //TODO: DELETE user
        http_response_code(200);
        echo json_encode([
            'message' => 'Delete user Not Done Yet!',
            'Your Input' => $userInputs
        ]);
    }

    /** --> USER GET <-- */
    public function processUserGETRequest($userInputs, UserService $userService)
    {
        //TODO: GET user
        http_response_code(200);
        echo json_encode([
            'message' => 'Get user Not Done Yet!',
            'Your Input' => $userInputs
        ]);
    }


    /** ---------------- GOAL Requests --------------- */

    /** --> GOAL POST <-- */
    function processGoalPOSTRequest($userInputs, $goalService)
    {
        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }
        $goalService->create($userInputs, $userInfo);
    }

    /** --> GOAL PATCH <--- */
    function processGoalPATCHRequest($userInputs, $goalService)
    {
        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }

        if (isset($userInputs['title'])) {

            $goalService->updateTitle($userInputs,$userInfo);

        } elseif (isset($userInputs['description'])) {

            $goalService->updateDescription($userInputs,$userInfo);

        } elseif (isset($userInputs['due_date'])) {

            $goalService->updateDueDate($userInputs,$userInfo);

        }elseif (isset($userInputs['category'])) {

            $goalService->updateCategory($userInputs,$userInfo);

        }else {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Input!'
            ],JSON_PRETTY_PRINT);
        }
    }

    /** --> GOAL DELETE <-- */
    function processGoalDELETERequest($userInputs, $goalService)
    {
        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }
        $goalService->delete($userInputs,$userInfo);
    }

    /** --> GOAL GET Single Goal <-- */
    function processGETSingleGoalRequest($userInputs, $goal_id,$goalService)
    {
        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }
        $goalService->getGoalById($userInfo['id'],$goal_id);
    }
    /** --> GOAL GET Single Goal <-- */
    public function processGETAllGoalsRequest($userInputs, $user_id, $goalService)
    {
        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }
        if ($user_id != $userInfo['id']){
            http_response_code(403);
            echo json_encode(['message' => 'Invalid Request!']);
            return;
        }

        $goalService->getGoalsByUserId($user_id);
    }


    /** ---------------- TASK Requests --------------- */

    /** --> CREATE TASK POST <-- */
    public function taskPOSTRequest($userInputs,$taskService)
    {
        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }
        $taskService->create($userInputs,$userInfo);
    }

    /** --> UPDATE TASK PATCH <-- */
    public function taskPATCHRequest($userInputs,$taskService)
    {
        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }

        if (isset($userInputs['title']))
        {
            $taskService->updateTitle($userInputs, $userInfo);
        }
        else if (isset($userInputs['description']))
        {
            $taskService->updateDescription($userInputs, $userInfo);
        }
        else if (isset($userInputs['status']))
        {
            $taskService->updateStatus($userInputs, $userInfo);
        }
        else if (isset($userInputs['progress']))
        {
            $taskService->updateProgress($userInputs, $userInfo);
        }
        else if (isset($userInputs['priority']))
        {
            $taskService->updatePriority($userInputs, $userInfo);
        }
        else if (isset($userInputs['due_date']))
        {
            $taskService->updateDueDate($userInputs, $userInfo);
        }
        else if (isset($userInputs['goal_id']))
        {
            $taskService->updateGoalId($userInputs, $userInfo);
        }else {
            http_response_code(403);
            echo json_encode(['message' => 'Invalid Request!']);
        }
    }

    /** --> TASK DELETE <-- */
    public function taskDELETERequest($userInputs,$taskService)
    {
        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }

        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }
        $taskService->delete($userInputs,$userInfo);
    }

    /** --> TASK GET Single Task By ID <-- */
    public function taskGETSingleTaskRequest($userInputs,$task_id,$taskService)
    {
        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }
        $taskService->getTaskById($userInfo['id'],$task_id);
    }

    /** --> TASK GET All Tasks With Goal ID <-- */
    public function taskGETAllTasksRequest($userInputs,$goal_id,$taskService)
    {
        $userInfo = $this->validateToken($userInputs);
        if (null === $userInfo){
            return;
        }
        $taskService->getTasksByGoalId($userInfo['id'],$goal_id);
    }


    /** -------------- SUBTASK Requests --------------- */

    /** --> SUBTASK POST <-- */

    /** --> SUBTASK PATCH <-- */

    /** --> SUBTASK DELETE <-- */

    /** --> SUBTASK GET <-- */


    /** ---------------- IDEA Requests --------------- */

    /** -- IDEA POST <-- */

    /** -- IDEA PATCH <-- */

    /** -- IDEA DELETE <-- */

    /** -- IDEA GET <-- */

    /** --------------TOKEN VALIDATION-------------- */
    private function validateToken($userInputs): ?array
    {
        if (!isset($userInputs['token'])) {
            http_response_code(403);
            echo json_encode(['message' => 'Invalid Token!'], JSON_PRETTY_PRINT);
            return null;
        }

        $accessToken = $userInputs['token'];
        $userInfo = null;
        try {
            $userInfo = AuthValidator::verifyToken($accessToken);
        } catch (Exception $e) {
            //TODO: log the error
            $error = $e->getMessage();
            http_response_code(403);
            echo json_encode(['message' => 'Invalid or Expired Token!'], JSON_PRETTY_PRINT);
        }
        return $userInfo;
    }
}