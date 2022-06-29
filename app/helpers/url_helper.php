<?php
//simple page redirect
    function redirect($loc){
        header('location: '.URLROOT.'/'.$loc);
    }