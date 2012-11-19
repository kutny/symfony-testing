<?php

namespace Acme\HelloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="test_data")
 */
class TestEntity
{

	/**
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @Assert\MaxLength(3)
	 * @ORM\Column(type="string", length=3)
	 */
	protected $note;

	/**
	 * @ORM\Column(type="date")
	 */
	protected $dueDate;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $trueFalse;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $chooseItem;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $email;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return TestEntity
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return TestEntity
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    
        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set trueFalse
     *
     * @param boolean $trueFalse
     * @return TestEntity
     */
    public function setTrueFalse($trueFalse)
    {
        $this->trueFalse = $trueFalse;
    
        return $this;
    }

    /**
     * Get trueFalse
     *
     * @return boolean 
     */
    public function getTrueFalse()
    {
        return $this->trueFalse;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return TestEntity
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set chooseItem
     *
     * @param integer $chooseItem
     * @return TestEntity
     */
    public function setChooseItem($chooseItem)
    {
        $this->chooseItem = $chooseItem;
    
        return $this;
    }

    /**
     * Get chooseItem
     *
     * @return integer 
     */
    public function getChooseItem()
    {
        return $this->chooseItem;
    }
}