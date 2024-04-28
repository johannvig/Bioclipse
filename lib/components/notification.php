<link rel="stylesheet" href="styles/components/notification.css">
<?php
function createNotification($type, $message, $duration)
{
    return ("<div class='notification " . $type . "'><p>" . $message . "</p></div>
    <script>
        setTimeout(function() {
            document.querySelector('.notification').style.display = 'none';
        }, ".$duration.");
    </script>
");
}