<?php
/**
 * Helper wrapper for lookup
 *
 */

namespace Minds\Core\data;

use Minds\Core;

class lookup{

	private $call;
	private $namespace = '';
	
	public function __construct($namespace = NULL){
		$this->call = new Call('user_index_to_guid');
		
		if($namespace)
			$this->setNamespace($namespace);
	}
	
	public function setNamespace($namespace){
		$this->namespace = $namespace . ':';
	}
	
	public function set($key, $values){
		if(!is_array($values))
			$values = array($values);
		return $this->call->insert($this->namespace.$key, $values);
	}
	
	public function remove($key){
		return $this->call->removeRow($this->namespace.$key);
	}
	
	public function removeColumn($key, $column){
		return $this->call->removeAttributes($key, array($column));
	}
	
	public function get($name){
		try{
			return $this->call->getRow($this->namespace.$name);
		} catch (\Exception $e){
			return false;
		}
	}
	
}
