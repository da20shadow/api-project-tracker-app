<?php

namespace App\Repositories\task;

use App\Models\task\TaskDTO;
use Generator;

interface TaskRepositoryInterface
{
    public function insert(TaskDTO $taskDTO):bool|TaskDTO;
    public function updateTitle(TaskDTO $taskDTO):bool;
    public function updateDescription(TaskDTO $taskDTO):bool;
    public function updateStatus(TaskDTO $taskDTO):bool;
    public function updateProgress(TaskDTO $taskDTO):bool;
    public function updatePriority(TaskDTO $taskDTO):bool;
    public function updateDueDate(TaskDTO $taskDTO):bool;
    public function updateGoalId(int $newGoalId,TaskDTO $taskDTO):bool;
    public function delete(TaskDTO $taskDTO):bool;
    public function getTaskById(TaskDTO $taskDTO):?TaskDTO;
    public function getTasksByGoalId(int $user_id,int $goal_id):?Generator;
}