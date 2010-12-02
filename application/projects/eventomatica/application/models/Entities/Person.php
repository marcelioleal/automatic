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

}