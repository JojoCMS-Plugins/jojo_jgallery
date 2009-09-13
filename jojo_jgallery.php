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

class JOJO_Plugin_jojo_jgallery extends JOJO_Plugin
{
    public static function inlinejgallery($content)
    {
        if (strpos($content, '[[jgallery:') === false) {
            return $content;
        }
        global $smarty, $page;
        if (_MULTILANGUAGE) $language = !empty($page->page['pg_language']) ? $page->page['pg_language'] : Jojo::getOption('multilanguage-default', 'en');
        $dlanguage = Jojo::getOption('multilanguage-default', 'en');

        preg_match_all('/\[\[jgallery:([^\]]*)\]\]/', $content, $matches);
        if ($matches[0]) {
            foreach($matches[1] as $id => $match) {

                /* Find the gallery in the database */
                $jgallery = Jojo::selectRow('SELECT * FROM {jgallery} WHERE jg_name = ?', trim($match));
                if (!isset($jgallery)) {
                    $content = str_replace($matches[0][$id], "Gallery '$match' not found", $content);
                    continue;
                }
                $jgallery['title'] = (_MULTILANGUAGE && $language != $dlanguage && $jgallery['jg_title' . '_' . $language] ) ? $jgallery['jg_title' . '_' . $language] : $jgallery['jg_title' ];
                $jgallery['title'] = htmlspecialchars( $jgallery['title'], ENT_COMPAT, 'UTF-8', false);
                $smarty->assign('jgallery', $jgallery);
                $smarty->assign('jgalleryid', $jgallery['jgalleryid']);


                /* Get images for the gallery */
                $jgalleryimages = Jojo::selectQuery('SELECT * FROM {jgalleryimage} WHERE jgalleryid = ? ORDER BY jgalleryimageid', $jgallery['jgalleryid']);
                foreach($jgalleryimages as $k => $v) {
                    $jgalleryimages[$k]['filename'] = $v['ji_filename'];
                    $jgalleryimages[$k]['description'] = (_MULTILANGUAGE && $language != $dlanguage && $v['ji_description' . '_' . $language] ) ? $v['ji_description' . '_' . $language] : $v['ji_description' ];
                    $jgalleryimages[$k]['description'] =  htmlspecialchars($jgalleryimages[$k]['description'], ENT_COMPAT, 'UTF-8', false);
                }
                $smarty->assign('jgalleryimages', $jgalleryimages);
                $smarty->assign('jgalleryimagescount', count($jgalleryimages));
                $smarty->assign('jgalleryimageswidth', 85*count($jgalleryimages));


                /* Get the jgallery html */
                $html = $smarty->fetch('jojo_jgallery.tpl');
                $content = str_replace($matches[0][$id], $html, $content);
            }
        }
        return $content;
    }

}