<?php
// $Id: global.php 83 2007-08-22 19:19:55Z landseer $
// ----------------------------------------------------------------------
// Zikula Application Framework
// Copyright (C) 2001 by the Zikula Development Team.
// http://www.zikula.org/
// ----------------------------------------------------------------------
// Based on:
// PHP-NUKE Web Portal System - http://phpnuke.org/
// Thatware - http://thatware.org/
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
// changed to bbsmile: larsneo
// ----------------------------------------------------------------------

// include smilie alternative text defines
Loader::includeOnce('modules/bbsmile/pnlang/fra/smilies.php');

// new
define('_BBSMILE_NOAUTOSMILIES', 'Extended Smilies not yet activated!');

//
// A
//
define('_BBSMILE_ADMIN_BTN_SUBMIT', 'Appliquer');
define('_BBSMILE_ADMIN_CONFIGSAVED', 'La configuration de bbsmile a �t� mise � jour');
define('_BBSMILE_ADMIN_HINT_IMAGEPATH', 'Entrer le r�pertoire (relatif) o� se trouvent les �moticons. Pas de slash terminal ni de backslash !');
define('_BBSMILE_ADMIN_LABEL_IMAGEPATH', 'Chemin vers les �moticons');
define('_BBSMILE_ADMIN_TITLE', 'Administration de bbsmile ');
define('_BBSMILE_ADMIN_TITLE_CONFIG', 'Modifier la configuration');
define('_BBSMILE_ADMIN_V1_HINT', 'Notez que bbsmilies doit �tre activ� pour �tre utilis� par un module sp�cifique par <a href="index.php?name=Modules&type=admin&func=view">administration -> modules</a>.');
define('_BBSMILE_ARGSERROR', '[bbsmile] Erreur interne ! Argument manquant !');

//
// C
//
define('_BBSMILE_COULDNOTREGISTER', 'bbsmile n\a pas �t� install� !');
define('_BBSMILE_COULDNOTUNREGISTER', 'bbsmile n\'a pas �t� supprim� !');

