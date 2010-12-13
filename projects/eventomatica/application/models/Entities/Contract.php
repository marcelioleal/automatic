<?php

namespace Entities;

/**
 * Entities\Contract
 *
 * @Table(name="contract")
 * @Entity(repositoryClass="Mapper\Contract")
 */
class Contract
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
     * @Column(name="description", type="string", length=200, nullable=true)
     */
    private $description;

    /**
     * @var decimal $value
     *
     * @Column(name="value", type="decimal", nullable=true)
     */
    private $value;

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
     * @var datetime $createdat
     *
     * @Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdat;

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
     * Set value
     *
     * @param decimal $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return decimal $value
     */
    public function getValue()
    {
        return $this->value;
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
     * Set createdat
     *
     * @param datetime $createdat
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
    }

    /**
     * Get createdat
     *
     * @return datetime $createdat
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

}