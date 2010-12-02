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

}