<?php

namespace Entities;

/**
 * Entities\Presentation
 *
 * @Table(name="presentation")
 * @Entity(repositoryClass="Mapper\Presentation")
 */
class Presentation
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
     * @var string $title
     *
     * @Column(name="title", type="string", length=45, nullable=true)
     */
    private $title;

    /**
     * @var string $description
     *
     * @Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

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
     * @var Participant
     *
     * @ManyToOne(targetEntity="Participant")
     * @JoinColumns({
     *   @JoinColumn(name="participantId", referencedColumnName="id")
     * })
     */
    private $participantid;

    /**
     * @var Program
     *
     * @ManyToOne(targetEntity="Program")
     * @JoinColumns({
     *   @JoinColumn(name="programId", referencedColumnName="id")
     * })
     */
    private $programid;

    /**
     * @var Room
     *
     * @ManyToOne(targetEntity="Room")
     * @JoinColumns({
     *   @JoinColumn(name="roomId", referencedColumnName="id")
     * })
     */
    private $roomid;

}