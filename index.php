<?php

require_once "controllers/template.controller.php";
require_once "controllers/mail.controller.php";

$template = new TemplateController();
$template->ctrTemplate();

?>