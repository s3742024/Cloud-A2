<?php

// Disclaimer: This is an university assignment application that 
//             is developed based on the booktshelf tutorial provided by google cloud. 

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>A2-PRO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <style>
    body {
      background: url('https://images.unsplash.com/photo-1500964757637-c85e8a162699?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1920&h=1080&fit=crop&ixid=eyJhcHBfaWQiOjF9') no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      background-size: cover;
      -o-background-size: cover;
    }
  </style>

  input {
    border: 1px solid rgba(0, 0, 0, 0.5);
}
input.notfound {
    border: 2px solid rgba(255, 0, 0, 0.4);
}
#map-canvas, #map_canvas {
    height: 100%;
    width:100%;
}

</head>


<body>
  <div class="navbar navbar-default fixed-top " style="background-color:#c07e5a">
    <div class="container">

      <div class="navbar-header">
        <div class="navbar-brand">
          <a href="/" class="text-white "><b>Personal Receipt Organiser</b></a>
        </div>
      </div>

      <ul class="nav navbar-nav">
        <li><a href=" " class="text-white">
            <svg class="bi bi-person" width="1.3em" height="1.3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM8 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
          </a></li>
      </ul>
    </div>
  </div>

  <br>
  <br>
  <div class="container bg-light">
    <?= $content ?>
  </div>

</body>

</html>