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
    <h3>プレイヤー一覧</h3>
    <div class="text_box">
      <?php
        try{
            $dsn = 'mysql:dbname=the_mind;host=localhost;charset=utf8';
            $user = 'root';
            $password = 'usbw';
            $dbh = new PDO($dsn,$user,$password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql_t = 'SELECT team_code,team_name FROM team WHERE 1';
            $stmt_t = $dbh -> prepare($sql_t);
            $stmt_t -> execute();

            $dbh = null;

            print'<form method="post" action="the_mind_game.php">';
              $i=1;
              while(true){
                $rec = $stmt_t -> fetch(PDO::FETCH_ASSOC);
                if($rec==false){
                  break;
                }
                print'<div class="team_radio">';
                  print'<ul>';
                    print'<li class="list_item">';
                      print'<input type="radio" class="option-input" name="team_code" id="team_list'.$i.'"　value="'.$rec['team_code'].'">';
                      print'<label for="team_list'.$i.'">'.$rec["team_name"].'</label>';
                      print'<br />';
                    print'</li>';
                  print'</ul>';
                print'</div>';
                $i++;
              }
              print'<input type="submit" value="このチームで挑戦する">';
            print'</form>';
        }
        catch(Exception $e){
          print"ただいま障害により大変ご迷惑をおかけしております。";
          exit();
        }
      ?>
    </div>
  </body>
</html>
