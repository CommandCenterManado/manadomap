<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="jquery-3.0.0.min.js" charset="utf-8"></script>
    <script src="http://192.168.43.63:3000/socket.io/socket.io.js" charset="utf-8"></script>
  </head>
  <body>
  </body>
  <script type="text/javascript">
    $(document).ready(function(){
      var socket = io.connect("http://192.168.43.63:3000");
    });
  </script>
</html>
