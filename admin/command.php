<?php
	function msConnectSocket($remote, $port, $timeout = 30) {
	        # this works whether $remote is a hostname or IP
	        $ip = "";
	        if( !preg_match('/^\d+\.\d+\.\d+\.\d+$/', $remote) ) {
	            $ip = gethostbyname($remote);
	            if ($ip == $remote) {
	                $this->errstr = "Error Connecting Socket: Unknown host";
	                return NULL;
	            }
	        } else $ip = $remote;

	        if (!($this->_SOCK = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP))) {
	            $this->errstr = "Error Creating Socket: ".socket_strerror(socket_last_error());
	            return NULL;
	        }

	        socket_set_nonblock($this->_SOCK);

	        $error = NULL;
	        $attempts = 0;
	        $timeout *= 1000;  // adjust because we sleeping in 1 millisecond increments
	        $connected;
	        while (!($connected = @socket_connect($this->_SOCK, $remote, $port+0)) && $attempts++ < $timeout) {
	            $error = socket_last_error();
	            if ($error != SOCKET_EINPROGRESS && $error != SOCKET_EALREADY) {
	                $this->errstr = "Error Connecting Socket: ".socket_strerror($error);
	                socket_close($this->_SOCK);
	                return NULL;
	            }
	            usleep(1000);
	        }

	        if (!$connected) {
	            $this->errstr = "Error Connecting Socket: Connect Timed Out After $timeout seconds. ".socket_strerror(socket_last_error());
	            socket_close($this->_SOCK);
	            return NULL;
	        }
	       
	        socket_set_block($this->_SOCK);

	        return 1;     
	}
?>