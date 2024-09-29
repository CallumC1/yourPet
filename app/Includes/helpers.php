<?php





/* Function to echo a string safely
*/
function out($string) {
    echo(htmlspecialchars($string));
}