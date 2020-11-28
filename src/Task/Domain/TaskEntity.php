<?php
namespace NexTyres\Task\Domain;

class TaskEntity implements \JsonSerializable
{

    private $id;
    private $title;
    private $description;
    private $priority;

    public function __construct($id, $title, $description, $priority)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->priority = $priority;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority): void
    {
        $this->priority = $priority;
    }

    public function jsonSerialize()
    {
       return [
           'id' => $this->getId(),
           'tittle' => $this->getTitle(),
           'description' => $this->getDescription(),
           'priority' => $this->getPriority(),
       ];
    }
}
