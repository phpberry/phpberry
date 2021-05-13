<?php
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}
/*******************************************************************
 * FLASH DATA
 *******************************************************************/
/* flash( 'variable', 'message' );
   display flash( 'variable' );    */
if (!session_id()) {
    session_start();
}
function flash($name = '', $message = '')
{
    //We can only do something if the name isn't empty
    if (!empty($name)) {
        //No message, create it
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            $_SESSION[$name] = $message;
        } //Message exists, display it
        elseif (!empty($_SESSION[$name]) && empty($message)) {
            echo $_SESSION[$name];
            unset($_SESSION[$name]);
        }
    }
}

/*******************************************************************
 * DATA IN SEGMENT
 *******************************************************************/
function segment($index = null)
{
    if (isset($_SERVER['PATH_INFO'])) {
        $segment = explode('/', substr($_SERVER['PATH_INFO'], 1));
        return $segment[$index];
    }
}

/*******************************************************************
 * FOURCE FULL REDIRECT
 *******************************************************************/
function redirect($URL = null)
{
    header("Location: $URL");
    exit();
}
/*******************************************************************/  