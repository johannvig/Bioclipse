<?php
function getCheckbox($name, $labelName="", $class="")
{
    return "
        <div class='div-checkbox'>
            <label for='" . $name . "'>" . $labelName . "</label>
            <input type='checkbox' name='" . $name . "' class='" . $class . "'>
        </div>
        ";
}
