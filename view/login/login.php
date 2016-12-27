<?php



  if(!isset($_SESSION['userid'])){
  ?>
    <table style="margin-top:50px;">
      <tr><td>
       <form action='./index.php?mode=login' method="post">
         I D  <input type="text" name="userid" style="margin-left:3px; width:130px;"><br>
         PW  <input type="password" name="userpw" style="width:130px;">
         <input class='login_button' type="submit" value="로그인" name="login">
       </form>
       <form action="./index.php?mode=callPageCreateUser" method="post">
         <input class="createUser_button" type="submit" value="회원가입" name="createUser">
       </td><tr>
       </form>
     </table>


  <?php
  } else{

      if($_SESSION["userid"] == "admin"){

        ?>

        <table style="margin-top:50px; " >
          <tr>
            <td style="text-align : right"> 관리자 </td>
            <td style="text-align : center "> <?php echo $_SESSION['userid']; ?> </td>
          </tr>
          <tr></tr>
          <tr>
            <td>
              <form action="./index.php?mode=admin_upload" method="post">
                <input type="submit" name = "upload_product" value="상품등록">
              </form>
            </td>

            <td>
              <form action="./index.php?mode=logout" method="post">
                <input type="submit" name = "logout" value="로그아웃">
              </form>
            </td>
          </tr>
        </table>


  <?php
      } else{

        ?>
         <p style="margin-top:80px;"><?php echo "환영합니다! ".$_SESSION["userid"]."( ".$_SESSION['userNick']." ) 님"; ?></p>

         <table style="margin-left:30px;">
           <tr>
             <td>

               <form action="./index.php?mode=CallBeforeUserData" method="post">
                 <input type="submit" name = "modify" value="정보수정"></input>
               </form>
             </td>
              <td>
               <form action="./index.php?mode=logout" method="post">
                 <input type="submit" name = "logout" value="로그아웃"></input>
               </form>
              </td>
           </tr>
           <tr>
             <td>
              <form action="./index.php?mode=myBasket" method="post">
                <input type="submit" name = "myBasket" value="장바구니"></input>
              </form>
             </td>
           </tr>

         </table>

           <?php
         }
  }

?>
