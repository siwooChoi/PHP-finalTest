
     <link href="./css/detail.css" type="text/css" rel="stylesheet">

  </head>

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

// get으로 어떤 상품을 클릭했는지 판단 (이미지이름)  컨트롤서포트  로 값을 넘겨야된다.
if(isset($_GET['myBasket_pd'])){
  // $getimgname = $_GET['mode'];
  // $explode_imgname = explode(".", $getimgname);
  $pnum = $detail_num;


} else{
  echo "<script>alert('상품에 대한 상세정보를 찾을 수 없습니다.')</script>";
  echo "<script> history.go(-1); </script>";
}



// 같은 이미지이름을 찾고 사용할수 있게 변수에 값을 넣는다.


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
              <?php echo $detail_detail; ?><br>
            </td>
          </tr>
        </table>
    </div>


    <!-- 구매하기, 장바구니버튼   일단은 submit 이 아니라 button 으로 설정해놓았음-->
    <form action="./index.php?buy=<?php echo $detail_number; ?>~<?php  echo $detail_name; ?>" method="post">

          <input type="submit" value="구매하기">
        </form>
    </div>

    <div style="" class="back">
        <form class="" action="./index.php" method="post">
          <input type="submit" value="메인으로">
        </form>
    </div>

  </body>
  </html>
