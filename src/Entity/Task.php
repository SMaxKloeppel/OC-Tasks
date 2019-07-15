<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $todo;

    /**
     * @ORM\Column(type="text")
     */
    private $details;


    public function getId() {
        return $this->id;
    }
    public function getTodo() {
        return $this->todo;
    }
    public function setTodo($todo) {
        $this->todo = $todo;
    }
    public function getDetails() {
        return $this->details;
    }
    public function setDetails($details) {
        $this->details = $details;
    }
}
