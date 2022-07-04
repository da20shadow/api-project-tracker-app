<?php

namespace App\Services\goal;

use App\Repositories\goal\GoalRepository;
use App\Repositories\goal\GoalRepositoryInterface;

class GoalService implements GoalServiceInterface
{
    private GoalRepositoryInterface $goalRepository;

    public function __construct()
    {
        $this->goalRepository = new GoalRepository();
    }

    /** ----------------CREATE-------------------- */
    public function create(array $userInputs,$userInfo)
    {
        // TODO: Implement create() method.
    }

    /** ----------------UPDATE-------------------- */
    public function updateTitle(array $userInputs,$userInfo)
    {
        // TODO: Implement updateTitle() method.
    }

    public function updateDescription(array $userInputs,$userInfo)
    {
        // TODO: Implement updateDescription() method.
    }

    public function updateDueDate(array $userInputs,$userInfo)
    {
        // TODO: Implement updateDueDate() method.
    }

    /** ----------------DELETE-------------------- */
    public function delete(array $userInputs,$userInfo)
    {
        // TODO: Implement delete() method.
    }

    /** ----------------GET-------------------- */
    public function getGoalById(array $userInputs,$userInfo)
    {
        // TODO: Implement getGoalById() method.
    }

    public function getUserGoalsByUserId(array $userInputs,$userInfo)
    {
        // TODO: Implement getUserGoalsByUserId() method.
    }
}