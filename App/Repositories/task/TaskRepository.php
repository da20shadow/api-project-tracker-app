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

    /** UPDATE Task Title */
    public function updateTitle(TaskDTO $taskDTO): bool
    {
        try {
            $this->db->query("
            UPDATE tasks
            SET task_title = :title
            WHERE task_id = :task_id AND user_id = :user_id
        ")->execute(array(
                ':title' => $taskDTO->getTitle(),
                ':task_id' => $taskDTO->getId(),
                ':user_id' => $taskDTO->getUserId()
            ));
            return true;
        }catch (PDOException $PDOException){
            $err = $PDOException->getMessage();
            //TODO log errors
            return false;
        }
    }

    public function updateDescription(TaskDTO $taskDTO): bool
    {
        try {
            $this->db->query("
            UPDATE tasks
            SET task_description = :description
            WHERE task_id = :task_id AND user_id = :user_id
        ")->execute(array(
                ':description' => $taskDTO->getDescription(),
                ':task_id' => $taskDTO->getId(),
                ':user_id' => $taskDTO->getUserId()
            ));
            return true;
        }catch (PDOException $PDOException){
            $err = $PDOException->getMessage();
            //TODO log errors
            return false;
        }
    }

    public function updateStatus(TaskDTO $taskDTO): bool
    {
        try {
            $this->db->query("
            UPDATE tasks
            SET status = :status
            WHERE task_id = :task_id AND user_id = :user_id
        ")->execute(array(
                ':status' => $taskDTO->getStatus(),
                ':task_id' => $taskDTO->getId(),
                ':user_id' => $taskDTO->getUserId()
            ));
            return true;
        }catch (PDOException $PDOException){
            $err = $PDOException->getMessage();
            //TODO log errors
            return false;
        }
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
        $task = null;
        try {
            $task= $this->db->query("
            SELECT task_id AS id,
                   task_title AS title,
                   task_description AS description,
                   priority,
                   progress,
                   status, 
                   due_date AS dueDate, 
                   created_on AS createdOn,
                   goal_id AS goalId, 
                   user_id AS userId
            FROM tasks
            WHERE task_id = :task_id AND user_id = :user_id
        ")->execute(array(
                ':task_id' => $taskDTO->getId(),
                ':user_id' => $taskDTO->getUserId()
            ))->fetch(TaskDTO::class)
                ->current();

        }catch (PDOException $PDOException){
            $err = $PDOException->getMessage();
            //TODO log errors
        }
        return $task;
    }

    public function getTasksByGoalId(int $goal_id): ?Generator
    {
        // TODO: Implement getTasksByGoalId() method.
    }
}