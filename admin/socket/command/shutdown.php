<?php
    namespace Massawe\Command;

    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface;
    require "device.php";
    
    class Shutdown implements MessageComponentInterface {
        protected $clients;
    
        public function __construct() {
            $this->clients = new \SplObjectStorage;
            echo "Server Started.";
        }
    
        public function onOpen(ConnectionInterface $conn) {
            // Store the new connection to send messages to later
            $this->clients->attach($conn);
            echo "New connection! ({$conn->resourceId})\n";
        }
    
        public function onMessage(ConnectionInterface $from, $msg) {
            foreach ($this->clients as $client) {
                if ($from !== $client) {
                    // The sender is not the receiver, send to each client connected
                    $client->send(json_encode($msg));
                }
            }
        }
    
        public function onClose(ConnectionInterface $conn) {
            // The connection is closed, remove it, as we can no longer send it messages
            $this->clients->detach($conn);
            echo "Connection {$conn->resourceId} has disconnected\n";
        }
    
        public function onError(ConnectionInterface $conn, \Exception $e) {
            echo "An error has occurred: {$e->getMessage()}\n";
            $conn->close();
        }
    }
?>    