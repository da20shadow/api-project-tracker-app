<?php

use App\Models\user\UserDTO;
use App\Services\user\UserService;

spl_autoload_register();

class ApiHandler
{
    /** ---------------- USER Requests --------------- */

    /** --> USER POST <-- */
    public function processUserPOSTRequest($userInputs, UserService $userService)
    {
        /** LOGIN User */
        if (count($userInputs) == 2)
        {
            $userService->login($userInputs);
        }
        /** CREATE User */
        else {
            $userService->create($userInputs);
        }
    }

    /** --> USER PATCH <-- */
    public function processUserPATCHRequest($userInputs,UserService $userService)
    {
        //TODO: update user info
        http_response_code(200);
        echo json_encode([
            'message' =>'Update user Not Done Yet!',
            'Your Input' => $userInputs
        ]);
    }

    /** --> USER DELETE <-- */
    public function processUserDELETERequest($userInputs,UserService $userService)
    {
        //TODO: DELETE user
        http_response_code(200);
        echo json_encode([
            'message' =>'Delete user Not Done Yet!',
            'Your Input' => $userInputs
        ]);
    }

    /** --> USER GET <-- */
    public function processUserGETRequest($userInputs,UserService $userService)
    {
        //TODO: GET user
        http_response_code(200);
        echo json_encode([
            'message' =>'Get user Not Done Yet!',
            'Your Input' => $userInputs
        ]);
    }


    /** ---------------- GOAL Requests --------------- */

    /** --> GOAL POST <-- */

    /** --> GOAL PATCH <--- */

    /** --> GOAL DELETE <-- */

    /** --> GOAL GET <-- */


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
}