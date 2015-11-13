<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $party;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $occupation = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $ethnicity = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $gender = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $education = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $location = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $registeredVoter = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $birthday = null;

    /**
     * @ORM\ManyToMany(targetEntity="Movement")
     */
    protected $movements;

    public function __construct()
    {
        parent::__construct();
        $this->movements = new ArrayCollection();
    }

    /**
     * Set party
     *
     * @param string $party
     *
     * @return User
     */
    public function setParty($party)
    {
        $this->party = $party;

        return $this;
    }

    /**
     * Get party
     *
     * @return string
     */
    public function getParty()
    {
        return $this->party;
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     *
     * @return User
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * Get occupation
     *
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set education
     *
     * @param string $education
     *
     * @return User
     */
    public function setEducation($education)
    {
        $this->education = $education;

        return $this;
    }

    /**
     * Get education
     *
     * @return string
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set ethnicity
     *
     * @param string $ethnicity
     *
     * @return User
     */
    public function setEthnicity($ethnicity)
    {
        $this->ethnicity = $ethnicity;

        return $this;
    }

    /**
     * Get ethnicity
     *
     * @return string
     */
    public function getEthnicity()
    {
        return $this->ethnicity;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return User
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set registeredVoter
     *
     * @param string $registeredVoter
     *
     * @return User
     */
    public function setRegisteredVoter($registeredVoter)
    {
        $this->registeredVoter = $registeredVoter;

        return $this;
    }

    /**
     * Get registeredVoter
     *
     * @return string
     */
    public function getRegisteredVoter()
    {
        return $this->registeredVoter;
    }

    /**
     * Set movements
     *
     * @param array $movements
     *
     * @return User
     */
    public function setMovements($movements)
    {
        $this->movements = $movements;

        return $this;
    }

    /**
     * Get movements
     *
     * @return array
     */
    public function getMovements()
    {
        return $this->movements;
    }

    /**
     * Add movement
     *
     * @param \AppBundle\Entity\Movement $movement
     *
     * @return User
     */
    public function addMovement(\AppBundle\Entity\Movement $movement)
    {
        $this->movements[] = $movement;

        return $this;
    }

    /**
     * Remove movement
     *
     * @param \AppBundle\Entity\Movement $movement
     */
    public function removeMovement(\AppBundle\Entity\Movement $movement)
    {
        $this->movements->removeElement($movement);
    }
}
