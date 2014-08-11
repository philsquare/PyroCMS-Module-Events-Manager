<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// v1.0.0

class StreamBase {
	
	protected $namespace = 'philsquare_events_manager';
	
	protected $disable = 'id|created|image|updated|created_by';
	
	protected $params = array();
	
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->driver('Streams');
	}
	
	public function getAll()
	{
		return $this->ci->streams->entries->get_entries($this->getParams());
	}
	
	private function getParams()
	{
		$entries_params = $this->ci->streams->entries->entries_params;
		
		foreach($entries_params as $param => $default)
		{
			if(isset($this->$param)) $params[$param] = $this->$param;
			
			else $params[$param] = $default;
		}
		
		return $params;
	}
}