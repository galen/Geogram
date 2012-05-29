<?php

$title_append = 'Tag: ' . $tag;
$title = sprintf( "Photos for #%s", $tag );

require( DIR_VIEWS . '/_header.php' );
require( DIR_VIEWS . '/tag.php' );
require( DIR_VIEWS . '/_footer.php' );