<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 12/07/18
 * Time: 16:48
 */

namespace Anaxago\CoreBundle\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"user"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"user"})
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"user"})
     */
    private $lastName;

    /**
     * @var array
     * @ORM\Column(type="array")
     * @Groups({"user"})
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"password"})
     */
    private $password;

    /**
     * @var string
     * @Groups({"password"})
     */
    private $plainPassword;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user"})
     */
    private $salt;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"user"})
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"user"})
     */
    private $email;

    /**
     * @var Investment
     * @ORM\OneToMany(targetEntity="Anaxago\CoreBundle\Entity\Investment", mappedBy="user")
     * @Groups({"investments"})
     */
    private $investments;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->investments = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->firstName.' '.$this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     *
     * @return string[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param array $roles
     *
     * @return User
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @param string $role
     *
     * @return User
     */
    public function addRoles(string $role): User
    {
        if (!\in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword(string $plainPassword): User
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @param string $salt
     *
     * @return User
     */
    public function setSalt(string $salt): User
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email): User
    {
        // email will be our username
        $this->username = $email;
        $this->email = $email;

        return $this;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    /**
     * @return Investment[]|[]
     */
    public function getInvestments()
    {
        return $this->investments->toArray();
    }

    public function addInvestment(Investment $investment)
    {
        if (!in_array($investment, $this->getInvestments(), true))
        {
            $this->investments->add($investment);
        }
        return $this->investments;
    }

    public function removeInvestment(Investment $investment)
    {
        if (in_array($investment, $this->getInvestments(), true))
        {
            $this->investments->removeElement($investment);
        }
        return $this->investments->toArray();
    }
}
