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
    public static function create($title,$goalId,$userId): TaskDTO
    {
        return (new TaskDTO())
            ->setTitle($title)
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

        if ($title === ''){
            throw new Exception('Title can not be empty!');
        }

        $this->title = $title;
        return $this;
    }

    /**
     * @param string $description
     * * @return TaskDTO
     * @throws Exception
     */
    public function setDescription(string $description): TaskDTO
    {
        if (!isset($description)){
            throw new Exception('Error! Empty Description!');
        }

        $description = InputValidator::validateStringInput($description);

        if ($description === ''){
            $description = 'Task Description...';
        }

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
            throw new Exception('Error! Empty Progress!');
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
            throw new Exception('Error! Empty Priority!');
        }

        if (!is_numeric($priority)){
            throw new Exception('Invalid Priority Not int!');
        }

        if ($priority < 1 || $priority > 5){
            throw new Exception('Invalid Priority! ' . $priority);
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
            throw new Exception('Error! Empty Status!');
        }

        if (!is_numeric($status)){
            throw new Exception('Invalid Status!');
        }

        if ($status < 1 || $status > 4){
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
        if (!isset($this->id)){
            return false;
        }
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        if (!isset($this->title)){
            return false;
        }
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        if (!isset($this->description)){
            return false;
        }
        return $this->description;
    }

    /**
     * @return int
     */
    public function getProgress(): int
    {
        if (!isset($this->progress)){
            return false;
        }
        return $this->progress;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        if (!isset($this->priority)){
            return false;
        }
        return $this->priority;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        if (!isset($this->status)){
            return false;
        }
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getDueDate(): mixed
    {
        if (!isset($this->dueDate)){
            return false;
        }
        return $this->dueDate;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn(): mixed
    {
        if (!isset($this->createdOn)){
            return false;
        }
        return $this->createdOn;
    }

    /**
     * @return int
     */
    public function getGoalId(): int
    {
        if (!isset($this->goalId)){
            return false;
        }
        return $this->goalId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        if (!isset($this->userId)){
            return false;
        }
        return $this->userId;
    }



}