<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements AdvancedUserInterface
{
    /**
     * @ORM\OneToOne(targetEntity="CoreBundle\Entity\Cosplay", mappedBy="user")
     */
    private $cosplay;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Food", mappedBy="user")
     */
    private $food;

    /**
     * @ORM\OneToOne(targetEntity="CoreBundle\Entity\Event", mappedBy="eventOwner")
     * @ORM\JoinColumn(nullable=true)
     */
    private $eventOwner;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Invitation", mappedBy="user")
     */
    private $invitations;

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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, unique=true, nullable=true)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="token_expired_at", type="datetime", nullable=true)
     */
    private $tokenExpiredAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="UID", type="string", length=255, unique=true, nullable=true)
     */
    private $uid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $active = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_non_expired", type="boolean")
     */
    private $nonExpired = 1;


    /*********************************
     *       SETTER ET GETTER        *
     *********************************/

    public function __construct()
    {
        $this->active = true;
    }

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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set tokenExpiredAt
     *
     * @param \DateTime $tokenExpiredAt
     *
     * @return User
     */
    public function setTokenExpiredAt($tokenExpiredAt)
    {
        $this->tokenExpiredAt = $tokenExpiredAt;

        return $this;
    }

    /**
     * Get tokenExpiredAt
     *
     * @return \DateTime
     */
    public function getTokenExpiredAt()
    {
        return $this->tokenExpiredAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
     *
     * @ORM\PrePersist()
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();

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
     * @return User
     *
     * @ORM\PreUpdate()
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();

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

    /**
     * Set uid
     *
     * @param string $uid
     *
     * @return User
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set isActive
     *
     * @param boolean $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }


    public function getSalt()
    {
        return null;
    }


    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    public function isAccountNonExpired()
    {
        return $this->nonExpired;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->active;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->password,
            $this->username,
            $this->active,
            $this->nonExpired
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->password,
            $this->username,
            $this->active,
            $this->nonExpired
            ) = unserialize($serialized);
    }


    /**
     * Set nonExpired
     *
     * @param boolean $nonExpired
     *
     * @return User
     */
    public function setNonExpired($nonExpired)
    {
        $this->nonExpired = $nonExpired;

        return $this;
    }

    /**
     * Get isNonExpired
     *
     * @return boolean
     */
    public function isNonExpired()
    {
        return $this->nonExpired;
    }

    /**
     * Get nonExpired
     *
     * @return boolean
     */
    public function getNonExpired()
    {
        return $this->nonExpired;
    }

    /**
     * Add invitation
     *
     * @param \CoreBundle\Entity\Invitation $invitation
     *
     * @return User
     */
    public function addInvitation(\CoreBundle\Entity\Invitation $invitation)
    {
        $this->invitations[] = $invitation;

        return $this;
    }

    /**
     * Remove invitation
     *
     * @param \CoreBundle\Entity\Invitation $invitation
     */
    public function removeInvitation(\CoreBundle\Entity\Invitation $invitation)
    {
        $this->invitations->removeElement($invitation);
    }

    /**
     * Get invitations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvitations()
    {
        return $this->invitations;
    }

    /**
     * Set eventOwner
     *
     * @param \CoreBundle\Entity\Event $eventOwner
     *
     * @return User
     */
    public function setEventOwner(\CoreBundle\Entity\Event $eventOwner = null)
    {
        $this->eventOwner = $eventOwner;

        return $this;
    }

    /**
     * Get eventOwner
     *
     * @return \CoreBundle\Entity\Event
     */
    public function getEventOwner()
    {
        return $this->eventOwner;
    }

    /**
     * Set cosplay
     *
     * @param \CoreBundle\Entity\Cosplay $cosplay
     *
     * @return User
     */
    public function setCosplay(\CoreBundle\Entity\Cosplay $cosplay = null)
    {
        $this->cosplay = $cosplay;

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
     * Add food
     *
     * @param \CoreBundle\Entity\Food $food
     *
     * @return User
     */
    public function addFood(\CoreBundle\Entity\Food $food)
    {
        $this->food[] = $food;

        return $this;
    }

    /**
     * Remove food
     *
     * @param \CoreBundle\Entity\Food $food
     */
    public function removeFood(\CoreBundle\Entity\Food $food)
    {
        $this->food->removeElement($food);
    }

    /**
     * Get food
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFood()
    {
        return $this->food;
    }
}
