<?php

namespace Entities;

/**
 * Entities\Rota
 *
 * @Table(name="rota")
 * @Entity(repositoryClass="Mapper\Rota")
 */
class Rota
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
     * @var text $rota
     *
     * @Column(name="rota", type="text", nullable=true)
     */
    private $rota;

    /**
     * @var Linha
     *
     * @ManyToOne(targetEntity="Linha")
     * @JoinColumns({
     *   @JoinColumn(name="Linha_id", referencedColumnName="id")
     * })
     */
    private $linha;

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
     * Set rota
     *
     * @param text $rota
     */
    public function setRota($rota)
    {
        $this->rota = $rota;
    }

    /**
     * Get rota
     *
     * @return text $rota
     */
    public function getRota()
    {
        return $this->rota;
    }

    /**
     * Set linha
     *
     * @param Linha $linha
     */
    public function setLinha(\Linha $linha)
    {
        $this->linha = $linha;
    }

    /**
     * Get linha
     *
     * @return Linha $linha
     */
    public function getLinha()
    {
        return $this->linha;
    }
}