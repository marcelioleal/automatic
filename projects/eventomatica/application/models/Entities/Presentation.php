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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set participantid
     *
     * @param Participant $participantid
     */
    public function setParticipantid(\Participant $participantid)
    {
        $this->participantid = $participantid;
    }

    /**
     * Get participantid
     *
     * @return Participant $participantid
     */
    public function getParticipantid()
    {
        return $this->participantid;
    }

    /**
     * Set programid
     *
     * @param Program $programid
     */
    public function setProgramid(\Program $programid)
    {
        $this->programid = $programid;
    }

    /**
     * Get programid
     *
     * @return Program $programid
     */
    public function getProgramid()
    {
        return $this->programid;
    }

    /**
     * Set roomid
     *
     * @param Room $roomid
     */
    public function setRoomid(\Room $roomid)
    {
        $this->roomid = $roomid;
    }

    /**
     * Get roomid
     *
     * @return Room $roomid
     */
    public function getRoomid()
    {
        return $this->roomid;
    }

}