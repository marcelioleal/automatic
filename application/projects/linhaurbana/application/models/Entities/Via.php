<?php

namespace Entities;

/**
 * Entities\Via
 *
 * @Table(name="via")
 * @Entity(repositoryClass="Mapper\Via")
 */
class Via
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
     * @var string $nome
     *
     * @Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @var Linha
     *
     * @ManyToMany(targetEntity="Linha", mappedBy="via")
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
     * Set nome
     *
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * Get nome
     *
     * @return string $nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Add linha
     *
     * @param Linha $linha
     */
    public function addLinha(\Linha $linha)
    {
        $this->linha[] = $linha;
    }

    /**
     * Get linha
     *
     * @return Doctrine\Common\Collections\Collection $linha
     */
    public function getLinha()
    {
        return $this->linha;
    }
}