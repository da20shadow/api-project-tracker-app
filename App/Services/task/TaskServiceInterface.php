<?php

namespace App\Services\task;

interface TaskServiceInterface
{
    public function create($userInputs, $userInfo);

    public function updateTitle($userInputs, $userInfo);

    public function updateDescription($userInputs, $userInfo);

    public function updateStatus($userInputs, $userInfo);

    public function updatePriority($userInputs, $userInfo);

    public function updateProgress($userInputs, $userInfo);

    public function updateDueDate($userInputs, $userInfo);

    public function updateGoalId($userInputs, $userInfo);

    public function delete($userInputs, $userInfo);

    public function getTaskById($user_id, $task_id);

    public function getTasksByGoalId($user_id,$goal_id);
}