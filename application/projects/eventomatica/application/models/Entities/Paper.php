<?php

namespace Entities;

/**
 * Entities\Paper
 *
 * @Table(name="paper")
 * @Entity(repositoryClass="Mapper\Paper")
 */
class Paper
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
     * @Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

}