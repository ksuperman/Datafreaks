<?php

define('LIVE', FALSE);

function logErrorToConsole($message)
{
    error_log($message, 0);
}

function customErrorHandler($number, $message, $file, $line, $vars)
{
    $message = "<hr /><strong>An error occurred in file '$file' " . "on line $line: $message</strong>\n<pre>\n" . print_r($vars, 1) . "</pre>";

    if (!LIVE) {
        echo "$number\n";
        echo "$message\n";
        echo "<br /><strong>Backtrace:</strong><br />\n";
        debug_print_backtrace();
        echo "<hr />";
    } else {
        echo '<div class="error">' . '    A system error occurred. ' . '    We apologize for the inconvenience.' . '</div><br />';
    }
}

