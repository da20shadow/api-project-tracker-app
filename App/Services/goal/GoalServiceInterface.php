<?php

namespace App\Services\goal;

interface GoalServiceInterface
{
    public function create(array $userInputs,$userInfo);
    public function updateTitle(array $userInputs,$userInfo);
    public function updateDescription(array $userInputs,$userInfo);
    public function updateDueDate(array $userInputs,$userInfo);
    public function delete(array $userInputs,$userInfo);
    public function getGoalById(array $userInputs,$userInfo);
    public function getUserGoalsByUserId(array $userInputs,$userInfo);
}