<?php

namespace App\Models\goal;

use App\Services\validator\InputValidator;
use Exception;

class GoalDTO
{
    private int $id;
    private string $title;
    private string $description;
    private int $category;
    private int $userId;
    private $createdOn;
    private $dueDate;

    /**
     * @throws Exception
     */
    public static function create($title, $description, $category, $userId, $dueDate): GoalDTO
    {
        return (new GoalDTO())
            ->setTitle($title)
            ->setDescription($description)
            ->setCategory($category)
            ->setUserId($userId)
            ->setDueDate($dueDate);
    }


    /**
     * @throws Exception
     */
    public function setId(int $id): GoalDTO
    {
        if (!is_numeric($id)){
            throw new Exception('Invalid Goal ID');
        }

        if ($id <= 0){
            throw new Exception('Invalid Goal ID');
        }

        $id = InputValidator::validateStringInput($id);

        $this->id = $id;
        return $this;
    }


    /**
     * @throws Exception
     */
    public function setTitle(string $title): GoalDTO
    {
        if (!isset($title)){
            throw new Exception('Title can not be empty!');
        }
        if (!preg_match("/^[\w\s!@#%&($ )=,.?£€\/-]{5,255}$/",$title))
        {
            throw new Exception('Invalid Characters In Title!'.$title);
        }

        $title = InputValidator::validateStringInput($title);

        $this->title = $title;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setDescription(string $description): GoalDTO
    {
        if (!isset($description)){
            $description = 'Description Goes Here..';
        }

        if (!preg_match("/^[\w\s!@#%&()=><,.?£$ €\/-]{2,}$/",$description))
        {
            throw new Exception('Invalid Characters In Description!');
        }

        $description = InputValidator::validateStringInput($description);

        $this->description = $description;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setCategory(int $category): GoalDTO
    {
        if (!isset($category))
        {
            throw new Exception('Category can not be empty!');
        }

        if ($category <= 0 || $category > 3)
        {
            throw new Exception('Invalid Category!');
        }

        $category = InputValidator::validateStringInput($category);

        $this->category = $category;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setUserId(int $userId): GoalDTO
    {
        if (!isset($userId))
        {
            throw new Exception('UserId can not be empty!');
        }

        if (!is_numeric($userId))
        {
            throw new Exception('Invalid UserId!');
        }

        if ($userId <= 0){
            throw new Exception('Invalid User ID');
        }

        $userId = InputValidator::validateStringInput($userId);

        $this->userId = $userId;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function setDueDate($dueDate): GoalDTO
    {
        if (!isset($dueDate))
        {
            throw new Exception('Due Date can not be empty!');
        }

        $isValid = InputValidator::isDateValid($dueDate);

        //TODO: Validate the DATE Format!

        if (!$isValid){
            throw new Exception('Invalid Due Date!');
        }

        $this->dueDate = $dueDate;
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
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }


}