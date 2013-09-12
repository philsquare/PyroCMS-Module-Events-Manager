<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Plugin for events manager
 *
 * @author 		Phil Martinez - Philsquare Dev Team
 * @website		http://philsquarelabs.com
 * @package 	PyroCMS
 * @subpackage 	Template Module
 */
class Plugin_Events_manager extends Plugin
{

	public $version = '1.0.0';
	public $name = array(
		'en' => 'Event Manager'
	);
	public $description = array(
		'en' => 'Events Manager plugin'
	);
	
	public function _self_doc()
	{
		$info = array(
			'method' => array(
				'description' => array(
					'en' => ''
				),
				'single' => true,
				'double' => false,
				'variables' => '',
				'attributes' => array(
					'id' => array(
						'type' => 'number',
						'flags' => '',
						'default' => '',
						'required' => true,
					),
				),
			)
		);
	
		return $info;
	}
	
	function display_timespan()
	{
		$start = $this->attribute('start');
		$end = $this->attribute('end');
		$date_format = $this->attribute('date_format', null);
		$time_format = $this->attribute('time_format', null);
		
		// Formats
		if(! $date_format) $date_format = 'F j, Y';
		
		if(! $time_format) $time_format = 'g:i a';
		
		// Same day?
		if(date('Ymd', $start) == date('Ymd', $end))
		{
			$display[] = date($date_format, $start);
			$display[] = 'from';
			$display[] = date($time_format, $start);
			$display[] = 'to';
			$display[] = date($time_format, $end);
		}
		
		// Multiple days. We won't show times
		else
		{
			$display[] = date($date_format, $start);
			$display[] = 'to';
			$display[] = date($date_format, $end);
		}
		
		return implode(' ', $display);
	}

}

/* End of file plugin.php */