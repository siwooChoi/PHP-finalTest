<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
<link href="../../css/createUser_css.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <form action="../../index.php?mode=createUser" method="post">
      <p class="createUser_title">회원 가입</p>
      <table class="createUser_table">
        <tr>
          <td>
      <br>
      I D <input class="createbox1" type="text" name="createId">
             <!-- <input type="button" name="checkId" value="중복확인" onclick="Script_checkid()"> -->
              <br>
      PW <input class="createUserbox2" type="password" name="createPw1"><br>
      PW <input class="createUserbox3" type="password" name="createPw2"><br>
      NAME <input class="createUserbox4" type="text" name="createName"><br>
      NICK <input class="createUserbox5" type="text" name="createNick"><br>
      TEL <input class ="createUsertel1" type="text" name="createTel1" maxlength="3">
              <span class="telofbar1"> - </span>
              <input class="createUsertel2" type="text" name="createTel2" maxlength="4">
              <span class="telofbar2"> - </span>
              <input class="createUsertel3" type="text" name="createTel3" maxlength="4"> <br>
      Email <input class="createUser_email1" type="text" name="createEmail1">  <span class="emailofsea"> @ </span>
             <input class="createUser_email2" type="text" name="createEmail2">
      <br><br><br><br>
      <table>
        <tr><td>
      <input class="create" type="submit" value="가입하기">

    </form>

    <form action="../../index.php" method="post">
    </td><td>
       <input class="cancel" type="submit" value="취소">
     </td></tr>
    </form>
      </table>

    </td>
  </tr>
</table>




  </body>
</html>
