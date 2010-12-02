<?php

namespace Entities;

/**
 * Entities\Province
 *
 * @Table(name="province")
 * @Entity(repositoryClass="Mapper\Province")
 */
class Province
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
     * @var string $sigla
     *
     * @Column(name="sigla", type="string", length=45, nullable=true)
     */
    private $sigla;

    /**
     * @var Country
     *
     * @ManyToOne(targetEntity="Country")
     * @JoinColumns({
     *   @JoinColumn(name="countryId", referencedColumnName="id")
     * })
     */
    private $countryid;

}