<?php

namespace App\Repositories\goal;

use App\Models\goal\GoalDTO;
use Generator;

class GoalRepository implements GoalRepositoryInterface
{

    public function insert(GoalDTO $goalDTO): bool
    {
        // TODO: Implement insert() method.
    }

    public function updateTitle(GoalDTO $goalDTO): bool
    {
        // TODO: Implement updateTitle() method.
    }

    public function updateDescription(GoalDTO $goalDTO): bool
    {
        // TODO: Implement updateDescription() method.
    }

    public function updateDueDate(GoalDTO $goalDTO): bool
    {
        // TODO: Implement updateDueDate() method.
    }

    public function delete(GoalDTO $goalDTO): bool
    {
        // TODO: Implement delete() method.
    }

    public function getGoalById(int $goal_id): GoalDTO
    {
        // TODO: Implement getGoalById() method.
    }

    public function getGoalsByUserId(int $user_id): Generator
    {
        // TODO: Implement getGoalsByUserId() method.
    }
}