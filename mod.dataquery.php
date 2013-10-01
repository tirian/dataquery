<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine Dataquery Module Class
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

class Dataquery {

	var $return_data = ''; 

	/** -------------------------------------
	/**  Constructor
	/** -------------------------------------*/
	function Dataquery()
	{
		// Make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();

		$this->run_query();
	}

	/** --------------------------------------------------------------------------
	/** --------------------------------------------------------------------------*/
	function run_query() 
	{

		// Extract the query from the tag chunk
		
		if (($sql = ee()->TMPL->fetch_param('sql')) === FALSE)
		{
			return FALSE;			
		}

		$mysqli = new mysqli(ee()->db->hostname, ee()->db->username, ee()->db->password, ee()->db->database);
		$result = $mysqli->query($sql);

		if ($result->num_rows == 0)
		{
			return $this->return_data = ee()->TMPL->no_results();
		}

		$variables = array();		
		$result->data_seek(0);
		while ($row = $result->fetch_assoc()) {
			$variables[] = $row;
		}

		$this->return_data = ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $variables);
		
		return TRUE;
	}

	/** --------------------------------------------------------------------------
	/** --------------------------------------------------------------------------*/
	function run_procedure($pSQL) 
	{

		// Extract the query from the tag chunk
		
		if ($pSQL == '')
		{
			return FALSE;			
		}

		$mysqli = new mysqli(ee()->db->hostname, ee()->db->username, ee()->db->password, ee()->db->database);
		$result = $mysqli->query($sql);

		if ($result->num_rows == 0)
		{
			return $this->return_data = ee()->TMPL->no_results();
		}

		$variables = array();		
		$result->data_seek(0);
		while ($row = $result->fetch_assoc()) {
			$variables[] = $row;
		}

		$this->return_data = $variables;
		
		return TRUE;
	}

}
// END CLASS
