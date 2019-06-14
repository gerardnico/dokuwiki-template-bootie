<?php

//configuration metadata describe properties of the settings as used by the Configuration Manager
//https://www.dokuwiki.org/devel:configuration#configuration_metadata


$meta['footer'] = array('string',
    "_caution" => "warning", // Show a warning
    "_pattern" => "/[a-zA-Z0-9]*/" // Only Accept alphanumeric characters
);

$meta['header'] = array('string',
    "_caution" => "warning", // Show a warning
    "_pattern" => "/[a-zA-Z0-9]*/" // Only Accept alphanumeric characters
);

// Do we use CDN when posible
$meta['cdn'] = array('onoff');

?>
