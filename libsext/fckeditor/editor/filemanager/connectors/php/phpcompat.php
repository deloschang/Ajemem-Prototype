<<<<<<< HEAD
<?php

if ( !isset( $_SERVER ) ) {
    $_SERVER = $HTTP_SERVER_VARS ;
}
if ( !isset( $_GET ) ) {
    $_GET = $HTTP_GET_VARS ;
}
if ( !isset( $_FILES ) ) {
    $_FILES = $HTTP_POST_FILES ;
}

if ( !defined( 'DIRECTORY_SEPARATOR' ) ) {
    define( 'DIRECTORY_SEPARATOR',
        strtoupper(substr(PHP_OS, 0, 3) == 'WIN') ? '\\' : '/'
    ) ;
=======
<?php

if ( !isset( $_SERVER ) ) {
    $_SERVER = $HTTP_SERVER_VARS ;
}
if ( !isset( $_GET ) ) {
    $_GET = $HTTP_GET_VARS ;
}
if ( !isset( $_FILES ) ) {
    $_FILES = $HTTP_POST_FILES ;
}

if ( !defined( 'DIRECTORY_SEPARATOR' ) ) {
    define( 'DIRECTORY_SEPARATOR',
        strtoupper(substr(PHP_OS, 0, 3) == 'WIN') ? '\\' : '/'
    ) ;
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
}