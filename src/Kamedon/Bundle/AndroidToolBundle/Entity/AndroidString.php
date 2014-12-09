<?php

namespace Kamedon\Bundle\AndroidToolBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * AndroidString
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kamedon\Bundle\AndroidToolBundle\Entity\AndroidStringRepository")
 */
class AndroidString
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
     * @ORM\Column(name="lang", type="string", length=10)
     */
    private $lang;


    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=1024)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="AndroidString", mappedBy="parent", cascade={"persist", "remove"})
     */
    private $translations;

    /**
     * @var AndroidString
     * @ORM\ManyToOne(targetEntity="AndroidString", inversedBy="translations")
     */
    private $parent;

    /** @var string */
    private $attr;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return AndroidString
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
     * @return AndroidString
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AndroidString
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return AndroidString
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add translations
     *
     * @param \Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString $translations
     * @return AndroidString
     */
    public function addTranslation(\Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString $translations)
    {
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString $translations
     */
    public function removeTranslation(\Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString $translations)
    {
        $this->translations->removeElement($translations);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Set parent
     *
     * @param \Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString $parent
     * @return AndroidString
     */
    public function setParent(\Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param string $attr
     */
    public function setAttr($attr)
    {
        $this->attr = $attr;
    }

    /**
     * @return string
     */
    public function getAttr()
    {
        return $this->attr;
    }
}
