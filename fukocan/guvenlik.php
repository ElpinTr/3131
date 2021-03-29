<?
session_start();
if (!session_is_registered("imhatimi_admin_sessionu") && !session_is_registered("imhatimi_pass_sessionu") ){
header ("Location: login.php ");
}
?>