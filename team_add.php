<!DOCTYPE html>
<html>
  <head>
    <link href="the_mind_team.css" rel="stylesheet" type="text/css" media="all">
    <meta charset="utf-8">
    <title>The Mind</title>
  </head>
  <body>
    <!--チームの人数を受け取ってチェックする場所-->
    <div class="text_box">
      <?php
        try{
          $hmp=$_GET["hmp"];
          if($hmp<1||$hmp>10||preg_match('/\A[0-9]+\z/',$hmp)==0){
            echo'<p>リンクはいじらないでね。</p>';
            echo'<a href="start.html">すいませんでした</a>';
            exit();
          }
        }
        catch(Exception $e){
          echo'<p>チームの人数を受け取って処理を行う際に問題が発生しました。</p>';
          exit();
        }
      ?>
    </div>
    <div class="title">
      <h1>The Mind</h1>
    </div>
    <h3>プレイヤー登録画面</h3>
    <div class="text_box">
    <h3>チーム名</h3>
      <!--team_add_checkに値を送る場所-->
      <form method="post" action="team_add_check.php">
        <input type="text" name="team_name">
        <?php
          echo'<input type="hidden" name="hmp" value="'.$hmp.'">';
          try{
            for($i=1; $i<=$hmp; $i++){
              echo'<p>プレイヤー'.$i.'の名前</p>';
              echo'<input type="text" name="name'.$i.'">';
              echo'<br />';
            }
          }
          catch(Exception $e){
            echo'テキストボックスを表示する際に問題が発生しました。</p>';
            exit();
          }
        ?>
        <input type="submit" value="チーム登録">
      </form>
    </div>
  </body>
</html>
