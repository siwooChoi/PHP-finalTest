<body>
  <link href="./css/Boardcss.css" type="text/css" rel="stylesheet">

<?php
    $c_num   =  $_POST['c_num'];
    $c_id   =  $_POST['c_id'];
    $c_name = $_POST['c_name'];
    $c_Nick =  $_POST['c_Nick'];
    $c_content = $_POST['c_content'];

    $_SESSION['m_id'] = $c_id;
    $_SESSION['m_name'] = $c_name;
    $_SESSION['m_Nick'] = $c_Nick;
    $_SESSION['m_content'] = $c_content;


?>

 <p style="text-align:center"> 글 수정</p>
  <div class="memo_row_modi">
    <form  enctype="multipart/form-data" action="./index.php?modifycontentPage=<?php echo $c_num;?>" method="post" >
      <div id="memo_writer"><span >▷<?php echo $c_id." ( ".$c_Nick." )"; ?> </span></div><br>
      글 번호 : <?php echo $c_num;?><br>
      글 제목 : <input style="width:500px" type="text" name="boardname" value="<?php echo $c_name;?>" ><br><br>
               <input type="hidden" name="before_c_name" value="<?php echo $c_name; ?>">
      글 내용 <br>
      <textarea rows="12" cols="100" name="content"  ><?php echo $c_content; ?></textarea><br>
      <input type="hidden" name="before_c_content" value="<?php echo $c_content; ?>">


        <table style="margin-left:35%" >
            <tr>
                <td>
                  <form>
                      <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                      <input name="userfile" type="file" />

                  </form>
                </td>
            </tr>

          <tr>
              <td>
                <!-- 빈 공간 -->
              </td>
              <td>
                <input class="modi_modi" type="submit" value="수정하기">
              </td>

    </form>

          <form class="" action="./index.php?mode=view_content" method="post">
              <td>
                <input class="modi_can" type="submit" value="취소">
              </td>
         </tr>
     </table>
         </form>
  </div> <!-- end of memo_row1 -->
</body>
