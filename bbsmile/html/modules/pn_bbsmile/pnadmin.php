<?php
// $Id$
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file: Hinrich Donner
// changed to pn_bbsmile: larsneo
// ----------------------------------------------------------------------

/**
 * @package PostNuke_Utility_Modules
 * @subpackage pn_bbsmile
 * @license http://www.gnu.org/copyleft/gpl.html
*/

/**
 * the main administration function
 * This function is the default function, and is called whenever the
 * module is initiated without defining arguments.  As such it can
 * be used for a number of things, but most commonly it either just
 * shows the module menu and returns or calls whatever the module
 * designer feels should be the default function (often this is the
 * view() function)
 */
function pn_bbsmile_admin_main()
{
    if (!SecurityUtil::checkPermission('pn_bbsmile::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(_PNBBSMILE_ADMIN_NOACCESS);
    }

    $pnr = pnRender::getInstance('pn_bbsmile', false, null, true);
    $hmods = pnModAPIFunc('modules', 'admin', 'gethookedmodules', array('hookmodname' => 'pn_bbsmile'));
    foreach($hmods as $hmod => $dummy) {
        $modid = pnModGetIDFromName($hmod);
        $moddata = pnModGetInfo($modid);
        $moddata['id'] = $modid;
        $hookedmodules[] = $moddata;
    }
    $pnr->assign('hookedmodules', $hookedmodules);
    return $pnr->fetch('pn_bbsmile_admin_main.html');
}

/**
 * modifyconfig
 *
 *
 */
function pn_bbsmile_admin_modifyconfig()
{
    if (!SecurityUtil::checkPermission('pn_bbsmile::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(_PNBBSMILE_ADMIN_NOACCESS);
    }

    Loader::requireOnce('modules/pn_bbsmile/pnincludes/pn_bbsmile_admin_modifyconfighandler.class.php');

    // Create output object
    $pnf = FormUtil::newpnForm('pn_bbsmile');

    // Return the output that has been generated by this function
    return $pnf->pnFormExecute('pn_bbsmile_admin_modifyconfig.html', new pn_bbsmile_admin_modifyconfighandler());
}

/**
 * readsmilies
 *
 *
 */
function pn_bbsmile_admin_readsmilies() {

    if (!SecurityUtil::checkPermission('pn_bbsmile::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(_PNBBSMILE_ADMIN_NOACCESS);
    }

    $submit = FormUtil::getPassedValue('submit', null, 'POST');

    if(!$submit) {
        $pnr = pnRender::getInstance('pn_bbsmile', false, null, true);
        return $pnr->fetch('pn_bbsmile_admin_readsmilies.html');
    }
    // submit is set - update the Smilies
    $forcereload = FormUtil::getPassedValue('forcereload', 0, 'POST');
    $forcereload = ($forcereload==1) ? true : false;
    // @see adminapi.php#pn_bbsmile_adminapi_updatesmilies()
    pnModAPIFunc('pn_bbsmile', 'admin', 'updatesmilies', array('forcereload' => $forcereload));
    LogUtil::registerStatus(_PNBBSMILE_ADMIN_SMILIESREADFROMFILESYSTEM);
    return pnRedirect(pnModURL('pn_bbsmile', 'admin'));
}

/**
 * editsmilies
 *
 *
 */
function pn_bbsmile_admin_editsmilies() {

    if (!SecurityUtil::checkPermission('pn_bbsmile::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(_PNBBSMILE_ADMIN_NOACCESS);
    }

    $submit = FormUtil::getPassedValue('submit', null, 'POST');

    if(!$submit) {
        $pnr = pnRender::getInstance('pn_bbsmile', false, null, true);
        $smilies = pnModGetVar('pn_bbsmile','smilie_array');
        $pnr->assign('smilies',$smilies);
        return $pnr->fetch('pn_bbsmile_admin_editsmiles.html');
    }
    // submit is set
    // Get input
    $keys    = FormUtil::getPassedValue('key', array(), 'POST');
    $shorts  = FormUtil::getPassedValue('short', array(), 'POST');
    $imgsrcs = FormUtil::getPassedValue('imgsrc', array(), 'POST');
    $alts    = FormUtil::getPassedValue('alt', array(), 'POST');
    $aliases = FormUtil::getPassedValue('alias', array(), 'POST');
    $types   = FormUtil::getPassedValue('smilietype', array(), 'POST');
    $active  = FormUtil::getPassedValue('active', array(), 'POST');

    $smilies = array();

    // Create an array with the input and deaktivate all smilies
    for($i = 0; $i < sizeof($keys); $i++) {
        $smilies[$keys[$i]] = array(
            'type'   => $types[$i],
            'short'  => $shorts[$i],
            'imgsrc' => $imgsrcs[$i],
            'alt'    => $alts[$i],
            'alias'  => $aliases[$i],
            'active'  => 0);
    }
    // And now set the active flag for all selected smilies
    for ($i = 0; $i < sizeof($active); $i++) {
  	    $smilies[$active[$i]]['active'] = 1;
    }

   pnModSetVar('pn_bbsmile','smilie_array', $smilies);

   LogUtil::registerStatus(_PNBBSMILE_ADMIN_EDITEDSMILIESSAVED);
   return pnRedirect(pnModURL('pn_bbsmile', 'admin'));
}
