<?php
/*

This example shows you how to authenticate using the username and password flow.
You are stringly encouraged to read about the different authentication methods
at https://developers.podio.com/authentication to determine which is best for
your use.

To run this example you must perform some quick configuration. Follow these steps:

* Go to https://podio.com/settings/api and create an API client id and client secret. The domain you use must be the domain you will be running these examples under (the domain "localhost" will always work).
* Create a copy of the file config.sample.php and call it config.php
* Open this new config.php and fill in your client id, client secret and your Podio username and password
* Run this file in your browser.

 */
?>
<html>
<head>
  <title>Username and Password authentication example</title>
</head>
<body>
<?php
  // Include the config file and the Podio library
  require_once 'config.php';
  require_once '../PodioAPI.php';

  Podio::setup(CLIENT_ID, CLIENT_SECRET);

  if (!Podio::is_authenticated()) {

    Podio::authenticate('password', array('username' => USERNAME, 'password' => PASSWORD));
    print "You have been authenticated. Wee!<br>";
    $access_token = Podio::$oauth->access_token;
    print $access_token;
  }
  else {
    print "You were already authenticated and no authentication happened. Close and reopen your browser to start over.<br><br>";
  }

  $status = PodioUserStatus::get();
  print $status->user->id;

?>
</body>
</html>
