<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Food
 *
 * @ORM\Table(name="food")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\FoodRepository")
 */
class Food
{
    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\User", inversedBy="foods")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\FoodType", inversedBy="foods")
     */
    private $type;

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
     * @var int
     *
     * @ORM\Column(name="nb", type="integer")
     */
    private $nb;


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
     * @return Food
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
     * Set nb
     *
     * @param integer $nb
     *
     * @return Food
     */
    public function setNb($nb)
    {
        $this->nb = $nb;

        return $this;
    }

    /**
     * Get nb
     *
     * @return int
     */
    public function getNb()
    {
        return $this->nb;
    }

    /**
     * Set type
     *
     * @param \CoreBundle\Entity\FoodType $type
     *
     * @return Food
     */
    public function setType(\CoreBundle\Entity\FoodType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \CoreBundle\Entity\FoodType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     *
     * @param \CoreBundle\Entity\User $user
     *
     * @return Food
     */
    public function setUser(\CoreBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoreBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
