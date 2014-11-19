<?php

namespace Kamedon\Bundle\AndroidToolBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * StringResource
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kamedon\Bundle\AndroidToolBundle\Entity\StringResourceRepository")
 */
class StringResource
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
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=8, nullable=true)
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var StringResource
     * @ORM\ManyToOne(targetEntity="StringResource", inversedBy="strings")
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="StringResource", mappedBy="parent", cascade={"persist", "remove"})
     */
    private $strings;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->strings = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set lang
     *
     * @param string $lang
     * @return StringResource
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return StringResource
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Add strings
     *
     * @param \Kamedon\Bundle\AndroidToolBundle\Entity\StringResource $strings
     * @return StringResource
     */
    public function addString(\Kamedon\Bundle\AndroidToolBundle\Entity\StringResource $strings)
    {
        $this->strings[] = $strings;

        return $this;
    }

    /**
     * Remove strings
     *
     * @param \Kamedon\Bundle\AndroidToolBundle\Entity\StringResource $strings
     */
    public function removeString(\Kamedon\Bundle\AndroidToolBundle\Entity\StringResource $strings)
    {
        $this->strings->removeElement($strings);
    }

    /**
     * Get strings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStrings()
    {
        return $this->strings;
    }

    /**
     * Set parent
     *
     * @param \Kamedon\Bundle\AndroidToolBundle\Entity\StringResource $parent
     * @return StringResource
     */
    public function setParent(\Kamedon\Bundle\AndroidToolBundle\Entity\StringResource $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Kamedon\Bundle\AndroidToolBundle\Entity\StringResource
     */
    public function getParent()
    {
        return $this->parent;
    }
}
