<?php

abstract class  Controller
{
    protected $db;

    abstract function __construct();

    abstract function loadDB();


}