<?php

namespace Entities;

/**
 * Entities\Person
 *
 * @Table(name="person")
 * @Entity(repositoryClass="Mapper\Person")
 */
class Person
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
     * @var string $type
     *
     * @Column(name="type", type="string", length=3, nullable=true)
     */
    private $type;

    /**
     * @var datetime $createdat
     *
     * @Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdat;

    /**
     * @var integer $status
     *
     * @Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var Address
     *
     * @ManyToMany(targetEntity="Address", inversedBy="personid")
     * @JoinTable(name="personaddress",
     *   joinColumns={
     *     @JoinColumn(name="personId", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="addressId", referencedColumnName="id")
     *   }
     * )
     */
    private $addressid;

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
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set createdat
     *
     * @param datetime $createdat
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
    }

    /**
     * Get createdat
     *
     * @return datetime $createdat
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return integer $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add addressid
     *
     * @param Address $addressid
     */
    public function addAddressid(\Address $addressid)
    {
        $this->addressid[] = $addressid;
    }

    /**
     * Get addressid
     *
     * @return Doctrine\Common\Collections\Collection $addressid
     */
    public function getAddressid()
    {
        return $this->addressid;
    }

}