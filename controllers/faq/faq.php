<?php
function faq() {
    require_once ('lib/components/header.php');

    require('models/faq/faq.php');
    require('views/faq/faq.php');

    require_once ('lib/components/footer.php');
}
