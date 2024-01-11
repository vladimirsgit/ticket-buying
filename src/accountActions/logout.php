<?php

$_SESSION = array();

session_destroy();

header('Location: https://ticketastic.store/login');