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
    <!--値を受け取る場所-->
    <?php
      try{
        require_once('../common/common_the_mind.php');
        $post=sanitize($_POST);
        $name_miss=0;
        $team_flag=0;
        $hmp=$post["hmp"];
        $team_name=$post["team_name"];
      }
      catch(Exception $e){
        echo'<p>値の受け取り時に問題が発生しました。</p>';
        exit();
      }
    ?>
    <!--入力されたかされてないかをチェックする場所-->
    <?php
      try{
        if($team_name==""){
          $team_flag=1;
        }
        for ($i=1; $i<=$hmp; $i++) {
          $player_name_tmp[]=$post["name$i"];
          if ($player_name_tmp[$i-1]=="") {
            $failed_number_tmp[]=$i;
            $name_miss++;
          }
        }
      }
      catch(Exception $e){
        echo'<p>値の処理時に問題が発生しました。</p>';
        exit();
      }
    ?>
    <!--テキストを表示する場所-->
    <?php
      try{
        if($team_flag||$name_miss>0){
          if($team_flag){
            echo'<h4>チーム名が入力されていません。</h4>';
            echo'<br />';
          }
          for($i=0; $i<$name_miss; $i++){
            $number=$failed_number_tmp[$i];
            echo'<h4>プレイヤー'.$number.'の名前が入力されていません。</h4>';
            echo'<br />';
          }
          echo'<div class="explain">';
            echo'<h3>以上の原因によりチーム登録の準備が完了しませんでした。</h3>';
            echo'<h3>「修正」は下のボタンをクリックしてください。</h3>';
          echo'</div>';
        }else{
          echo'<div class="explain">';
            echo'<h3>チームの登録の準備が完了しました。</h3>';
            echo'<h4>下のボタンをクリックしてください。</h4>';
          echo'</div>';
        }
      }
      catch(Exception $e){
        echo'<p>テキスト表示の際に問題が発生しました。</p>';
        exit();
      }
    ?>
    <div class="text_box">
      <!--team_add_failed.phpに値を送る場所-->
      <form action=<?php if($team_flag==1||$name_miss>0){echo'team_add_failed.php';}else{echo'team_add_done.php';} ?> method="post">
        <?php
          try{
            echo'<input type="hidden" name="hmp" value="'.$hmp.'">';
            echo'<input type="hidden" name="team_name" value="'.$team_name.'">';
            echo'<input type="hidden" name="name_miss" value="'.$name_miss.'">';
            for($i=0; $i<$hmp; $i++){
              echo'<input type="hidden" name="player_name[]" value="'.$player_name_tmp[$i].'">';
            }
            for($i=0; $i<$name_miss; $i++){
              echo'<input type="hidden" name="failed_number[]" value="'.$failed_number_tmp[$i].'">';
            }
            if($team_flag||$name_miss>0){
              echo'<input type="submit" value="修正">';
            }else{
              echo'<input type="submit" value="次に進む">';
            }
          }
          catch(Exception $e){
            echo'<p>formタグの内部にて問題が発生しました。</p>';
            exit();
          }
        ?>
      </form>
    </div>
  </body>
</html>
