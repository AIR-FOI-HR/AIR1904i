<?php
error_reporting(E_ALL);

require_once 'RestController.php';

$rc = new RestController();
echo $rc->getData();
