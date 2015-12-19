<?php

namespace GroupBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 * 
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="GroupBundle\Entity\GroupRepository")
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\UserGroupAssociation", mappedBy="group")
     */
    protected $user_group_associations;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

	/**
     * Add user_group_associations
     *
     * @param \UserBundle\Entity\UserGroupAssociation $userGroupAssociations
     * @return Group
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