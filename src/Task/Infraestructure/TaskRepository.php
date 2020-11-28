<?php


namespace NexTyres\Task\Infraestructure;


use NexTyres\database\FileDatabase;
use NexTyres\Task\Domain\Contracts\ITaskRepository;
use NexTyres\Task\Domain\TaskEntity;

class TaskRepository implements ITaskRepository
{
    /**
     * @var FileDatabase
     */
    private $db;

    public function __construct()
    {
        $this->db = FileDatabase::instance();
    }

    /**
     * @param bool $orderByPriority
     * @return TaskEntity[]
     */
    public function list(bool $orderByPriority = true)
    {
        $list = $this->db::getList();
        if($orderByPriority) {
            $list = $this->orderByPriority($list);
        }

        return $list;
    }

    /**
     * @param $id
     * @return TaskEntity
     */
    public function view($id)
    {
        return $this->db::find($id);
    }


    /**
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->db::delete($id);
    }

    /**
     * @param TaskEntity[] $list
     * @return TaskEntity[]
     */
    public function orderByPriority($list)
    {

        usort($list, function(TaskEntity $inputA, TaskEntity $inputB){
            $Apriority = $inputA->getPriority();
            $Bpriority = $inputB->getPriority();

            if($Apriority === $Bpriority){
                return 0;
            }
            return ($Apriority < $Bpriority) ? 1 : -1;
        });

        return $list;
    }

    public function save(TaskEntity $entity)
    {
        if($entity->getId()){
            // edit Task
            $this->delete($entity->getId());
            $result = $this->db::add($entity);
        }else {
            // new Task
            $lastId = $this->db::nextId();
            $entity->setId($lastId);
            $result = $this->db::add($entity);
        }

        if(!$result){
            return false;
        }

        return $entity;
    }

}
