<?php

namespace Entities;

/**
 * Entities\Town
 *
 * @Table(name="town")
 * @Entity(repositoryClass="Mapper\Town")
 */
class Town
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
     * @var string $name
     *
     * @Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var Province
     *
     * @ManyToOne(targetEntity="Province")
     * @JoinColumns({
     *   @JoinColumn(name="provinceId", referencedColumnName="id")
     * })
     */
    private $provinceid;

}