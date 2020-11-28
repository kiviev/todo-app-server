<?php

namespace NexTyres\Task\Application;

use NexTyres\Task\Domain\Contracts\ITaskRepository;
use NexTyres\Task\Domain\TaskEntity;

class TaskUseCase
{
    /**
     * @var ITaskRepository
     */
    private $repository;

    public function __construct(ITaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listAction(bool $orderedByPriority = true)
    {
        return $this->repository->list($orderedByPriority);
    }

    public function find($id)
    {
        return $this->repository->view($id);
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

    public function save(TaskEntity $entity)
    {
        return $this->repository->save($entity);
    }

}
