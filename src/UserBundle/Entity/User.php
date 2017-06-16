<?php
/*
 *  This file is part of BaseTerm.
 *  
 *  BaseTerm is an open-source and free to use terminology management system built with the primary goal of natively supporting the most popular TBX dialect for exchange, TBX-Basic
 *  
 *  Copyright © (2015-2017) BYU TRG & LTAC Global & CRITI
 *  
 *  See the LICENSE file that accompanied this source code for the full license
 *  information
 */
// src/AppBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="baseterm_user")
 * @UniqueEntity(fields="usernameCanonical", errorPath="username", message="fos_user.username.already_used")
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="email", column=@ORM\Column(type="string", name="email", length=255, unique=false, nullable=true)),
 *      @ORM\AttributeOverride(name="emailCanonical", column=@ORM\Column(type="string", name="email_canonical", length=255, unique=false, nullable=true))
 * })
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
	 * @var boolean
	 * @ORM\Column(type="boolean", options={"default":1})
	 */
	private $showTips;
	
	 /**
     * @ORM\OneToMany(targetEntity="UserGroupAssociation", mappedBy="user")
     */
    protected $user_group_associations;

	/**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
    */
    protected $fullUserName;
	
	/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $personId;
	
    public function __construct()
    {
        parent::__construct();
        
		$this->showTips = true;

    }
	
	public function getPersonId()
	{
		return $this->personId;
	}
	
	public function setPersonId($string)
	{
		$this->personId = $string;
		
		return $this;
	}
	
	public function getFullUserName()
	{
		return $this->fullUserName;
	}
	
	public function setFullUserName($string)
	{
		$this->fullUserName = $string;
		
		return $this;
	}
	
	public function getShowTips()
	{
		return $this->showTips;
	}
	
	public function setShowTips($boolean)
	{
		$this->showTips = $boolean;
		
		return $this;
	}

	/**
     * Add user_group_associations
     *
     * @param \UserBundle\Entity\UserGroupAssociation $userGroupAssociations
     * @return User
     */
    public function addUserGroupAssociation(\UserBundle\Entity\UserGroupAssociation $userGroupAssociations)
    {
        $this->user_group_associations[] = $userGroupAssociations;
 
        return $this;
    }
 
    /**
     * Remove user_group_associations
     *
     * @param \UserBundle\Entity\UserGroupAssociation $userGroupAssociations
     */
    public function removeUserGroupAssociation(\UserBundle\Entity\UserGroupAssociation $userGroupAssociations)
    {
        $this->user_group_associations->removeElement($userGroupAssociations);
    }
 
    /**
     * Get user_group_associations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserGroupAssociations()
    {
        return $this->user_group_associations;
    }
}