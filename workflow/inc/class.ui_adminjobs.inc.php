<?php
/**************************************************************************\
* eGroupWare                                                               *
* http://www.egroupware.org                                                *
* --------------------------------------------                             *
*  This program is free software; you can redistribute it and/or modify it *
*  under the terms of the GNU General Public License as published by the   *
*  Free Software Foundation; either version 2 of the License, or (at your  *
*  option) any later version.                                              *
\**************************************************************************/

require_once(dirname(__FILE__) . SEP . 'class.ui_ajaxinterface.inc.php');

/**
 * Camada View para Mover Inst�ncias.
 * @package Workflow
 * @author Sidnei Augusto Drovetto Jr. - drovetto@gmail.com
 * @license http://www.gnu.org/copyleft/gpl.html GPL
 */
class ui_adminjobs extends ui_ajaxinterface
{
	/**
	 * @var array $public_functions Lista de m�todos que podem ser executados.
	 * @access private
	 */
	var $public_functions = array(
			'form'	=> true
		);

	/**
	 * Carrega os valores que ser�o utilizados para cria��o da interface para mover inst�ncias.
	 * @return void
	 * @access public
	 */
	function form()
	{
		$GLOBALS['phpgw_info']['flags'] = array(
			'noheader' => false,
			'nonavbar' => false,
			'currentapp' => 'workflow',
			'app_header' => $GLOBALS['phpgw_info']['apps']['workflow']['title'] . ' - ' . lang('Jobs')
		);
		$smarty = &Factory::getInstance('workflow_smarty');

		$javaScripts = $this->get_common_js();
		$javaScripts .= $this->get_js_link('workflow','jscode', 'prototype');
		$javaScripts .= $this->get_js_link('workflow','nano', 'JSON');
		$javaScripts .= $this->get_js_link('workflow','scriptaculous', 'scriptaculous', 'load=effects');
		$javaScripts .= $this->get_js_link('workflow','adminjobs', 'utils');
		$javaScripts .= $this->get_js_link('workflow','adminjobs', 'actions');
		$javaScripts .= $this->get_js_link('workflow','adminjobs', 'interface');

		$css = $this->get_common_css();
		$css .= $this->get_css_link('adminjobs');

		$processInfo = Factory::getInstance('workflow_processmanager')->get_process((int) $_REQUEST['p_id']);
		$smarty->assign('processNameVersion', "{$processInfo['wf_name']} v{$processInfo['wf_version']}");
		$smarty->assign('processID', (int) $processInfo['wf_p_id']);
		$smarty->assign('header', $smarty->expressoHeader);
		$smarty->assign('footer', $this->expressoFooter);
		$smarty->assign('txt_loading', lang("loading"));
		$smarty->assign('javaScripts', $javaScripts);
		$smarty->assign('css', $css);
		$smarty->display('adminjobs.tpl');
	}
}
?>
