<?php
// Unifi connection details
$unifi = array(
            'unifiServer'  => "https://<HOSTNAME>:443", // Unifi controller ip or url address
            'unifiUser'    => "", // Unifi user name
            'unifiPass'    => "", // Unifi user password
            'unifiPortal'  => "default" // Unifi portal name
        );
// Unifi default connection parameters
$clientParam = array(
            'up'            => "1024",
            'down'          => "2548",
            'sessionTime'   => "600"
        );
$ulrRedirect = 'http://365.donnu.edu.ua'; // Default url for redirect

// Non-authenticated users
$vipUsers = array(
             array(
                'mac'         => "80:c5:e3:ac:85:c1", // User MAC
                'userName'    => "User 1", // User Name
                'up'          => "2048", // Upload speed
                'down'        => "5000", //Download speed
                'sessionTime' => "600" // Session time
            )
        );
?>