<?php

namespace App\Repositories\goal;

use App\Models\goal\GoalDTO;
use Database\DBConnector;
use Database\PDODatabase;
use Generator;
use PDOException;

class GoalRepository implements GoalRepositoryInterface
{
    private PDODatabase $db;

    public function __construct()
    {
        $this->db = DBConnector::create();
    }

    /** ----------------------CREATE---------------------- */
    public function insert(GoalDTO $goalDTO): bool
    {
        try {
            $this->db->query("
                INSERT INTO goals
                (goal_title,goal_description,due_date,user_id,goal_category)
                VALUES (:title,:description,:due_date,:user_id,:category)
            ")->execute(array(
                'title' => $goalDTO->getTitle(),
                'description' => $goalDTO->getDescription(),
                'due_date' => $goalDTO->getDueDate(),
                'user_id' => $goalDTO->getUserId(),
                ':category' => $goalDTO->getCategory()
            ));
            return true;
        } catch (PDOException $PDOException) {
            $pdoError = $PDOException->getMessage();
            //TODO log the error
            return false;
        }
    }

    public function updateTitle(GoalDTO $goalDTO): bool
    {
        try {
            $this->db->query("
                UPDATE goals
                SET goal_title = :title
                WHERE goal_id = :id AND user_id = :user_id
            ")->execute(array(
                ':id' => $goalDTO->getId(),
                ':user_id' => $goalDTO->getUserId(),
                ':title' => $goalDTO->getTitle(),
            ));
            return true;
        }catch (PDOException $PDOException){
            $err = $PDOException->getMessage();
            //LOG the errors
            return false;
        }
    }

    /** ---------------------------UPDATE--------------------------- */
    public function updateDescription(GoalDTO $goalDTO): bool
    {
        // TODO: Implement updateDescription() method.
    }

    public function updateDueDate(GoalDTO $goalDTO): bool
    {
        // TODO: Implement updateDueDate() method.
    }

    /** --------------------------DELETE-------------------------- */
    public function delete(GoalDTO $goalDTO): bool
    {
        // TODO: Implement delete() method.
    }

    /** ----------------------------GET---------------------------- */
    public function getGoalById(GoalDTO $goalDTO): ?GoalDTO
    {
        $goal = null;
        try {
            $goal = $this->db->query("
                SELECT goal_id AS id,
                        goal_title AS title,
                        goal_description AS description,
                        goal_category AS category,
                        user_id AS userId,
                        created_on AS createdOn,
                        due_date AS dueDate
                    FROM goals
                    WHERE goal_id = :id AND user_id = :user_id
            ")->execute(array(
                'id' => $goalDTO->getId(),
                'user_id' => $goalDTO->getUserId()
            ))->fetch(GoalDTO::class)
                ->current();
        }catch (PDOException $PDOException){
            $err = $PDOException->getMessage();
            //TODO log the errors
        }
        return $goal;
    }

    public function getGoalsByUserId(int $user_id): ?Generator
    {
        // TODO: Implement getGoalsByUserId() method.
    }
}