
<?php

require_once 'autoload.php';

use Controller\Controller;
use Core\Http\Request;

/*
 * Build a request with information from server
 */
$request = new Request();

$path = $_SERVER['PATH_INFO'];


if ($request->getPath() === '/address')
{
  $controller = new Controller();
  $return = $controller->ex($request);
  echo $return;
}

?>
