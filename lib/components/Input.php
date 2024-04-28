
<?php
function getInput($name, $type, $labelName = "", $class = "", $placeholder = "", $value = "", $divClass = "div-input", $pattern = "", $required = false)
{
    return "
        <div class='" . $divClass . "'>
            <label for=" . $name . ">" . $labelName . "</label>
            <input type='" . $type . "' name='" . $name . "' class='" . $class . "' placeholder='" . $placeholder . "' value='" . $value . ($pattern!==""? "' pattern='" : "") . $pattern . "' " . ($required ? "required" : "") . ">
        </div>
        ";
}
