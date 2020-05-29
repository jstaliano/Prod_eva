<?php


function make_hash($str)
{
    return sha1(md5($str));
}
 
 
function isLoggedIn()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true):
    
        return false;
    else:
        $HoraAgora=date('H:i:s');
        $output= (strtotime($HoraAgora) - strtotime($_SESSION['tempo']));
        if ($output>50000):
            echo "<meta http-equiv=refresh content='0;URL=logout.php?logmeout'>";
            return false;
        else:
            $_SESSION['tempo'] = date('H:i:s');
            return true;
        endif;
    endif;

}
function session_checker(){

	if(!isset($_SESSION['id'])):

		header ("Location:guarucoop.com.br/webtaxi/form-login.php");

		exit(); 
    endif;

}

function verifica_email($EMAIL){

    list($User, $Domain) = explode("@", $EMAIL);
    $result = @checkdnsrr($Domain, 'MX');

    return($result);

}

?>