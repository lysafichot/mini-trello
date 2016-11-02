<?php

namespace AppBundle\Entity;

/**
 * Task
 */
class Task
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var string
     */
    private $name;



    /**
     * @var Task
     */
    private $subtasks;
    
    private $createdAt;

    private $updatedAt;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->subtasks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add subtask
     *
     * @param \AppBundle\Entity\Task $subtask
     *
     * @return Task
     */
    public function addSubtask(\AppBundle\Entity\Task $subtask)
    {
        $this->subtasks[] = $subtask;

        return $this;
    }

    /**
     * Remove subtask
     *
     * @param \AppBundle\Entity\Task $subtask
     */
    public function removeSubtask(\AppBundle\Entity\Task $subtask)
    {
        $this->subtasks->removeElement($subtask);
    }

    /**
     * Get subtasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubtasks()
    {
        return $this->subtasks;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Task
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }



    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Task
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Task
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
