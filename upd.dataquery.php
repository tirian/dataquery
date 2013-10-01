<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine Dataquery Updater Class
 *
 * @package     ExpressionEngine
 * @subpackage  Modules
 * @category    Data Query
 * @author      Matt Glover
 * @copyright   Copyright (c) 2013 - Matt Glover, Tirian Group
 * @link        http://tirian.net
 * @license 
 *
 * Copyright (c) 2013 Tirian Group
 * All rights reserved.
 *
 * This source is commercial software. Use of this software requires a
 * site license for each domain it is used on. Use of this software or any
 * of its source code without express written permission in the form of
 * a purchased commercial or other license is prohibited.
 *
 * THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY
 * KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A
 * PARTICULAR PURPOSE.
 *
 * As part of the license agreement for this software, all modifications
 * to this source must be submitted to the original author for review and
 * possible inclusion in future releases. No compensation will be provided
 * for patches, although where possible we will attribute each contribution
 * in file revision notes. Submitting such modifications constitutes
 * assignment of copyright to the original author (Brian Litzinger and
 * BoldMinded, LLC) for such modifications. If you do not wish to assign
 * copyright to the original author, your license to  use and modify this
 * source is null and void. Use of this software constitutes your agreement
 * to this clause.
 */

class Dataquery_upd {

    public $version = '1.0';
	public $module_name = 'Dataquery';
	public $module_mcp = 'Dataquery_mcp';
    
    public function Dataquery_upd($switch = TRUE)
    {
        $this->EE =& get_instance();
    }

    public function install()
    {
        // Module data
        $data = array(
            'module_name' => $this->module_name,
            'module_version' => $this->version,
            'has_cp_backend' => 'n',
            'has_publish_fields' => 'n'
        );

        $this->EE->db->insert('modules', $data);

        return TRUE;
    }
    
    public function uninstall()
    {
		ee()->db->select('module_id');		
		$query = ee()->db->get_where('modules', array('module_name' => $this->module_name));
		$module_id = $query->row('module_id');
				
		ee()->db->where('module_id', $module_id);
		ee()->db->delete('module_member_groups');

		ee()->db->where('module_name', $this->module_name);
		ee()->db->delete('modules');

		ee()->db->where('class', $this->module_name);
		ee()->db->delete('actions');

		ee()->db->where('class', $this->module_mcp);
		ee()->db->delete('actions');

		return TRUE;
    }
    
    public function update($current = '')
    {   
        return TRUE;
    }
    
}