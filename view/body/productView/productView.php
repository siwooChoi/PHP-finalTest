
    <table class='main_product'  width="850px" height="700px" style="margin-left:10px; margin-top:20px;" border="1px white solid">
    <!-- <form action="./index.php?mode=basket" method="post"> -->

  <?php

      $productCount = 1;

      /*  [0] --> Num,  [1] --> Name,   [2] --> Price,   [3] --> comment
          [4] --> Type,   [5] --> Amount,  --> [6] --> ImgName   [7] --> Detail  */

      for($i = 0 ; $i < $this->rowCount; $i++){
        if($i % 3 == 0){
          echo "<tr>";
        }

        ?>
          <form action="./index.php?mode=basket" method="post">
  <td width=33%>  <!-- 각각의 큰 틀 -->
    <p style='text-align:center'><?php  echo $this->productValuesArray[1][$i]; ?>

    </p>  <!-- 메인 상품명 -->
      <table border="solid white 5px" style="" >
        <tr>
          <td>
              <a href='./index.php?product=<?php echo $this->productValuesArray[0][$i]; ?>'>
                <img width="200px" height="200px" src='./imgs/<?php echo $this->productValuesArray[6][$i];  ?>' >
                <input type="hidden" name="insertBasket_pNumber" value="<?php  echo $this->productValuesArray[0][$i]; ?>">
                <input type="hidden" name="insertBasket_pName" value="<?php  echo $this->productValuesArray[1][$i]; ?>">
                <input type="hidden" name="insertBasket_pPrice" value="<?php  echo $this->productValuesArray[2][$i]; ?>">
                <input type="hidden" name="insertBasket_pComment" value="<?php  echo $this->productValuesArray[3][$i]; ?>">
                <input type="hidden" name="insertBasket_pType" value="<?php  echo $this->productValuesArray[4][$i]; ?>">
                <input type="hidden" name="insertBasket_pAmount" value="<?php  echo $this->productValuesArray[5][$i]; ?>">
                <input type="hidden" name="insertBasket_pImgname" value="<?php  echo $this->productValuesArray[6][$i]; ?>">
                <input type="hidden" name="insertBasket_pDetail" value="<?php  echo $this->productValuesArray[7][$i]; ?>">
                <input type="hidden" name="rowCount" value="<?php  echo $this->rowCount; ?>">
                <input type="hidden" name="row" value="<?php  echo $this->productValuesArray; ?>">

              </a>
          </td>

          <td style="text-align:center" width="70%">
            <?php
            echo $this->productValuesArray[3][$i]; ?>
          </td>
        </tr>
        <tr>
          <td style="text-align:center">
            판매가격 : <?php echo $this->productValuesArray[2][$i]; ?> <br>
            남은 수량 : <?php echo $this->productValuesArray[5][$i]; ?>
          </td>
          <td>
            <table>
              <tr><td>

<?php if( isset($_SESSION['userid']) && $_SESSION['userid'] != "admin") { ?>
              <input type="submit" value="장바구니">
                <input type="hidden" name="insertBasket_pNumber" value="<?php  echo $this->productValuesArray[0][$i]; ?>">
                <input type="hidden" name="insertBasket_pName" value="<?php  echo $this->productValuesArray[1][$i]; ?>">
                <input type="hidden" name="insertBasket_pPrice" value="<?php  echo $this->productValuesArray[2][$i]; ?>">
                <input type="hidden" name="insertBasket_pComment" value="<?php  echo $this->productValuesArray[3][$i]; ?>">
                <input type="hidden" name="insertBasket_pType" value="<?php  echo $this->productValuesArray[4][$i]; ?>">
                <input type="hidden" name="insertBasket_pAmount" value="<?php  echo $this->productValuesArray[5][$i]; ?>">
                <input type="hidden" name="insertBasket_pImgname" value="<?php  echo $this->productValuesArray[6][$i]; ?>">
                <input type="hidden" name="insertBasket_pDetail" value="<?php  echo $this->productValuesArray[7][$i]; ?>">  <?php } ?>
            </form>
          </td>


<?php       if( isset($_SESSION['userid']) && $_SESSION['userid'] != "admin"){ ?>
          <td>
            <form action="./index.php?buy=<?php  echo $this->productValuesArray[0][$i]; ?>~
                                          <?php  echo $this->productValuesArray[1][$i]; ?>" method="post">
              <input type="submit" value="구매하기">
            </form>
          </td>
          </td>
        </tr>
<?php }

       if(isset($_SESSION['userid']) && $_SESSION['userid'] == "admin"){ ?>
        <tr>
          <td>
            <form action="./index.php?product_delete=
                          <?php  echo $this->productValuesArray[0][$i]; ?>~
                          <?php  echo $this->productValuesArray[1][$i]; ?>" method="post">
              <input type="submit" value="판매정보 삭제">
            </form>
          </td>
        </tr>
<?php }?>
      </table>

      </table>
    </td>
    </td>

  <?php
  if($productCount % 3 == 0){
    echo "</tr>";
  }
  $productCount++;
}//for end
echo "</table>";
  ?>
