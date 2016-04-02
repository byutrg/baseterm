<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Description of Language
 *
 * @author James Hayes <james.s.hayes@gmail.com>
 * @ORM\Entity
 */
class Language
{
    /**
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    
    /**
     *
     * @ORM\Column(type="string", length=15)
     */
    protected $codes;

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
     * Set name
     *
     * @param string $name
     * @return Language
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
     * Set codes
     *
     * @param string $codes
     * @return Language
     */
    public function setCodes($codes)
    {
        $this->codes = $codes;

        return $this;
    }

    /**
     * Get codes
     *
     * @return string 
     */
    public function getCodes()
    {
        return $this->codes;
    }

	/**
	 * Override toString() method to return the name of the group
	 * @return string name
	 */
	public function __toString()
	{
		return $this->name;
	}

}
