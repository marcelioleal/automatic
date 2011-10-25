<?php
namespace Util;

/**
 * This class functions as an adapter Zend_Paginator so it can be used with the Doctrine
 * @param $doctrineQuery
 */

Class AdapterQuery implements \Zend\Paginator\Adapter{
	
    protected $_query;
	protected $nativeCount;

	public function __Construct(Doctrine_Query_Abstract $doctrineQuery, $nativeCount=true) {
		$this->_query 		= $doctrineQuery;
		$this->nativeCount	= $nativeCount;
	}
	
	public function getItems($offset, $itemCountPerPage) {
		$this->_query->offset($offset);
		$this->_query->limit($itemCountPerPage);
		return $this->_query->execute();
	}

	public function count() {
		$query = clone($this->_query);

		if ($this->nativeCount == true)
			return $this->nativeCount($query);
		else
			return $this->executeCount($query);
	}
	
	private function executeCount($query) {
		$result = $query->execute()->count(); 
		return $this->verifyQnt($result);
	}
	
	private function nativeCount($query) {
		$query->select("count(*) as total");
		$query->limit(0);
		$query->offset(0);
		$rs = $query->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
		return $this->verifyQnt($rs["total"]);
	}
	
	private function verifyQnt($total) {
		if ($total)
			return $total;
		else
			throw new ErrorException(Messages::getMessage("GENERAL", "NOT_FOUND"));
	}
} 