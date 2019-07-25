<?php
  $player_name=$_POST["player_name"];
  $hmp=$_POST["hmp"];
  $team_name=$_POST["team_name"];
?>
<!DOCTYPE html>
<html>
  <head>
    <link href="the_mind_team.css" rel="stylesheet" type="text/css" media="all">
    <meta charset="utf-8">
    <title>The Mind</title>
  </head>
  <body>
    <?php
      try{
        print'<div class="title">';
          print'<h1>The Mind</h1>';
        print'</div>';
        $dsn = 'mysql:dbname=the_mind;host=localhost;charset=utf8';
        $user = 'root';
        $password = 'usbw';
        $dbh = new PDO($dsn,$user,$password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql_t = 'INSERT INTO team(team_name,team_hmp) VALUES (?,?)';
        $stmt_t = $dbh -> prepare($sql_t);
        $data_t[] = $team_name;
        $data_t[] = $hmp;
        $stmt_t -> execute($data_t);

        $team_code = $dbh -> lastInsertId();

        for($i=0; $i<$hmp; $i++){
          $tmp = $player_name[$i];
          $sql_p = 'INSERT INTO player(player_name,team_code) VALUES (?,?)';
          $stmt_p = $dbh -> prepare($sql_p);
          $stmt_p -> bindValue(1,$tmp,PDO::PARAM_STR);
          $stmt_p -> bindValue(2,$team_code,PDO::PARAM_INT);
          $stmt_p -> execute();
        }

        $dbh = null;

      }
      catch(Exception $e){
        print"ただいま障害により大変ご迷惑をおかけしております。";
        exit();
      }
    ?>
  </body>
</html>
