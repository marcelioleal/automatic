<?php

namespace Entities;

/**
 * Entities\Linha
 *
 * @Table(name="linha")
 * @Entity(repositoryClass="Mapper\Linha")
 */
class Linha
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
     * @Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;

    /**
     * @var integer $idSetran
     *
     * @Column(name="id_setran", type="integer", nullable=true)
     */
    private $idSetran;

    /**
     * @var string $codSetran
     *
     * @Column(name="cod_setran", type="string", length=100, nullable=true)
     */
    private $codSetran;

    /**
     * @var Via
     *
     * @ManyToMany(targetEntity="Via", inversedBy="linha")
     * @JoinTable(name="linhavia",
     *   joinColumns={
     *     @JoinColumn(name="Linha_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="Via_id", referencedColumnName="id")
     *   }
     * )
     */
    private $via;

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
     * Set idSetran
     *
     * @param integer $idSetran
     */
    public function setIdSetran($idSetran)
    {
        $this->idSetran = $idSetran;
    }

    /**
     * Get idSetran
     *
     * @return integer $idSetran
     */
    public function getIdSetran()
    {
        return $this->idSetran;
    }

    /**
     * Set codSetran
     *
     * @param string $codSetran
     */
    public function setCodSetran($codSetran)
    {
        $this->codSetran = $codSetran;
    }

    /**
     * Get codSetran
     *
     * @return string $codSetran
     */
    public function getCodSetran()
    {
        return $this->codSetran;
    }

    /**
     * Add via
     *
     * @param Via $via
     */
    public function addVia(\Via $via)
    {
        $this->via[] = $via;
    }

    /**
     * Get via
     *
     * @return Doctrine\Common\Collections\Collection $via
     */
    public function getVia()
    {
        return $this->via;
    }
}