<?php

namespace Entities;

/**
 * Entities\Address
 *
 * @Table(name="address")
 * @Entity(repositoryClass="Mapper\Address")
 */
class Address
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
     * @var string $street
     *
     * @Column(name="street", type="string", length=100, nullable=true)
     */
    private $street;

    /**
     * @var string $complement
     *
     * @Column(name="complement", type="string", length=100, nullable=true)
     */
    private $complement;

    /**
     * @var string $number
     *
     * @Column(name="number", type="string", length=5, nullable=true)
     */
    private $number;

    /**
     * @var string $postalcode
     *
     * @Column(name="postalCode", type="string", length=15, nullable=true)
     */
    private $postalcode;

    /**
     * @var Person
     *
     * @ManyToMany(targetEntity="Person", mappedBy="addressid")
     */
    private $personid;

    /**
     * @var Town
     *
     * @ManyToOne(targetEntity="Town")
     * @JoinColumns({
     *   @JoinColumn(name="townId", referencedColumnName="id")
     * })
     */
    private $townid;

}