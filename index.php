
<?php

require_once 'autoload.php';

use Controller\Controller;

$path = $_SERVER['PATH_INFO'];


if ($path = '/address')
{
  $controller = new Controller();
  $return = $controller->ex();
  echo $return;
}

?>
