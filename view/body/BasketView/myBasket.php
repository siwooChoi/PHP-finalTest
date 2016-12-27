<!-- <form action="./controlor/controlSupport.php?mode=noSearch" method="post"> -->

<link href="./css/basket_css.css" type="text/css" rel="stylesheet">


    <form action="./controlor/controlSupport.php?mode=basket" method="post">

<!--  -->
  <!-- <table> -->
    <?php

    echo $_SESSION['inBasket_rowCount'];

      if(isset($_SESSION['inBasket_rowCount'])){


        $productCount = 1;

        for($i = 0 ; $i< $_SESSION['inBasket_rowCount']; $i++){

          $pnum = $_SESSION["inBasket_p_Num_$i"];

          if($i % 3 == 0){
            echo "<tr>";
          }

          ?>
<form action="./controlor/controlSupport.php" method="post">
          <td width=33%>  <!-- 각각의 큰 틀 -->
            <p style='text-align:center'><?php  echo $_SESSION["inBasket_p_Name_{$i}"] ?></p>  <!-- 메인 상품명 -->

              <table border="solid black 1px" style="margin-left:50px;" >
                <tr>
                  <td>

                        <img width="200px" height="200px" src="./imgs/<?php echo $_SESSION["inBasket_p_Imgname_$i"];?>" >
                      
                  </td>

                  <td style="text-align:center" width="70%">
                    <?php echo $_SESSION["inBasket_p_Comment_$i"];?>
                  </td>
                </tr>
                <tr>
                  <td style="text-align:center">
                    판매가격 : <?php echo $_SESSION["inBasket_p_Price_$i"];?> <br>
                  </td>
                  <td>
                    <table >
                      <tr><td>

                      <!-- <input type="submit" value="장바구니">
                        <input type="hidden" name="insertBasket_pName" value="<?php//  echo $_SESSION["p_Name_{$i}"]; ?>">
                        <input type="hidden" name="insertBasket_pPrice" value="<?php//  echo $_SESSION["p_Price_{$i}"]; ?>">
                        <input type="hidden" name="insertBasket_pType" value="<?php // echo $_SESSION["p_Type_$i"]; ?>">
                        <input type="hidden" name="insertBasket_pAmount" value="<?php//  echo $_SESSION["p_Amount_$i"]; ?>">
                        <input type="hidden" name="insertBasket_pImgname" value="<?php // echo $_SESSION["p_Imgname_{$i}"]; ?>"> -->
                    </form>
                  </td>

                  <td>
                    <form action="./index.php?buy=<?php  echo $this->productValuesArray[0][$i]; ?>~<?php  echo $this->productValuesArray[1][$i]; ?>" method="post">
                      <input type="submit" value="구매하기">
                    </form>
                  </td>
                  <td>
                    <!-- <form action="./controlor/controlSupport.php?mode=basketProductDelete" method="post">
                      <input type="submit" value="삭제하기">
                    </form> -->
                    <form  action="./index.php?deleteProductNum=<?php echo $pnum; ?>" method="post">
                      <input type="hidden" name="hidden_basketproductdelete">
                      <input type="submit" value="삭제하기">
                    </form>
                  </td>
                    <td style="width:40px;">
                        <!-- 빈공간 -->
                    </td>
                    <td>
                      <?php $regi = substr($_SESSION["inBasket_p_registday_$i"], 0, 10 ); ?>
                     장바구니에 담은 날짜 <?php echo $regi; ?>
                    </td>

                  </td>
                </tr>

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


        } else{

        }
    ?>
<!-- </form> -->
