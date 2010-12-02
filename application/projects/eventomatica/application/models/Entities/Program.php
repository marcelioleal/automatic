<?php

namespace Entities;

/**
 * Entities\Program
 *
 * @Table(name="program")
 * @Entity(repositoryClass="Mapper\Program")
 */
class Program
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
     * @Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @var Event
     *
     * @ManyToOne(targetEntity="Event")
     * @JoinColumns({
     *   @JoinColumn(name="eventId", referencedColumnName="id")
     * })
     */
    private $eventid;

    /**
     * @var Place
     *
     * @ManyToOne(targetEntity="Place")
     * @JoinColumns({
     *   @JoinColumn(name="placeId", referencedColumnName="id")
     * })
     */
    private $placeid;

}