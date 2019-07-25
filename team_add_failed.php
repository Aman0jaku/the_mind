<!--値を受け取ってサニタイジングする場所-->
<?php
  require_once('../common/common_the_mind.php');
  $post=sanitize($_POST);
  $player_name=$post["player_name"];
  $team_name=$post["team_name"];
  $hmp=$post["hmp"];
  $name_miss=$post["name_miss"];
  $i_failed=$post["failed_number"];
?>
<!DOCTYPE html>
<html>
  <head>
    <link href="the_mind_team.css" rel="stylesheet" type="text/css" media="all">
    <meta charset="utf-8">
    <title>The Mind</title>
      <!--styleタグを動的に適用する場所-->
      <?php
        for ($i=0; $i<$name_miss; $i++) {
          echo'<style>';
          echo'.player_name'.$i_failed[$i].'{';
            echo'color:#fe0404;';
          echo'}';
          echo'</style>';
        }
      ?>
  </head>
  <body>
    <div class="title">
    <h1>The Mind</h1>
    </div>
    <h3>プレイヤー再登録画面</h3>
    <div class="text_box">
      <form method="post" action="team_add_check.php">
        <h3>チーム名</h3>
        <!--formタグとtextboxを準備する場所-->
        <?php
          try{
            echo'<input type="text" name="team_name" value="'.$team_name.'">';
            for($i=1; $i<=$hmp; $i++){
              echo'<p class="player_name'.$i.'">プレイヤー'.$i.'の名前</p>';
              echo'<input type="text" name="name'.$i.'" value="'.$player_name[$i-1].'">';
              echo'<br />';
            }
            echo'<input type="hidden" name="hmp" value="'.$hmp.'">';
          }
          catch(Exception $e){
            echo"テキストボックスを表示する際に問題が発生しました。";
            exit();
          }
        ?>
        <input type="submit" value="チーム登録">
      </form>
    </div>
  </body>
</html>
