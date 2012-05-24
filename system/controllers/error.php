<?php

$text_page = true;
mail( ADMIN_EMAIL, 'Geogram error has occurred', $e->getMessage(), "From:<noreplay@geogram.me> Geogram.me" );

require( DIR_VIEWS . '/_header.php' );
require( DIR_VIEWS . '/error.php' );
require( DIR_VIEWS . '/_footer.php' );