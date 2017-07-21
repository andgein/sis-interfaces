<?php
    require_once 'inc/common.php';
    require_once 'inc/blocks.php';
    require_once 'inc/page.php';

    function exception_handler($exception)
    {
        print '<div class="error">';
        print '<b>Fatal error</b>:  Uncaught exception \'' . htmlspecialchars(get_class($exception)) . '\' with message ';
        print $exception->getMessage() . '<br>';
        print 'Stack trace:<pre>' . htmlspecialchars($exception->getTraceAsString()) . '</pre>';
        print 'thrown in <b>' . htmlspecialchars($exception->getFile()) . '</b> on line <b>' . $exception->getLine() . '</b><br>';
        print '</div>';
     }

     set_exception_handler('exception_handler');