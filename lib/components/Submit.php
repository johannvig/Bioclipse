<?php
function getSubmit($text, $class="", $redirection_name="", $redirection_link="")
{
    return ("
        <div class = 'div-submit'>
        <button type='submit' class='" . $class . "'>" . $text . "</button> 
            " . (($redirection_link != "" and $redirection_name != "") ? "<a href='" . $redirection_link . "'>" . $redirection_name . "</a>" : "") . "
        </div>");
}
