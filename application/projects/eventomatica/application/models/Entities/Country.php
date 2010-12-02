<?php

namespace Entities;

/**
 * Entities\Country
 *
 * @Table(name="country")
 * @Entity(repositoryClass="Mapper\Country")
 */
class Country
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

}