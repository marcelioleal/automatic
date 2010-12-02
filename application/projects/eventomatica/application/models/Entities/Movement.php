<?php

namespace Entities;

/**
 * Entities\Movement
 *
 * @Table(name="movement")
 * @Entity(repositoryClass="Mapper\Movement")
 */
class Movement
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
     * @var decimal $value
     *
     * @Column(name="value", type="decimal", nullable=true)
     */
    private $value;

    /**
     * @var string $type
     *
     * @Column(name="type", type="string", length=5, nullable=true)
     */
    private $type;

    /**
     * @var date $payday
     *
     * @Column(name="payday", type="date", nullable=true)
     */
    private $payday;

    /**
     * @var smallint $status
     *
     * @Column(name="status", type="smallint", nullable=true)
     */
    private $status;

    /**
     * @var Event
     *
     * @ManyToOne(targetEntity="Event")
     * @JoinColumns({
     *   @JoinColumn(name="eventId", referencedColumnName="id")
     * })
     */
    private $eventid;

}