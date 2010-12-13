<?php

namespace Entities;

/**
 * Entities\Town
 *
 * @Table(name="town")
 * @Entity(repositoryClass="Mapper\Town")
 */
class Town
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
     * @var Province
     *
     * @ManyToOne(targetEntity="Province")
     * @JoinColumns({
     *   @JoinColumn(name="provinceId", referencedColumnName="id")
     * })
     */
    private $provinceid;

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
     * Set provinceid
     *
     * @param Province $provinceid
     */
    public function setProvinceid(\Province $provinceid)
    {
        $this->provinceid = $provinceid;
    }

    /**
     * Get provinceid
     *
     * @return Province $provinceid
     */
    public function getProvinceid()
    {
        return $this->provinceid;
    }

}