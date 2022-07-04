<?php

namespace App\Repositories\goal;

use App\Models\goal\GoalDTO;
use Generator;

interface GoalRepositoryInterface
{
    public function insert(GoalDTO $goalDTO): bool;
    public function updateTitle(GoalDTO $goalDTO): bool;
    public function updateDescription(GoalDTO $goalDTO): bool;
    public function updateDueDate(GoalDTO $goalDTO): bool;
    public function delete(GoalDTO $goalDTO): bool;
    public function getGoalById(GoalDTO $goalDTO): ?GoalDTO;
    public function getGoalsByUserId(int $user_id): ?Generator;
}