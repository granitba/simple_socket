<?php
$address="127.0.0.1";
$port="3333";

if ($argc > 1) {      // If there is a command line argument set the message to that
    $msg = $argv[1];
} else {
    $msg="Hello";     // If not default to "Hello"
}


$sock=socket_create(AF_INET,SOCK_STREAM,0) or die("Cannot create a socket"); // Open a tcp socket
socket_connect($sock,$address,$port) or die("Could not connect to the socket");                   // Connect to socket opened on serv.php

socket_write($sock,$msg);               //Write our message to the socket
$read=socket_read($sock,1024);   // Read the response
echo $read;
socket_close($sock);