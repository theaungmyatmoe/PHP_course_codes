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

<p></p>
<button id="btn">Fetch</button>

<script>
  let p = document.querySelector('p');
  let btn = document.querySelector('#btn');
  btn.addEventListener('click',fetchJSON);
  
  function fetchJSON(){
   let url = "http://localhost:8080/PHP%20MTK/json.php";
   let req = new XMLHttpRequest();
   
  req.onload = ()=>{
    if(req.status == 200){
      let str = '';
      let responseTxt = req.responseText;
      let json = JSON.parse(responseTxt);
      
      json.forEach(result=>{
        str += `
        <ul>
        <li>${result.name}</li>
        </ul>
        `;
      })
      p.innerHTML = str;
    }
  }
  req.open('GET',url);
  req.send();
  }
  
</script>
</body>
</html>