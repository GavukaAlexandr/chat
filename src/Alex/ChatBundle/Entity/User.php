<?php

namespace Alex\ChatBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Alex\ChatBundle\Repository\UserRepository")
 */
class User extends BaseUser implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var $lastOnline
     * @ORM\Column(type="datetime")
     */
    protected $lastOnline;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'name' => $this->getUsername(),
        ];
        // TODO: Implement jsonSerialize() method.
    }

    /**
     * Set lastOnline
     *
     * @param \DateTime $lastOnline
     *
     * @return User
     */
    public function setLastOnline($lastOnline)
    {
        $this->lastOnline = $lastOnline;

        return $this;
    }

    /**
     * Get lastOnline
     *
     * @return \DateTime
     */
    public function getLastOnline()
    {
        return $this->lastOnline;
    }
}
