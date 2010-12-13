<?php

namespace Entities;

/**
 * Entities\Customer
 *
 * @Table(name="customer")
 * @Entity(repositoryClass="Mapper\Customer")
 */
class Customer
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
     * @var smallint $status
     *
     * @Column(name="status", type="smallint", nullable=true)
     */
    private $status;

    /**
     * @var datetime $begin
     *
     * @Column(name="begin", type="datetime", nullable=true)
     */
    private $begin;

    /**
     * @var datetime $end
     *
     * @Column(name="end", type="datetime", nullable=true)
     */
    private $end;

    /**
     * @var Contract
     *
     * @ManyToOne(targetEntity="Contract")
     * @JoinColumns({
     *   @JoinColumn(name="contractId", referencedColumnName="id")
     * })
     */
    private $contractid;

    /**
     * @var Person
     *
     * @ManyToOne(targetEntity="Person")
     * @JoinColumns({
     *   @JoinColumn(name="personId", referencedColumnName="id")
     * })
     */
    private $personid;

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
     * Set status
     *
     * @param smallint $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return smallint $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set begin
     *
     * @param datetime $begin
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;
    }

    /**
     * Get begin
     *
     * @return datetime $begin
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Set end
     *
     * @param datetime $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * Get end
     *
     * @return datetime $end
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set contractid
     *
     * @param Contract $contractid
     */
    public function setContractid(\Contract $contractid)
    {
        $this->contractid = $contractid;
    }

    /**
     * Get contractid
     *
     * @return Contract $contractid
     */
    public function getContractid()
    {
        return $this->contractid;
    }

    /**
     * Set personid
     *
     * @param Person $personid
     */
    public function setPersonid(\Person $personid)
    {
        $this->personid = $personid;
    }

    /**
     * Get personid
     *
     * @return Person $personid
     */
    public function getPersonid()
    {
        return $this->personid;
    }

}