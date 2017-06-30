<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cosplay
 *
 * @ORM\Table(name="cosplay")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\CosplayRepository")
 */
class Cosplay
{
    /**
     * @ORM\OneToOne(targetEntity="CoreBundle\Entity\Invitation", inversedBy="cosplay")
     */
    private $invitation;

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
     * @return Cosplay
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
     * Set invitation
     *
     * @param \CoreBundle\Entity\Invitation $invitation
     *
     * @return Cosplay
     */
    public function setInvitation(\CoreBundle\Entity\Invitation $invitation = null)
    {
        $this->invitation = $invitation;

        return $this;
    }

    /**
     * Get invitation
     *
     * @return \CoreBundle\Entity\Invitation
     */
    public function getInvitation()
    {
        return $this->invitation;
    }
}
