<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FoodType
 *
 * @ORM\Table(name="food_type")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\FoodTypeRepository")
 */
class FoodType
{
    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Food", mappedBy="type")
     */
    private $foods;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     *
     * @return FoodType
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
     * Constructor
     */
    public function __construct()
    {
        $this->foods = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add food
     *
     * @param \CoreBundle\Entity\Food $food
     *
     * @return FoodType
     */
    public function addFood(\CoreBundle\Entity\Food $food)
    {
        $this->foods[] = $food;

        return $this;
    }

    /**
     * Remove food
     *
     * @param \CoreBundle\Entity\Food $food
     */
    public function removeFood(\CoreBundle\Entity\Food $food)
    {
        $this->foods->removeElement($food);
    }

    /**
     * Get foods
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFoods()
    {
        return $this->foods;
    }
}
