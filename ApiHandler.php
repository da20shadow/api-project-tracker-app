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

    }

    /** --> GOAL GET <-- */
    function processGoalGETRequest($userInputs, $goalService)
    {

    }


    /** ---------------- TASK Requests --------------- */

    /** --> TASK POST <-- */

    /** --> TASK PATCH <-- */

    /** --> TASK DELETE <-- */

    /** --> TASK GET <-- */


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