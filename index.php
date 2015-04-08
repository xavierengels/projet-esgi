<?php
ini_set('display_errors', 1);
error_reporting(e_all);
session_start();
require_once('facebook-php-sdk-v4-4.0-dev/autoload.php');
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
FacebookSession::setDefaultApplication('830895360333908', '1708e1395643f03807caab41e9055332');
$helper = new FacebookRedirectLoginHelper('https://projet-esgi.herokuapp.com/');
$loginUrl = $helper->getLoginUrl();


if(isset($_SESSION) && isset($_SESSION['fb_token']))
{
	$session = new FacebookSession($_SESSION['fb_token']);
	var_dump($session);
}
else
{
	   $session = $helper->getSessionFromRedirect();
      
}	

?>
<html>
<head>
</head>

<body>
<div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false"></div>
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

  <?php
  if($session)
  {
  	 $token = (string) $session->getAccessToken();
     $_SESSION['fb_token'] = $token;
  }
  else
  {
  	 $loginUrl = $helper->getLoginUrl();
     echo "<a href='".$loginUrl."'>Se connecter</a>";
  }
           

    
   ?>
</body>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '830895360333908',
      xfbml      : true,
      version    : 'v2.3'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/fr_FR/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

</html>