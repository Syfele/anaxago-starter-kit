<?php

namespace Anaxago\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * InvestmentHelper
 *
 * @ORM\Table(name="investisment")
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\InvestmentRepository")
 */
class Investment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     * @Groups({"investments"})
     */
    private $amount;

    /**
     * @var User $user
     * @ORM\ManyToOne(targetEntity="Anaxago\CoreBundle\Entity\User", inversedBy="investments")
     * @Groups({"user"})
     */
    private $user;


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
     * Set amount
     *
     * @param integer $amount
     *
     * @return Investisment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Investment
     */
    public function setUser(User $user): Investment
    {
        $this->user = $user;
        return $this;
    }
}

