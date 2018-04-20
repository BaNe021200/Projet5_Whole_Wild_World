<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 26/03/2018
 * Time: 15:01
 */

namespace   App\Model;


class Autoloader
{

   static function register(){

       spl_autoload_register(array(__CLASS__,'autoload'));
   }

    static function autoload($class)
    {

   $class=str_replace('App\Model\\','',$class);


        var_dump($class);

        require_once 'Model/'.$class.'.php';




    }



}

