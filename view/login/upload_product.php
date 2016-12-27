
<link href="../../css/uploadProduct_css.css" type="text/css" rel="stylesheet">

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <p class="product_ptag">상품 등록</p>
    <table class="product_table">
      <tr>
        <td>
              <form action="../../index.php?mode=upload_product2" method="post">

              이미지 <input class="p_img" type="text" name="p_imgname">
              <br>
              상품명 <input class="p_name" type="text" name="p_name"><br>
              가격 <input class="p_price" type="text" name="p_price"><br>
              설명 <input class="p_comment" type="text" name="p_comment"><br>

              종류 <select class="p_type" style='width:150px' name="p_type">
                <option value="증류주">증 류 주</option>
                <option value="리큐르">리 큐 르</option>
                <option value="주스및기타">주스 및 기타</option>
              </select><br>
              수량 <input class="p_amount" type="text" name="p_amount"><br><br>
              상세 설명<br>
              <textarea = rows="7" cols="40" class="p_detail" name="p_detail"></textarea>



              <br>
              <input class="upload_button" type="submit" value="등록하기">
            </form>

            <form action="../../index.php" method="post">
              <input class="cancel_button" type="submit" value="돌아가기">
          </td>
        </tr>
            </form>
  </table>

</body>
</html>
