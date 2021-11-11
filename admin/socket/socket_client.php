<!-- Socket io -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.3.2/socket.io.js"></script>
<script>
  window.onload = function() {
    console.log("window is loaded");
    const socket = io("ws://192.168.100.5:3000"); //mdm-socket.herokuapp.com

    socket.on("connect", () => {
      // socket.emit("mdm-device-message", {command:"Turn off"});
      window.addEventListener("php-event", function (event){
        console.log("php-event", event.detail);
        const channelId = event.detail.channelId;
        const message = event.detail.message;
        console.log("channelId", channelId);
        console.log("message", message);
        socket.emit(channelId, message);
      });
    });
  }
</script>