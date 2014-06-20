<?php

namespace Becool\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Becool\Bundle\MainBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
{
     /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    //-----------------------------------------
    // Partie nécéssaire à l'authentification -
    //-----------------------------------------

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=160)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    //-------------------------------------------------
    // Partie Informations générales de l'utilisateur -
    //-------------------------------------------------
    
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=120)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=120)
     */
    private $prenom;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth", type="date")
     */
    private $birth;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=1)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50)
     */
    private $ville;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="smallint")
     */
    private $level;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_point", type="integer")
     */
    private $totalPoint;

    /**
     * @var integer
     *
     * @ORM\Column(name="temp_point", type="integer")
     */
    private $tempPoint;
    
    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="mesAmis")
     */
    private $amisAvecMoi;
    
    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="amisAvecMoi")
     * @ORM\JoinTable(name="friends",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
     *      )
     */
    private $mesAmis;
    
    //---------------------------
    // Constructeur de l'entité -
    //---------------------------
    
    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
        $this->amisAvecMoi = new \Doctrine\Common\Collections\ArrayCollection();
        $this->mesAmis = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    //---------------------
    // Getters et Setters -
    //---------------------

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }
    
    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

   /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }


    /**
     * Set nom
     *
     * @param string $nom
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set birth
     *
     * @param \DateTime $birth
     * @return User
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;

        return $this;
    }

    /**
     * Get birth
     *
     * @return \DateTime 
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return User
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set totalPoint
     *
     * @param integer $totalPoint
     * @return User
     */
    public function setTotalPoint($totalPoint)
    {
        $this->totalPoint = $totalPoint;

        return $this;
    }

    /**
     * Get totalPoint
     *
     * @return integer 
     */
    public function getTotalPoint()
    {
        return $this->totalPoint;
    }

    /**
     * Set tempPoint
     *
     * @param integer $tempPoint
     * @return User
     */
    public function setTempPoint($tempPoint)
    {
        $this->tempPoint = $tempPoint;

        return $this;
    }

    /**
     * Get tempPoint
     *
     * @return integer 
     */
    public function getTempPoint()
    {
        return $this->tempPoint;
    }

    /**
     * Add amisAvecMoi
     *
     * @param \Becool\Bundle\MainBundle\Entity\User $amisAvecMoi
     * @return User
     */
    public function addAmisAvecMoi(\Becool\Bundle\MainBundle\Entity\User $amisAvecMoi)
    {
        $this->amisAvecMoi[] = $amisAvecMoi;

        return $this;
    }

    /**
     * Remove amisAvecMoi
     *
     * @param \Becool\Bundle\MainBundle\Entity\User $amisAvecMoi
     */
    public function removeAmisAvecMoi(\Becool\Bundle\MainBundle\Entity\User $amisAvecMoi)
    {
        $this->amisAvecMoi->removeElement($amisAvecMoi);
    }

    /**
     * Get amisAvecMoi
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAmisAvecMoi()
    {
        return $this->amisAvecMoi;
    }

    /**
     * Add mesAmis
     *
     * @param \Becool\Bundle\MainBundle\Entity\User $mesAmis
     * @return User
     */
    public function addMesAmi(\Becool\Bundle\MainBundle\Entity\User $mesAmis)
    {
        $this->mesAmis[] = $mesAmis;

        return $this;
    }

    /**
     * Remove mesAmis
     *
     * @param \Becool\Bundle\MainBundle\Entity\User $mesAmis
     */
    public function removeMesAmi(\Becool\Bundle\MainBundle\Entity\User $mesAmis)
    {
        $this->mesAmis->removeElement($mesAmis);
    }

    /**
     * Get mesAmis
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMesAmis()
    {
        return $this->mesAmis;
    }
}
