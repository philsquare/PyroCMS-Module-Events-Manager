<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Events Manager module
 *
 *
 * @author 		Phil Martinez - Philsquare Dev Team
 * @website		http://philsquare.com
 * @package 	PyroCMS
 */

class Admin_colors extends Admin_Controller
{

	/**
	 * The current active section
	 *
	 * @var string
	 */
	protected $section = 'colors';

    public function __construct()
    {
        parent::__construct();

		role_or_die('philsquare_events_manager', 'colors');
    }

	public function index($offset = 0)
	{
		$limit = Settings::get('records_per_page');
		
		$extra = array(
			'title' => 'Colors',
			
			'buttons' => array(
				array(
					'label' => 'Edit',
					'url' => 'admin/events_manager/colors/form/-entry_id-'
				),
				array(
					'label' => 'Delete',
					'url' => 'admin/events_manager/colors/delete/-entry_id-',
					'confirm' => true
				)
			),
			
			'columns' => array('title', 'slug', 'hex')
		);
		
		$this->streams->cp->entries_table(
			'colors',
			'philsquare_events_manager',
			$limit,
			'admin/events_manager/colors/index',
			true,
			$extra
		);
	}
	
	public function form($id = null)
	{
		$extra = array(
			'return' => 'admin/events_manager/colors',
			'title' => $id ? 'Edit Color' : 'Add Color'
		);
		
		$this->streams->cp->entry_form(
			'colors',
			'philsquare_events_manager',
			$id ? 'edit' : 'new',
			$id,
			true,
			$extra
		);
	}
	
	public function delete($id = 0)
	{
		$this->streams->entries->delete_entry($id, 'colors', 'philsquare_events_manager');
		$this->session->set_flashdata('error', 'Color was deleted.');
		redirect('admin/events_manager/colors');
	}
}