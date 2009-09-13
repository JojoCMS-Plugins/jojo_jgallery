<?php
/**
 *                    Jojo CMS
 *                ================
 *
 * Copyright 2007 Harvey Kane <code@ragepank.com>
 * Copyright 2007 Michael Holt <code@gardyneholt.co.nz>
 * Copyright 2007 Melanie Schulz <mel@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Harvey Kane <code@ragepank.com>
 * @author  Michael Cochrane <code@gardyneholt.co.nz>
 * @author  Melanie Schulz <mel@gardyneholt.co.nz>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 */

if (!defined('_MULTILANGUAGE')) {
    define('_MULTILANGUAGE', Jojo::getOption('multilanguage', 'no') == 'yes');
}

$table = 'jgallery';
$default_td[$table]['td_displayname'] = 'Galleries';
$default_td[$table]['td_displayfield'] = 'jg_name';
$default_td[$table]['td_orderbyfields'] = 'jg_name';
$default_td[$table]['td_topsubmit'] = 'yes';
$default_td[$table]['td_deleteoption'] = 'yes';
$default_td[$table]['td_menutype'] = 'list';
$default_td[$table]['td_defaultpermissions'] = "everyone.show=1\neveryone.view=1\nadmin.add=1\nadmin.edit=1\nadmin.delete=1";

$o = 1;
$field = 'jgalleryid';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_name'] = 'Gallery ID';
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'A unique ID for this gallery - automatically assigned by the system';
$default_fd[$table][$field]['fd_mode'] = 'standard';
$default_fd[$table][$field]['fd_tabname'] = 'Content';

$field = 'jg_name';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'text';
$default_fd[$table][$field]['fd_size'] = '70';
$default_fd[$table][$field]['fd_name'] = 'Gallery Name';
$default_fd[$table][$field]['fd_required'] = 'yes';
$default_fd[$table][$field]['fd_help'] = 'A unique name for this gallery';
$default_fd[$table][$field]['fd_mode'] = 'basic';
$default_fd[$table][$field]['fd_tabname'] = 'Content';

$field = 'jg_title';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'text';
$default_fd[$table][$field]['fd_size'] = '100';
$default_fd[$table][$field]['fd_name'] = 'Gallery Display Title';
$default_fd[$table][$field]['fd_required'] = 'yes';
$default_fd[$table][$field]['fd_help'] = 'A heading display name for this gallery';
$default_fd[$table][$field]['fd_mode'] = 'basic';
$default_fd[$table][$field]['fd_tabname'] = 'Content';

if (_MULTILANGUAGE) {

    $dlanguage = Jojo::getOption('multilanguage-default', 'en');
    $languages = Jojo::selectQuery("SELECT * from {language} WHERE `active` = 'yes'");
    foreach ($languages as $l ){    
        if ($l['languageid'] != $dlanguage) {
            $field = 'jg_title_' . $l['languageid'];
            $default_fd[$table][$field]['fd_order']     = $o++;
            $default_fd[$table][$field]['fd_name'] = $l['english_name'] . ' Title';
            $default_fd[$table][$field]['fd_type'] = 'text';
            $default_fd[$table][$field]['fd_size'] = '100';
            $default_fd[$table][$field]['fd_mode']      = 'basic';
            $default_fd[$table][$field]['fd_tabname'] = 'Content';
        }
    }      
}
$field = 'jg_width';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'integer';
$default_fd[$table][$field]['fd_default'] = 500;
$default_fd[$table][$field]['fd_units'] = 'pixels';
$default_fd[$table][$field]['fd_name'] = 'Gallery Width';
$default_fd[$table][$field]['fd_required'] = 'yes';
$default_fd[$table][$field]['fd_help'] = 'The width of this Gallery';
$default_fd[$table][$field]['fd_mode'] = 'basic';
$default_fd[$table][$field]['fd_tabname'] = 'Content';

//Body Code
$field = 'jg_description_code';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'texteditor';
$default_fd[$table][$field]['fd_options'] = 'jg_description';
$default_fd[$table][$field]['fd_rows'] = '10';
$default_fd[$table][$field]['fd_cols'] = '50';
$default_fd[$table][$field]['fd_help'] = 'The editor code for the description text.';
$default_fd[$table][$field]['fd_mode'] = 'basic';
$default_fd[$table][$field]['fd_tabname'] = 'Content';

//Body
$field = 'jg_description';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'hidden';
$default_fd[$table][$field]['fd_rows'] = '10';
$default_fd[$table][$field]['fd_cols'] = '50';
$default_fd[$table][$field]['fd_help'] = 'The body of the gallery description.';
$default_fd[$table][$field]['fd_mode'] = 'advanced';
$default_fd[$table][$field]['fd_tabname'] = 'Content';