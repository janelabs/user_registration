<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DietCake Starter - User Management</title>

    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">

    <script type="text/javascript" src="/jquery.js"></script>
    <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
    <style>
      body {
        padding-top: 60px;
      }
    </style>
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="<?php eh(url('/')) ?>">User Management</a>
        </div>
      </div>
    </div>

    <div class="container">

      <?php echo $_content_ ?>

    </div>

    <script>
    console.log(<?php eh(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
    </script>

  </body>
</html>
