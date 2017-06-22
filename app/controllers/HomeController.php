<?php

class HomeController extends BaseController
{
    function index()
    {
        require APP . 'view/home/index.php';
    }
}