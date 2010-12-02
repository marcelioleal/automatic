<?php

namespace Entities;

/**
 * Entities\Event
 *
 * @Table(name="event")
 * @Entity(repositoryClass="Mapper\Event")
 */
class Event
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
     * @var datetime $createdat
     *
     * @Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdat;

    /**
     * @var integer $type
     *
     * @Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var Participantrole
     *
     * @ManyToMany(targetEntity="Participantrole", inversedBy="eventid")
     * @JoinTable(name="eventparticipantrole",
     *   joinColumns={
     *     @JoinColumn(name="eventId", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="participantRoleId", referencedColumnName="id")
     *   }
     * )
     */
    private $participantroleid;

    /**
     * @var Customer
     *
     * @ManyToOne(targetEntity="Customer")
     * @JoinColumns({
     *   @JoinColumn(name="customerId", referencedColumnName="id")
     * })
     */
    private $customerid;

}