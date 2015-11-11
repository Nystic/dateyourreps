<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="movements")
 */
class Movement
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
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $motto;

    /**
     * @ORM\Column(type="array")
     */
    protected $movers = 'a:0:{}';    

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Movement
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set motto
     *
     * @param string $motto
     *
     * @return Movement
     */
    public function setMotto($motto)
    {
        $this->motto = $motto;

        return $this;
    }

    /**
     * Get motto
     *
     * @return string
     */
    public function getMotto()
    {
        return $this->motto;
    }

    /**
     * Set movers
     *
     * @param array $movers
     *
     * @return Movement
     */
    public function setMovers($movers)
    {
        $this->movers = $movers;

        return $this;
    }

    /**
     * Get movers
     *
     * @return array
     */
    public function getMovers()
    {
        return $this->movers;
    }
}
