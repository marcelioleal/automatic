<?php

namespace Entities;

/**
 * Entities\Place
 *
 * @Table(name="place")
 * @Entity(repositoryClass="Mapper\Place")
 */
class Place
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
     * @var string $description
     *
     * @Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @var string $type
     *
     * @Column(name="type", type="string", length=45, nullable=true)
     */
    private $type;

    /**
     * @var Address
     *
     * @ManyToOne(targetEntity="Address")
     * @JoinColumns({
     *   @JoinColumn(name="addressId", referencedColumnName="id")
     * })
     */
    private $addressid;

}