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


    /** ---------------------------UPDATE--------------------------- */

    /** UPDATE Title */
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
            //TODO LOG the errors
            return false;
        }
    }
    /** UPDATE Description */
    public function updateDescription(GoalDTO $goalDTO): bool
    {
        try {
            $this->db->query("
                UPDATE goals
                SET goal_description = :description
                WHERE goal_id = :id AND user_id = :user_id
            ")->execute(array(
                ':id' => $goalDTO->getId(),
                ':user_id' => $goalDTO->getUserId(),
                ':description' => $goalDTO->getDescription(),
            ));
            return true;
        }catch (PDOException $PDOException){
            $err = $PDOException->getMessage();
            //TODO LOG the errors
            return false;
        }
    }
    /** UPDATE Due Date */
    public function updateDueDate(GoalDTO $goalDTO): bool
    {
        try {
            $this->db->query("
                UPDATE goals
                SET due_date = :due_date
                WHERE goal_id = :id AND user_id = :user_id
            ")->execute(array(
                ':id' => $goalDTO->getId(),
                ':user_id' => $goalDTO->getUserId(),
                ':due_date' => $goalDTO->getDueDate(),
            ));
            return true;
        }catch (PDOException $PDOException){
            $err = $PDOException->getMessage();
            //TODO LOG the errors
            return false;
        }
    }
    /** UPDATE Category */
    public function updateCategory(GoalDTO $goalDTO): bool
    {
        try {
            $this->db->query("
                UPDATE goals
                SET goal_category = :category
                WHERE goal_id = :id AND user_id = :user_id
            ")->execute(array(
                ':id' => $goalDTO->getId(),
                ':user_id' => $goalDTO->getUserId(),
                ':category' => $goalDTO->getCategory(),
            ));
            return true;
        }catch (PDOException $PDOException){
            $err = $PDOException->getMessage();
            //TODO LOG the errors
            return false;
        }
    }

    /** --------------------------DELETE-------------------------- */
    public function delete(GoalDTO $goalDTO): bool
    {
        try {
            $this->db->query("
                DELETE
                FROM goals
                WHERE goal_id = :id AND user_id = :user_id
            ")->execute(array(
                ':id' => $goalDTO->getId(),
                ':user_id' => $goalDTO->getUserId(),
            ));
            return true;
        }catch (PDOException $PDOException){
            $err = $PDOException->getMessage();
            //TODO LOG the errors
            return false;
        }
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