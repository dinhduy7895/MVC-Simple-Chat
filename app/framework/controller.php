<?php

abstract class  Controller
{
    protected $db;

    abstract function render($viewUrl, $param = null);

    abstract function route($ctl, $act = 'index', $id = null);


}