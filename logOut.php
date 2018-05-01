<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 30/04/2018
 * Time: 22:10
 */

session_start();

session_destroy();

header('location:login.html');
?>