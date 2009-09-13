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

$table = 'jgalleryimage';
$default_td[$table]['td_displayname'] = 'Gallery Image';
$default_td[$table]['td_displayfield'] = 'ji_filename';
$default_td[$table]['td_orderbyfields'] = 'ji_filename';
$default_td[$table]['td_categorytable'] = 'jgallery';
$default_td[$table]['td_categoryfield'] = 'jgalleryid';
$default_td[$table]['td_primarykey'] = 'jgalleryimageid';
$default_td[$table]['td_topsubmit'] = 'yes';
$default_td[$table]['td_deleteoption'] = 'yes';
$default_td[$table]['td_menutype'] = 'tree';
$default_td[$table]['td_defaultpermissions'] = "everyone.show=1\neveryone.view=1\nadmin.add=1\nadmin.edit=1\nadmin.delete=1";

$o = 1;
$field = 'jgalleryimageid';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_name'] = 'Gallery Image ID';
$default_fd[$table][$field]['fd_type'] = 'readonly';
$default_fd[$table][$field]['fd_help'] = 'A unique ID for this gallery image - automatically assigned by the system';
$default_fd[$table][$field]['fd_mode'] = 'standard';
$default_fd[$table][$field]['fd_tabname'] = 'Images';

$field = 'jgalleryid';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'dblist';
$default_fd[$table][$field]['fd_options'] = 'jgallery';
$default_fd[$table][$field]['fd_name'] = 'Display in Gallery';
$default_fd[$table][$field]['fd_required'] = 'yes';
$default_fd[$table][$field]['fd_help'] = 'Which gallery  will this image be used in.';
$default_fd[$table][$field]['fd_mode'] = 'basic';
$default_fd[$table][$field]['fd_tabname'] = 'Images';

$field = 'ji_filename';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'fileupload';
$default_fd[$table][$field]['fd_name'] = 'Image';
$default_fd[$table][$field]['fd_required'] = 'yes';
$default_fd[$table][$field]['fd_help'] = 'Upload this image';
$default_fd[$table][$field]['fd_mode'] = 'basic';
$default_fd[$table][$field]['fd_tabname'] = 'Images';

$field = 'ji_title';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'text';
$default_fd[$table][$field]['fd_size'] = '100';
$default_fd[$table][$field]['fd_name'] = 'Title';
$default_fd[$table][$field]['fd_required'] = 'no';
$default_fd[$table][$field]['fd_help'] = 'Title of this image';
$default_fd[$table][$field]['fd_mode'] = 'basic';
$default_fd[$table][$field]['fd_tabname'] = 'Images';

$field = 'ji_description';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type'] = 'textarea';
$default_fd[$table][$field]['fd_cols'] = '80';
$default_fd[$table][$field]['fd_rows'] = '5';
$default_fd[$table][$field]['fd_name'] = 'Caption';
$default_fd[$table][$field]['fd_required'] = 'no';
$default_fd[$table][$field]['fd_help'] = 'Description of this image - used for captions';
$default_fd[$table][$field]['fd_mode'] = 'basic';
$default_fd[$table][$field]['fd_tabname'] = 'Images';

if (_MULTILANGUAGE) {

    $dlanguage = Jojo::getOption('multilanguage-default', 'en');
    $languages = Jojo::selectQuery("SELECT * from {language} WHERE `active` = 'yes'");
    foreach ($languages as $l ){
        if ($l['languageid'] != $dlanguage) {
            $field = 'ji_description_' . $l['languageid'];
            $default_fd[$table][$field]['fd_order']     = $o++;
            $default_fd[$table][$field]['fd_name'] = $l['english_name'] . ' caption';
            $default_fd[$table][$field]['fd_type']      = 'textarea';
            $default_fd[$table][$field]['fd_mode']      = 'advanced';
            $default_fd[$table][$field]['fd_tabname'] = 'Images';
        }
    }
}