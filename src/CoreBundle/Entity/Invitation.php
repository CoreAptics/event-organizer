<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invitation
 *
 * @ORM\Table(name="invitation")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\InvitationRepository")
 */
class Invitation
{
    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Food", mappedBy="invitation")
     */
    private $foods;

    /**
     * @ORM\OneToOne(targetEntity="CoreBundle\Entity\Cosplay", mappedBy="invitation")
     */
    private $cosplay;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Event", inversedBy="invitations")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\User", inversedBy="invitations")
     */
    private $user;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sleep", type="boolean")
     */
    private $sleep = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;



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
     * Set event
     *
     * @param \CoreBundle\Entity\Event $event
     *
     * @return Invitation
     */
    public function setEvent(\CoreBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \CoreBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set user
     *
     * @param \CoreBundle\Entity\User $user
     *
     * @return Invitation
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
     * @return Invitation
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



    /**
     * Set cosplay
     *
     * @param \CoreBundle\Entity\Cosplay $cosplay
     *
     * @return Invitation
     */
    public function setCosplay(\CoreBundle\Entity\Cosplay $cosplay = null)
    {
        $this->cosplay = $cosplay;
        $cosplay->setInvitation($this);

        return $this;
    }

    /**
     * Get cosplay
     *
     * @return \CoreBundle\Entity\Cosplay
     */
    public function getCosplay()
    {
        return $this->cosplay;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Invitation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set sleep
     *
     * @param boolean $sleep
     *
     * @return Invitation
     */
    public function setSleep($sleep)
    {
        $this->sleep = $sleep;

        return $this;
    }

    /**
     * Get sleep
     *
     * @return boolean
     */
    public function getSleep()
    {
        return $this->sleep;
    }
}
