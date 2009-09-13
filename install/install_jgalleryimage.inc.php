<?php

if (!defined('_MULTILANGUAGE')) {
    define('_MULTILANGUAGE', Jojo::getOption('multilanguage', 'no') == 'yes');
}

$table = 'jgalleryimage';
$query = "
    CREATE TABLE {jgalleryimage} (
      `jgalleryimageid` bigint(20) NOT NULL auto_increment,
      `jgalleryid` int(11) NOT NULL,
      `ji_filename` varchar(255) NOT NULL,
      `ji_title` text NOT NULL,
      `ji_description` text NOT NULL,
      ";

if (_MULTILANGUAGE) {
    $languages = Jojo::selectQuery("SELECT * from {language} WHERE `active` = 'yes'");
    $dlanguage = Jojo::getOption('multilanguage-default', 'en');
          
    foreach ($languages as $l ){    
        if ($l['languageid'] != $dlanguage) {
        $query .= "`ji_description_" . $l['languageid']  . "` text,
        ";
        }
    }      
}           
$query .= "      
      PRIMARY KEY  (`jgalleryimageid`),
      KEY `jgalleryid` (`jgalleryid`)
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