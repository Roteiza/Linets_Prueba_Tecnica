<?php

function controllersAutoload($className)
{
    require_once('Controllers/'.$className.'.php');
}

spl_autoload_register('controllersAutoload');