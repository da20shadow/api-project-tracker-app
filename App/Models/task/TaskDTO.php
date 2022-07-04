<?php

namespace App\Models\task;

use App\Services\validator\InputValidator;
use Exception;

class TaskDTO
{
    private int $id;
    private string $title;
    private string $description;
    private int $progress;
    private int $priority;
    private int $status;
    private mixed $dueDate;
    private mixed $createdOn;
    private int $goalId;
    private int $userId;

    /**
     * @throws Exception
     */
    public static function create($title, $description, $priority, $status, $dueDate, $goalId, $userId): TaskDTO
    {
        return (new TaskDTO())
            ->setTitle($title)
            ->setDescription($description)
            ->setPriority($priority)
            ->setStatus($status)
            ->setDueDate($dueDate)
            ->setGoalId($goalId)
            ->setUserId($userId);
    }

    /**
     * @param int $id
     * @return TaskDTO
     */
    public function setId(int $id): TaskDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $title
     * @return TaskDTO
     * @throws Exception
     */
    public function setTitle(string $title): TaskDTO
    {
        if (!isset($title)){
            throw new Exception('Title can not be empty!');
        }

        if (strlen($title) < 3 || strlen($title) > 255){
            throw new Exception('Invalid Title length Must be between (3-255)!');
        }

        $title = InputValidator::validateStringInput($title);

        $this->title = $title;
        return $this;
    }

    /**
     * @param string $description
     * * @return TaskDTO
     */
    public function setDescription(string $description): TaskDTO
    {
        if (!isset($description)){
            $description = 'Task Description...';
        }

        $description = InputValidator::validateStringInput($description);

        $this->description = $description;
        return $this;
    }

    /**
     * @param int $progress
     * * @return TaskDTO
     * @throws Exception
     */
    public function setProgress(int $progress): TaskDTO
    {
        if (!isset($progress)){
            $progress = 0;
        }

        if (!is_numeric($progress)){
            throw new Exception('Invalid Progress!');
        }

        $progress = InputValidator::validateStringInput($progress);

        $this->progress = $progress;
        return $this;
    }

    /**
     * @param int $priority
     * * @return TaskDTO
     * @throws Exception
     */
    public function setPriority(int $priority): TaskDTO
    {
        if (!isset($priority)){
            $priority = 5;
        }

        if (!is_numeric($priority)){
            throw new Exception('Invalid Priority!');
        }

        $priority = InputValidator::validateStringInput($priority);

        $this->priority = $priority;
        return $this;
    }

    /**
     * @param int $status
     * * @return TaskDTO
     * @throws Exception
     */
    public function setStatus(int $status): TaskDTO
    {
        if (!isset($status)){
            $status = 3;
        }

        if (!is_numeric($status)){
            throw new Exception('Invalid Status!');
        }

        $status = InputValidator::validateStringInput($status);

        $this->status = $status;
        return $this;
    }

    /**
     * @param mixed $dueDate
     * * @return TaskDTO
     * @throws Exception
     */
    public function setDueDate(mixed $dueDate): TaskDTO
    {
        if (!isset($dueDate)){
            throw new Exception('Invalid Due Date!');
        }

        //TODO validate Date Format!!!
         $isValid = InputValidator::isDateValid($dueDate);

        if (!$isValid){
            throw new Exception('Invalid Due Date!');
        }

        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @param mixed $createdOn
     * * @return TaskDTO
     */
    public function setCreatedOn(mixed $createdOn): TaskDTO
    {
        $this->createdOn = $createdOn;
        return $this;
    }

    /**
     * @param int $goalId
     * * @return TaskDTO
     * @throws Exception
     */
    public function setGoalId(int $goalId): TaskDTO
    {
        if (!isset($goalId)){
            throw new Exception('Invalid Goal ID!');
        }

        if (!is_numeric($goalId)){
            throw new Exception('Invalid Goal ID!');
        }

        $goalId = InputValidator::validateStringInput($goalId);

        $this->goalId = $goalId;
        return $this;
    }

    /**
     * @param int $userId
     * * @return TaskDTO
     * @throws Exception
     */
    public function setUserId(int $userId): TaskDTO
    {
        if (!isset($userId)){
            throw new Exception('Invalid User ID!');
        }

        if (!is_numeric($userId)){
            throw new Exception('Invalid User ID!');
        }

        $userId = InputValidator::validateStringInput($userId);

        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getProgress(): int
    {
        return $this->progress;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getDueDate(): mixed
    {
        return $this->dueDate;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn(): mixed
    {
        return $this->createdOn;
    }

    /**
     * @return int
     */
    public function getGoalId(): int
    {
        return $this->goalId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }



}