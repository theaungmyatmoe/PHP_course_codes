<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Php Ajaix</title>
  <script src="dist/vconsole.js" type="text/javascript" charset="utf-8"></script>

  <script>
    var vConsole = new VConsole();

  </script>
  <style>
    body{
      user-select: none;
      touch-callout:none;
    }
  </style>
</head>
<body>
  <button onclick="addLike()">Like</button>
  <p></p>


  <script>
    function addLike() {
      let url = "http://localhost:8080/PHP%20MTK/like.php";
      let req = new XMLHttpRequest();
      req.open('GET', url);
      req.onload = function() {
        let p = document.querySelector('p');
        if (req.status == 200) {
          p.innerText = req.responseText;
        }
      }
      req.send();

    }
  </script>
</body>
</html>