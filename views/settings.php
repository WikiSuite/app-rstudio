<?php

/**
 * Rstudio settings view.
 *
 * @category   apps
 * @package    rstudio
 * @subpackage views
 * @author     eGloo <team@egloo.ca>
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://www.egloo.ca
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.  
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('rstudio');

///////////////////////////////////////////////////////////////////////////////
// Show warning if not running
///////////////////////////////////////////////////////////////////////////////

echo "<div id='rstudio_not_running' style='display:none;'>";
echo infobox_warning(lang('base_warning'), lang('rstudio_management_tool_not_accessible'));
echo "</div>";

///////////////////////////////////////////////////////////////////////////////
// Helper if running
///////////////////////////////////////////////////////////////////////////////

echo "<div id='rstudio_running' style='display:none;'>";

$options['buttons']  = array(
    anchor_custom('http://' . $_SERVER['SERVER_ADDR'] . ':8787', lang('rstudio_go_to_management_tool'), 'high', array('target' => '_blank'))
);

echo infobox_highlight(
    lang('rstudio_management_tool'),
    lang('rstudio_management_tool_help'),
    $options
);

echo "</div>";
