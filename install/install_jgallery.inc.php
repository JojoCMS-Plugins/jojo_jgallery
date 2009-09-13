<?php

if (!defined('_MULTILANGUAGE')) {
    define('_MULTILANGUAGE', Jojo::getOption('multilanguage', 'no') == 'yes');
}

$table = 'jgallery';
$query = "
    CREATE TABLE {jgallery} (
      `jgalleryid` int(11) NOT NULL auto_increment,
      `jg_name` varchar(255) NOT NULL,
      `jg_title` varchar(255) NOT NULL,
      ";
if (_MULTILANGUAGE) {
    $languages = Jojo::selectQuery("SELECT * from {language} WHERE `active` = 'yes'");
    $dlanguage = Jojo::getOption('multilanguage-default', 'en');
          
    foreach ($languages as $l ){    
        if ($l['languageid'] != $dlanguage) {
        $query .= "`jg_title_" . $l['languageid']  . "` varchar(255),
        ";
        }
    }      
}           
$query .= "      
      `jg_width` int(11) NOT NULL,
      `jg_description` text NULL,
      `jg_description_code` text NULL,
      PRIMARY KEY  (`jgalleryid`)
    ) TYPE=MyISAM;";

/* Check table structure */
$result = Jojo::checkTable($table, $query);

/* Output result */
if (isset($result['created'])) {
    echo sprintf("Table <b>%s</b> Does not exist - created empty table.<br />", $table);
}

if (isset($result['added'])) {
    foreach ($result['added'] as $col => $v) {
        echo sprintf("Table <b>%s</b> column <b>%s</b> Does not exist - added.<br />", $table, $col);
    }
}

if (isset($result['different'])) Jojo::printTableDifference($table,$result['different']);