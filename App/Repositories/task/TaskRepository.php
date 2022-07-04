<?php

namespace App\Repositories\task;

use App\Models\task\TaskDTO;
use Database\DBConnector;
use Database\PDODatabase;
use Generator;
use PDOException;

class TaskRepository implements TaskRepositoryInterface
{
    private PDODatabase $db;

    public function __construct()
    {
        $this->db = DBConnector::create();
    }

    /** -----------------CREATE-------------------- */

    public function insert(TaskDTO $taskDTO): bool
    {
        $description = $taskDTO->getDescription() ?: 'Task Description...';
        $dueDate = $taskDTO->getDueDate() ?: '0000-00-00';
        $status = $taskDTO->getStatus() ?: 3;
        $priority = $taskDTO->getPriority() ?: 5;

        try {
            $this->db->query("
            INSERT INTO tasks 
            (task_title, task_description, due_date, status,priority, goal_id, user_id)
            VALUES (:title,:description,:due_date,:status,:priority,:goal_id, :user_id)
        ")->execute(array(
                ':title' => $taskDTO->getTitle(),
                ':description' => $description,
                ':due_date' => $dueDate,
                ':status' => $status,
                ':priority' => $priority,
                ':goal_id' => $taskDTO->getGoalId(),
                ':user_id' => $taskDTO->getUserId(),
            ));
            return true;
        } catch (PDOException $PDOException) {
            $pdoError = $PDOException->getMessage();
            //TODO: Log the errors
            return false;
        }
    }


    /** -----------------UPDATE-------------------- */

    public function updateTitle(TaskDTO $taskDTO): bool
    {
        // TODO: Implement updateTitle() method.
    }

    public function updateDescription(TaskDTO $taskDTO): bool
    {
        // TODO: Implement updateDescription() method.
    }

    public function updateStatus(TaskDTO $taskDTO): bool
    {
        // TODO: Implement updateStatus() method.
    }

    public function updateProgress(TaskDTO $taskDTO): bool
    {
        // TODO: Implement updatePriority() method.
    }

    public function updatePriority(TaskDTO $taskDTO): bool
    {
        // TODO: Implement updatePriority() method.
    }

    public function updateDueDate(TaskDTO $taskDTO): bool
    {
        // TODO: Implement updateDueDate() method.
    }

    public function updateGoalId(int $newGoalId, TaskDTO $taskDTO): bool
    {
        // TODO: Implement updateGoalId() method.
    }


    /** -----------------DELETE-------------------- */

    public function delete(TaskDTO $taskDTO): bool
    {
        // TODO: Implement delete() method.
    }


    /** -----------------GET-------------------- */

    public function getTaskById(TaskDTO $taskDTO): ?TaskDTO
    {
        // TODO: Implement getTaskById() method.
    }

    public function getTasksByGoalId(int $goal_id): ?Generator
    {
        // TODO: Implement getTasksByGoalId() method.
    }
}