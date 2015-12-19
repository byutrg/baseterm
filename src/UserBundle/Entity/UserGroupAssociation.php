<?php

namespace UserBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

/**
 * UserGroupAssociation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UserBundle\Entity\UserGroupAssociationRepository")
 */
class UserGroupAssociation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     **/
 
    /**
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user_Group_associations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $user;
 
    /**
     *
     * @ORM\ManyToOne(targetEntity="GroupBundle\Entity\Group", inversedBy="user_Group_associations")
     * @ORM\JoinColumn(name="Group_id", referencedColumnName="id")
     */
    private $Group;
 
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
     * Set user
     *
     * @param UserBundle\Entity\User $user
     * @return UserGroupAssociation
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
 
        return $this;
    }
 
    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
 
    /**
     * Set group
     *
     * @param \GroupBundle\Entity\Group $Group
     * @return UserGroupAssociation
     */
    public function setGroup(\GroupBundle\Entity\Group $Group = null)
    {
        $this->Group = $Group;
 
        return $this;
    }
 
    /**
     * Get group
     *
     * @return \GroupBundle\Entity\Group
     */
    public function getGroup()
    {
        return $this->Group;
    }
}