<?php

require_once('Autoload.php');
require_once('Config/Parameters.php');
require_once('Config/Config.php');

if(isset($_GET['Controller']))
{
    $controller_name = $_GET['Controller'].'Controller';
}
elseif(!isset($_GET['Controller']) && !isset($_GET['Action']))
{
    $controller_name = DEFAULT_CONTROLLER;
}
else
{
    require_once 'Views/Layouts/head.php';
    require_once 'Views/Layouts/header.php';
    require_once 'Views/Layouts/404-error.php';
    require_once 'Views/Layouts/footer.php';
    exit;
}

if(isset($controller_name) && class_exists($controller_name))
{
    require_once 'Views/Layouts/head.php';
    require_once 'Views/Layouts/header.php';

    $controller = new $controller_name();

    if(isset($_GET['Action']) && method_exists($controller, $_GET['Action']))
    {
        $action = $_GET['Action'];
        $controller->$action();
    }
    elseif(!isset($_GET['Controller']) && !isset($_GET['Action']))
    {
        $default_action = DEFAULT_ACTION;
        $controller->$default_action();
    }
    require_once('Views/Layouts/footer.php');
}
else
{
    require_once 'Views/Layouts/head.php';
    require_once 'Views/Layouts/header.php';
    require_once 'Views/Layouts/404-error.php';
    require_once 'Views/Layouts/footer.php';
    exit;
}