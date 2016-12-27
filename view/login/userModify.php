<?php
  session_start();
?>


<link href="../../css/modify_css.css" type="text/css" rel="stylesheet">

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

  </head>
<div id="modify_bg">
  <table class="modify_title" border="1px solid black">
    <tr><td >
      정 보 수 정
    </td></tr>
  </table>

  <body>

    <form class="modify_form" action="../../index.php?mode=userModify" method="post">

    <br>
      I &nbsp D  <b class="modifybox1"><?php echo $_SESSION['userid']?></b><br>
      P W   <input class="modifybox2" type="password" name="modifyPw1" style="width:140px; text-align:center;"><br>
      P W   <input class="modifybox3" type="password" name="modifyPw2" style="width:140px; text-align:center;"><br>
      NAME <input class="modifybox4" type="text" style="width:140px; text-align:center;" name="modifyName" value="<?php echo $_SESSION['beforeName']; ?>"><br>
      NICK <input class="modifybox5" type="text" name="modifyNick" style="width:140px; text-align:center;" value="<?php echo $_SESSION['beforeNick']; ?>"><br>
      TEL <input class="modifytel1"  type="text" name="modifyTel1" value="<?php echo $_SESSION['beforeTel1'] ?>" maxlength="3">
          <span class="telofbar1">-</span>
              <input class="modifytel2"  type="text" name="modifyTel2" value="<?php echo $_SESSION['beforeTel2'] ?>" maxlength="4">
          <span class="telofbar2">-</span>
              <input class="modifytel3"  type="text" name="modifyTel3" value="<?php echo $_SESSION['beforeTel3'] ?>" maxlength="4"> <br>
      e-mail: <input class="modify_email1" type="text" name="modifyEmail1" value="<?php echo $_SESSION['beforeEmail1']  ?>">
      <span class="emailofsea">@</span>
             <input class="modify_email2" type="text" name="modifyEmail2" value="<?php echo $_SESSION['beforeEmail2'] ?>">
      <br><br>
      <table style="margin-left:65%">
        <br><br>
            <tr>
                <td>
                    <input type="submit" value="수정하기">
                </td>
        </form>

        <form action="../../index.php" method="post">
                <td>
                   <input type="submit" value="취소">
                </td>
            </tr>
       </form>
  </table>
<br>
      <table>
        <tr>
          <td>
            <form action="../../index.php?mode=deleteUser" method="post">
                <input type="submit" value="회원탈퇴">
            </form>
          </td>
       </tr>
      </table>


</div>
  </body>
</html>
