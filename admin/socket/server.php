<?php

  $host = "192.168.137.158";
  $port = 20205;

  // No Timeout
  set_time_limit(0);

  // Create Socket
  $sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

  // Bind the socket to port and host
  $result = socket_bind($sock, $host, $port) or die("Could not bind to socket\n");

  // Start listening to the port
  $result = socket_listen($sock, 3) or die("Could not set up socket listener\n");
  echo "Listening for connections";

  class Chat
  {
    
    function readline()
    {
      return rtrim(fgets(STDIN));
    }
  }

  do{

    // Make it to accept incoming connection
    $accept = socket_accept($sock) or die("Could not accept incoming connection.");

    // Read the message from the client socket
    $msg = socket_read($accept, 1024) or die("Could not read input\n");

    $msg = trim($msg);
    echo "Client says:\t".$msg."\n\n";

    $line = new Chat();
    echo "Enter Reply:\t";
    $reply = $line->readline();

    // Send message back to client socket
    socket_write($accept, $reply, strlen($reply)) or die("Could not write output\n");

  }while (true); 

  // Close the socket
  socket_close($accept, $sock);

?>