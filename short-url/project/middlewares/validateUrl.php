<?php
function validateUrl() {
    $url = $_POST['URL'];
    //var_dump($_POST['URL']);
    $regexHttpStart = "/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/";
$regexNoHttpStarts = "/^[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/";
    if (preg_match($regexHttpStart, $url) || preg_match($regexNoHttpStarts, $url))
        return true;
    else return false;
}