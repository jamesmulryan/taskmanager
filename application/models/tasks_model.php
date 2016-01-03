<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks_model extends CI_Model {	
	
	/**
	 * Get all tasks
	 */
	function get()
	{
		return $this->db->get('tasks_headers')->result();
	}

	

}

