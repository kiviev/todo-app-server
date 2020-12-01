<?php


namespace NexTyres\Task\Domain\Contracts;


use NexTyres\Task\Domain\TaskEntity;

interface ITaskRepository
{
    public function list(bool $orderByPriority);

    public function view($id);

    public function save(TaskEntity $entity);

    public function delete($id);

}
