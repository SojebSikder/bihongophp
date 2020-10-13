<?php
/**
 * Date Helper
 */

function formatDate($date){
    return date('F j, Y, g:i a', strtotime($date));
}

function formatDateNoTime($date){
    return date('F j, Y', strtotime($date));
}

function formatOnlyDate($date){
    return date('j', strtotime($date));
}
function formatOnlyYear($date){
    return date('Y', strtotime($date));
}
function formatOnlyMonth($date){
    return date('F', strtotime($date));
}

?>