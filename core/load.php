<?php

session_start();

require_once 'routing.php';

require_once 'model.php';
require_once 'view.php';
require_once 'controller.php';

Routing::execute();