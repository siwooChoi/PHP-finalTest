
           <link href="./css/detail.css" type="text/css" rel="stylesheet">
           <?php



        $num = $_GET['product'];

        $row = $this->productValuesArray;
        $rowCount = $this->rowCount;

      // 같은 이미지이름을 찾고 사용할수 있게 변수에 값을 넣는다.

      for($i = 0 ; $i<$rowCount;$i++){

        if($num == $row[0][$i]){
          $detail_num = $row[0][$i];
          $detail_name = $row[1][$i];
          $detail_price = $row[2][$i];
          $detail_comment = $row[3][$i];
          $detail_type = $row[4][$i];
          $detail_amount = $row[5][$i];
          $detail_image = $row[6][$i];
          $detail_detail = $row[7][$i];
        }
      }
      // 판단에 성공한 상품의 상세표시이미지를 만든다.

        ?>

              <!-- 상품명 -->
          <div style="font-size:35px;" class="p_name">
              <table border="solid black 1px" style="" >
                <tr>
                  <td>
                    <?php echo $detail_name; ?><br>
                  </td>
                </tr>
              </table>
          </div>


            <!-- 상품이미지 -->
          <div style="" class="p_img">
              <table border="solid black 1px" style="" >
                <tr>
                  <td>
                    <img width="300px" height="300px" src="./imgs/<?php echo $detail_image; ?>">  <br>
                  </td>
                </tr>
              </table>
          </div>


          <!-- 코멘트 -->
          <div style="" class='detail_com'>
              <table style="" >
                <tr>
                  <td>
                    <?php echo $detail_name; ?><br>
                  </td>
                </tr>
              </table>
          </div>
          <!-- 가격 -->
          <div style="" class='detail_price_text'>가격  </div>

          <div style="" class='detail_price'>
              <table >
                <tr>
                  <td>
                    <?php echo $detail_price; ?><br>
                  </td>
                </tr>
              </table>
          </div>

          <!-- 수량 -->
          <div  class='detail_amount_text'> 남은 수량  </div>
          <div style="" class='detail_amount'>
              <table  style="" >
                <tr>
                  <td>
                    <?php echo $detail_amount; ?><br>
                  </td>
                </tr>
              </table>
          </div>

          <!-- 종류 -->
          <div style="" class='detail_type_text'> 종류  </div>
          <div style="" class='detail_type'>
              <table style="" >
                <tr>
                  <td>
                    <?php echo $detail_type; ?><br>
                  </td>
                </tr>
              </table>
          </div>

          <!-- 상세 설명 -->
          <div style="" class='detail_text'>
              <table border="solid black 1px" style="width:450px; height:150px" >
                <tr>
                  <td>
                    <?php echo $detail_detail ?><br>
                  </td>
                </tr>
              </table>
          </div>


<?php if( isset($_SESSION['userid']) && $_SESSION['userid'] != "admin"){ ?>
          <div style="" class='detail_buy'>
              <form action="./index.php?buy=<?php  echo $this->productValuesArray[0][$i]; ?>~<?php  echo $this->productValuesArray[1][$i]; ?>" method="post">
                <input type="submit" value="구매하기">
              </form>
          </div>

          <div  class='detail_basket'>
              <form action="./index.php?mode=basket" method="post">
                <input type="submit" value="장바구니">
                <input type="hidden" name="insertBasket_pName" value="<?php  echo $detail_num; ?>">
                <input type="hidden" name="insertBasket_pName" value="<?php  echo $detail_name; ?>">
                <input type="hidden" name="insertBasket_pPrice" value="<?php  echo $detail_price; ?>">
                <input type="hidden" name="insertBasket_pComment" value="<?php  echo $detail_comment; ?>">
                <input type="hidden" name="insertBasket_pType" value="<?php  echo $detail_type; ?>">
                <input type="hidden" name="insertBasket_pAmount" value="<?php  echo $detail_amount; ?>">
                <input type="hidden" name="insertBasket_pImgname" value="<?php  echo $detail_image; ?>">
                <input type="hidden" name="insertBasket_pName" value="<?php  echo $detail_detail; ?>">
              </form>
          </div>
<?php } ?>
<?php if(isset($_SESSION['userid']) && $_SESSION['userid'] == "admin"){ ?>

      <form action="./index.php?product_delete=<?php  echo $this->productValuesArray[0][$i]; ?>~<?php  echo $this->productValuesArray[1][$i]; ?>" method="post">
        <input type="submit" value="판매정보 삭제">
      </form>

<?php }?>

          <div style="" class="back">
              <form class="" action="./index.php" method="post">
                <input type="submit" value="메인으로">
              </form>
          </div>
