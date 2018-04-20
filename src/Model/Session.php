<?php
namespace App\Model;
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 22/03/2018
 * Time: 09:34
 */

class Session{

   /* public function __construct(){
        session_start();
    }*/

    public function setFlash($message,$type = 'error'){
        $_SESSION['flash'] = array(
            'message' => $message,
            'type'	  => $type
        );
    }

    public function flash(){
        if(isset($_SESSION['flash'])){
            ?>
            <div id="alert" class=" alert alert-<?php echo $_SESSION['flash']['type']; ?>">
                <a class="close" id="crossClose">x</a>
                <?php echo $_SESSION['flash']['message']; ?>
            </div>
            <?php
            unset($_SESSION['flash']);
        }
    }

}