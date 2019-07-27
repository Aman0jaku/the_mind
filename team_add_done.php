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
    <div class="title">
      <h1>The Mind</h1>
    </div>
    <?php
      try{
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
        print"メンバー登録の際に問題が発生しました。";
        exit();
      }
    ?>
    <div class="text_box">
      <form action="team_list.php" method="post">
        <input type="submit" value="チーム一覧へ進む">
      </form>
    </div>
  </body>
</html>
