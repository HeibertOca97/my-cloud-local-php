<?php
require_once "./config/glob.php";
require_once "./config/Autoload.php";

config\Autoload::run();
new core\Routing();