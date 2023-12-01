<?php

$_SESSION = array();

session_destroy();

header('Location: http://localhost:8080/tickets/login');