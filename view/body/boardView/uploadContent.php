

  <link href="./css/Boardcss.css" type="text/css" rel="stylesheet">

<p style="text-align:center">글 작성</p>


  <div class="create_textbox" id="memo_row1">
    <form  enctype="multipart/form-data" action="./index.php?create_content=yes" method="post" >
      <div id="memo_writer"><span >▷ <?php echo $_SESSION['userNick']; ?></span></div><br>

      글 제목 : <input style="width:500px" type="text" name="boardname"><br><br>
      글 내용 <br>
      <textarea rows="12" cols="100" name="content"></textarea><br>


        <table style="margin-left:35%">
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
                <input class="upb1" type="submit" value="작성하기">
              </td>

    </form>

          <form class="" action="./index.php?mode=view_content" method="post">
              <td>
                <input class="upb2" type="submit" value="취소">
              </td>
         </tr>
     </table>
         </form>
  </div>   <!-- end of memo_row1 -->
