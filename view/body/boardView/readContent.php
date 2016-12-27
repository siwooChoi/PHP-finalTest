<link href="./css/Boardcss.css" type="text/css" rel="stylesheet">

<?php

  if(!isset($_SESSION['userid'])){
    echo "<script>alert('로그인 후 이용하실 수 있습니다..')</script>";
    echo "<script> history.go(-1); </script>";
  }

  if(isset($_GET['messagenum'])){
    $num = $_GET['messagenum'];

  } else{
    echo "<script>alert('글을 읽을 수 없습니다.')</script>";
    echo "<script> history.go(-1); </script>";
  }

  $row = $_SESSION['content_row'];
  $rowCount = $_SESSION['content_rowCount'];

  for($i = 0 ; $i<$rowCount; $i++){
    $_SESSION["c_num_$i"] = $row[$i]["num"];
    $_SESSION["c_id_$i"] = $row[$i]["id"];
    $_SESSION["c_name_$i"] = $row[$i]["name"];
    $_SESSION["c_nick_$i"] = $row[$i]["nick"];
    $_SESSION["c_content_$i"] = $row[$i]["content"];
    $_SESSION["c_registday_$i"] = $row[$i]["regist_day"];

    if($num == $_SESSION["c_num_$i"]){
      $c_num = $_SESSION["c_num_$i"];             // 글 번호
      $c_id = $_SESSION["c_id_$i"];               // 글 작성자 id
      $c_name = $_SESSION["c_name_$i"];           // 글 제목
      $c_Nick = $_SESSION["c_nick_$i"];           // 글쓴이 닉네임
      $c_content = $_SESSION["c_content_$i"];     // 글 내용
      $c_registday = $_SESSION["c_registday_$i"]; // 글 작성시간
    }
  }


 ?>

  <table class='ftable' border="1px solid black">
    <tr>
      <td style="width:20%">
        글 번호 : <?php  echo $c_num;  ?>
      </td>
      <td style="width:50%">
        글 제목 : <?php  echo $c_name;  ?>
      </td>
      <td style="width:30%">
        작성 시간 : <?php  echo $c_registday;  ?>
      </td>
      <tr>
        <td style="width:20%">
          <!-- 빈공간 -->
        </td>
        <td style="width:50%">
          <!-- 빈공간 -->
        </td>
      <td style="width:30%">
        글쓴이 : <?php echo $c_id." ";
                      echo "( ".$c_Nick." )"; ?>
      </td>
    </tr>
    </tr>
  </table>

  <table  class='ftable2 'border="1px solid black">
<tr>
  <td style="width:15%">
    <!-- 빈공간 -->
  </td>
  <td style="width:70%; height:250px;">
    <?php echo $c_content; ?>
  </td>
  <td style="width:15%">
    <!-- 빈공간 -->
  </td>
</tr>
  </table>

  <table  border="1px solid black">
    <tr>
      <td style="width:80%">
        <!-- 빈공간 -->
      </td>

      <?php  if(($c_id == $_SESSION['userid']) || ($_SESSION['userid'] == "admin")) {?>
      <td>

    <form  action="./index.php?mode=modifyContent" method="post">
      <input type="hidden" name="c_num" value="<?php echo $c_num; ?>">
      <input type="hidden" name="c_id" value="<?php echo $c_id; ?>">
      <input type="hidden" name="c_name" value="<?php echo $c_name; ?>">
      <input type="hidden" name="c_Nick" value="<?php echo $c_Nick; ?>">
      <input type="hidden" name="c_content" value="<?php echo $c_content; ?>">
      <input type="hidden" name="c_registday" value="<?php echo $c_registday; ?>">


      <input class="read_modi" type="submit" value="수정하기">
    </form>
    </td>
    <td>
      <form  action="./index.php?deletecontentPage=<?php echo $c_num; ?>" method="post">
        <input type="hidden" name="hidden_Contentdelete">
        <input class="read_dele" type="submit" value="삭제하기">
      </form>
    </td>
  <?php }   else { ?>
    <td style="width:13%">
      <!-- 빈공간 -->
    </td>

  <?php }    ?>
    <td>

      <form  action="./index.php?mode=view_content" method="post">
        <input class="read_back" type="submit" value="목록으로">
      </form>
    </td>
  </tr>
  </table>

<?php
// $_FILES['userfile']['name'];
  // print_r($_SESSION['userfile']);
  // var_dump($_SESSION['userfile']);  echo "<br>";

  echo "<br><br><br>";
?>
