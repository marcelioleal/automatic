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

}