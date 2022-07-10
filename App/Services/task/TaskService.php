<?php

namespace App\Services\task;

use App\Models\goal\GoalDTO;
use App\Models\task\TaskDTO;
use App\Repositories\goal\GoalRepository;
use App\Repositories\task\TaskRepository;
use App\Repositories\task\TaskRepositoryInterface;
use Exception;

class TaskService implements TaskServiceInterface
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    /** -----------------CREATE-------------------- */

    /** CREATE New Task */
    public function create($userInputs, $userInfo)
    {
        if (!isset($userInputs['title']) || !isset($userInputs['goal_id'])) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Task title can not be empty!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        $title = $userInputs['title'];
        $goal_id = $userInputs['goal_id'];
        $user_id = $userInfo['id'];
        try {

            $task = TaskDTO::create($title, $goal_id, $user_id);
            isset($userInputs['description']) && $task->setDescription($userInputs['description']);
            isset($userInputs['priority']) && $task->setPriority($userInputs['priority']);
            isset($userInputs['status']) && $task->setStatus($userInputs['status']);
            isset($userInputs['due_date']) && $task->setDueDate($userInputs['due_date']);

        } catch (Exception $exception) {
            http_response_code(403);
            echo json_encode([
                'message' => $exception->getMessage()
            ], JSON_PRETTY_PRINT);
            return;
        }

        $goalRepository = new GoalRepository();
        $goalDTO = new GoalDTO();

        try {
            $goalDTO->setId($goal_id);
            $goalDTO->setUserId($user_id);
        } catch (Exception $exception) {
            http_response_code(403);
            echo json_encode([
                'message' => $exception->getMessage()
            ], JSON_PRETTY_PRINT);
            return;
        }

        $goalFromDb = $goalRepository->getGoalById($goalDTO);

        if (null === $goalFromDb) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Goal ID or User ID!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        $result = $this->taskRepository->insert($task);

        if (!$result) {
            http_response_code(403);
            echo json_encode([
                'message' => 'All fields are required!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'message' => 'Successfully Created New Task!'
        ], JSON_PRETTY_PRINT);
    }


    /** ------------------UPDATE-------------------- */

    /** UPDATE Title */
    public function updateTitle($userInputs, $userInfo)
    {
        if (!isset($userInputs['task_id'])) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        try {
            $user_id = $userInfo['id'];
            $task = new TaskDTO();
            $task->setId($userInputs['task_id']);
            $task->setTitle($userInputs['title']);
            $task->setUserId($user_id);
        } catch (Exception $exception) {
            $err = $exception->getMessage();
            http_response_code(403);
            echo json_encode(['message' => 'Error! ' . $err], JSON_PRETTY_PRINT);
            return;
        }

        if (!$this->taskExist($user_id, $task)) {
            return;
        }

        $result = $this->taskRepository->updateTitle($task);

        if (!$result) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'message' => 'Successfully Changed Task title!'
        ], JSON_PRETTY_PRINT);
    }

    /** UPDATE Description */
    public function updateDescription($userInputs, $userInfo)
    {
        if (!isset($userInputs['task_id'])) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        try {
            $user_id = $userInfo['id'];
            $task = new TaskDTO();
            $task->setId($userInputs['task_id']);
            $task->setDescription($userInputs['description']);
            $task->setUserId($user_id);
        } catch (Exception $exception) {
            $err = $exception->getMessage();
            http_response_code(403);
            echo json_encode(['message' => 'Error! ' . $err], JSON_PRETTY_PRINT);
            return;
        }

        if (!$this->taskExist($user_id, $task)) {
            return;
        }

        $result = $this->taskRepository->updateDescription($task);

        if (!$result) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'message' => 'Successfully Changed Task Description!'
        ], JSON_PRETTY_PRINT);
    }

    /** UPDATE Status */
    public function updateStatus($userInputs, $userInfo)
    {
        if (!isset($userInputs['task_id'])) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        try {
            $user_id = $userInfo['id'];
            $task = new TaskDTO();
            $task->setId($userInputs['task_id']);
            $task->setStatus($userInputs['status']);
            $task->setUserId($user_id);
        } catch (Exception $exception) {
            $err = $exception->getMessage();
            http_response_code(403);
            echo json_encode(['message' => 'Error! ' . $err], JSON_PRETTY_PRINT);
            return;
        }

        if (!$this->taskExist($user_id, $task)) {
            return;
        }

        $result = $this->taskRepository->updateStatus($task);

        if (!$result) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'message' => 'Successfully Changed Task Status!'
        ], JSON_PRETTY_PRINT);
    }

    /** UPDATE Progress */
    public function updateProgress($userInputs, $userInfo)
    {
        if (!isset($userInputs['task_id'])) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        try {
            $user_id = $userInfo['id'];
            $task = new TaskDTO();
            $task->setId($userInputs['task_id']);
            $task->setProgress($userInputs['progress']);
            $task->setUserId($user_id);
        } catch (Exception $exception) {
            $err = $exception->getMessage();
            http_response_code(403);
            echo json_encode(['message' => 'Error! ' . $err], JSON_PRETTY_PRINT);
            return;
        }

        if (!$this->taskExist($user_id, $task)) {
            return;
        }

        $result = $this->taskRepository->updateProgress($task);

        if (!$result) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'message' => 'Successfully Changed Task Progress!'
        ], JSON_PRETTY_PRINT);
    }

    /** UPDATE Priority */
    public function updatePriority($userInputs, $userInfo)
    {
        if (!isset($userInputs['task_id'])) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        try {
            $user_id = $userInfo['id'];
            $task = new TaskDTO();
            $task->setId($userInputs['task_id']);
            $task->setPriority($userInputs['priority']);
            $task->setUserId($user_id);
        } catch (Exception $exception) {
            $err = $exception->getMessage();
            http_response_code(403);
            echo json_encode(['message' => 'Error! ' . $err], JSON_PRETTY_PRINT);
            return;
        }

        if (!$this->taskExist($user_id, $task)) {
            return;
        }

        $result = $this->taskRepository->updatePriority($task);

        if (!$result) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'message' => 'Successfully Changed Task Priority!'
        ], JSON_PRETTY_PRINT);
    }

    /** UPDATE Due Date */
    public function updateDueDate($userInputs, $userInfo)
    {
        if (!isset($userInputs['task_id'])) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        try {
            $user_id = $userInfo['id'];
            $task = new TaskDTO();
            $task->setId($userInputs['task_id']);
            $task->setDueDate($userInputs['due_date']);
            $task->setUserId($user_id);
        } catch (Exception $exception) {
            $err = $exception->getMessage();
            http_response_code(403);
            echo json_encode(['message' => 'Error! ' . $err], JSON_PRETTY_PRINT);
            return;
        }

        if (!$this->taskExist($user_id, $task)) {
            return;
        }

        $result = $this->taskRepository->updateDueDate($task);

        if (!$result) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'message' => 'Successfully Changed Task Due Date!'
        ], JSON_PRETTY_PRINT);
    }

    /** UPDATE Task Goal ID */
    public function updateGoalId($userInputs, $userInfo)
    {
        if (!isset($userInputs['task_id'])) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Task ID!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        if ($userInputs['goal_id'] <= 0) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Goal!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        try {
            $user_id = $userInfo['id'];
            $task = new TaskDTO();
            $task->setId($userInputs['task_id']);
            $task->setGoalId($userInputs['goal_id']);
            $task->setUserId($user_id);
        } catch (Exception $exception) {
            $err = $exception->getMessage();
            http_response_code(403);
            echo json_encode(['message' => 'Error! ' . $err], JSON_PRETTY_PRINT);
            return;
        }

        if (!$this->taskExist($user_id, $task)) {
            return;
        }

        try {
            $goalRepository = new GoalRepository();
            $goalDTO = new GoalDTO();
            $goalDTO->setUserId($user_id);
            $goalDTO->setId($userInputs['goal_id']);
            $goalFromDb = $goalRepository->getGoalById($goalDTO);

        } catch (Exception $exception) {
            http_response_code(403);
            echo json_encode(['message' => 'Error! Invalid Goal'], JSON_PRETTY_PRINT);
            return;
        }

        if (null === $goalFromDb) {
            http_response_code(403);
            echo json_encode(['message' => 'Error! Such Goal Not Exist!'], JSON_PRETTY_PRINT);
            return;
        }

        $result = $this->taskRepository->updateGoalId($goalFromDb->getId(), $task);

        if (!$result) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'message' => 'Successfully Changed Task Goal!'
        ], JSON_PRETTY_PRINT);
    }


    /** ------------------DELETE-------------------- */

    public function delete($userInputs, $userInfo)
    {
        if (!isset($userInputs['task_id'])) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Task ID!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        if ($userInputs['task_id'] <= 0) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Goal ID!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        try {
            $task = new TaskDTO();
            $task->setId($userInputs['task_id']);
            $task->setUserId($userInfo['id']);
        } catch (Exception $exception) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! ' . $exception->getMessage()
            ], JSON_PRETTY_PRINT);
            return;
        }

        if (!$this->taskExist($task->getUserId(), $task)) {
            return;
        }

        $result = $this->taskRepository->delete($task);

        if (!$result) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Can not DELETE the task!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'message' => 'Successfully DELETED Task!'
        ], JSON_PRETTY_PRINT);
    }


    /** ------------------GET-------------------- */

    /** GET Single Task By Task ID and User ID */
    public function getTaskById($user_id, $task_id)
    {
        try {
            $task = new TaskDTO();
            $task->setId($task_id);
            $task->setUserId($user_id);
        } catch (Exception $exception) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! ' . $exception->getMessage()
            ], JSON_PRETTY_PRINT);
            return;
        }

        $taskFromDB = $this->taskRepository->getTaskById($task);

        if (null === $taskFromDB) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'id' => $taskFromDB->getId(),
            'title' => $taskFromDB->getTitle(),
            'description' => $taskFromDB->getDescription(),
            'priority' => $taskFromDB->getPriority(),
            'progress' => $taskFromDB->getProgress(),
            'status' => $taskFromDB->getStatus(),
            'dueDate' => $taskFromDB->getDueDate(),
            'createdOn' => $taskFromDB->getCreatedOn(),
            'userId' => $taskFromDB->getUserId(),
            'goalId' => $taskFromDB->getGoalId(),
        ], JSON_PRETTY_PRINT);
    }

    public function getTasksByGoalId($user_id, $goal_id)
    {
        $tasksGenerator = $this->taskRepository->getTasksByGoalId($user_id, $goal_id);

        if (null === $tasksGenerator)
        {
            http_response_code(403);
            echo json_encode(['message' => 'No Tasks Added Yet!'],JSON_PRETTY_PRINT);
            return;
        }

        $tasks = $this->generateTasksList($tasksGenerator);

        if (count($tasks) === 0)
        {
            http_response_code(403);
            echo json_encode(['message' => 'No Tasks Added Yet!'],JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode(['tasks' => $tasks],JSON_PRETTY_PRINT);
    }

    /** GET All Tasks By User ID */
    public function getTasksByUserId($user_id){
        $tasksGenerator = $this->taskRepository->getTasksByUserId($user_id);

        if (null === $tasksGenerator)
        {
            http_response_code(403);
            echo json_encode(['message' => 'No Tasks Added Yet!'],JSON_PRETTY_PRINT);
            return;
        }

        $tasks = $this->generateTasksList($tasksGenerator);

        if (count($tasks) === 0)
        {
            http_response_code(403);
            echo json_encode(['message' => 'No Tasks Added Yet!'],JSON_PRETTY_PRINT);
            return;
        }

        http_response_code(200);
        echo json_encode(['tasks' => $tasks],JSON_PRETTY_PRINT);
    }

    /** ---------------VALIDATORS AND GENERATORS--------------- */

    private function generateTasksList($tasksGenerator): array
    {
        $tasks = [];
        foreach ($tasksGenerator as $task) {
            array_push($tasks, [
                'id' => $task->getId(),
                'title' => $task->getTitle(),
                'description' => $task->getDescription(),
                'priority' => $task->getPriority(),
                'progress' => $task->getProgress(),
                'status' => $task->getStatus(),
                'dueDate' => $task->getDueDate(),
                'createdOn' => $task->getCreatedOn(),
                'userId' => $task->getUserId(),
                'goalId' => $task->getGoalId(),
            ]);
        }
        return $tasks;
    }

    private function taskExist($user_id, TaskDTO $taskDTO): bool
    {
        $taskFromDb = $this->taskRepository->getTaskById($taskDTO);

        if (null === $taskFromDb) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Task ID or User ID!'
            ], JSON_PRETTY_PRINT);
            return false;
        }

        if ($user_id !== $taskFromDb->getUserId()) {
            http_response_code(403);
            echo json_encode([
                'message' => 'Error! Invalid Request!'
            ], JSON_PRETTY_PRINT);
            return false;
        }
        return true;
    }
}