<?php

namespace Entities;

/**
 * Entities\Room
 *
 * @Table(name="room")
 * @Entity(repositoryClass="Mapper\Room")
 */
class Room
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
     * @var Place
     *
     * @ManyToOne(targetEntity="Place")
     * @JoinColumns({
     *   @JoinColumn(name="placeId", referencedColumnName="id")
     * })
     */
    private $placeid;

}