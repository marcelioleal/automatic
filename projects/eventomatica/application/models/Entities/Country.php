<?php

namespace Entities;

/**
 * Entities\Country
 *
 * @Table(name="country")
 * @Entity(repositoryClass="Mapper\Country")
 */
class Country
{
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     *
     * @Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string $sigla
     *
     * @Column(name="sigla", type="string", length=45, nullable=true)
     */
    private $sigla;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set sigla
     *
     * @param string $sigla
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }

    /**
     * Get sigla
     *
     * @return string $sigla
     */
    public function getSigla()
    {
        return $this->sigla;
    }

}