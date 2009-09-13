<?php
/**
 *
 * Copyright 2007 Michael Cochrane <code@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Michael Cochrane <code@gardyneholt.co.nz>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 */

// Edit Galleries
$data = Jojo::selectQuery("SELECT * FROM {page} WHERE pg_url = 'admin/edit/jgallery'");
if (count($data) == 0) {
    echo "Adding <b>Edit Galleries</b> Page to menu<br />";
    Jojo::insertQuery("INSERT INTO {page} SET pg_title = 'Edit Galleries', pg_link = 'Jojo_Plugin_Admin_Edit', pg_url = 'admin/edit/jgallery', pg_parent = ?, pg_order=12", array($_ADMIN_CONTENT_ID));
}

// Edit Gallery Images
$data = Jojo::selectQuery("SELECT * FROM {page} WHERE pg_url = 'admin/edit/jgalleryimage'");
if (count($data) == 0) {
    echo "Adding <b>Edit Gallery Images</b> Page to menu<br />";
    Jojo::insertQuery("INSERT INTO {page} SET pg_title = 'Edit Gallery Images', pg_link = 'Jojo_Plugin_Admin_Edit', pg_url = 'admin/edit/jgalleryimage', pg_parent = ?, pg_order=13", array($_ADMIN_CONTENT_ID));
}