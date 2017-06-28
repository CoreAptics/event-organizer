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
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
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
     * Set status
     *
     * @param boolean $status
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
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
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
}
