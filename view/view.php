<?php
  class view{
    private $mainmode;
    private $rowCount;
    private $C_rowCount;
    public $contentValuesArray = array();
    public $productValuesArray = array();

    //생성자로 모든 페이지를 로딩, 파트별로 해당 메서드 실행
    public function __construct(){
      $this->rowCount = 0;
      $this->productValuesArray = array();
      $this->C_rowCount = 0;
      $this->contentValuesArray = array();
    }

        // DB에서 상품에 대한 정보들을 받아와서 페이지 출력
    public function printProductData($argProductValuesArray, $argRowCount){
      $this->rowCount = $argRowCount;

      for($i = 0 ; $i < $this->rowCount; $i++){

        $this->productValuesArray[0][$i] = $argProductValuesArray[0][$i];  // num
        $this->productValuesArray[1][$i] = $argProductValuesArray[1][$i];  // name
        $this->productValuesArray[2][$i] = $argProductValuesArray[2][$i];  // price
        $this->productValuesArray[3][$i] = $argProductValuesArray[3][$i];  // comment
        $this->productValuesArray[4][$i] = $argProductValuesArray[4][$i];  // type
        $this->productValuesArray[5][$i] = $argProductValuesArray[5][$i];  // amount
        $this->productValuesArray[6][$i] = $argProductValuesArray[6][$i];  // imgname
        $this->productValuesArray[7][$i] = $argProductValuesArray[7][$i];  // detail
      }
            ?>
          <link href="./css/index_Css.css" type="text/css" rel="stylesheet">
          <!-- 위의 css 살리며넛 바로 아래쪽 div logo  쪽의 사진 10%를 100%로 다시 바꿔줘야됨 -->

  <div id="main_div">
            <!-- header line-->
        <div id='headerLine'>
                      <!-- logo-->
                      <div id='logo'>
                        <a href="./index.php">
                          <img src="./imgs/bg/bg6.jpg" height="100%" width="100%">
                        </a>
                      </div>
            <!-- search?? -->
              <div id='search'>
                <?php require_once "./view/search/search.php"; ?>
              </div>
            <!-- login-->
              <div id='login'>
                <?php $this->login(); ?>
              </div>
        </div> <!--headerLine 끝나는 지점-->

                  <div id='menu'>
                    <a href="./index.php?mode=bodyview"><div class='menulist'> 메인 화면 </div></a>
                    <div class='menulist'> 메 뉴 1 </div>
                    <a href="./index.php?mode=view_content"><div class='menulist'> 자유 게시판</div></a>
                    <div class='menulist'> 메 뉴 3 </div>
                  </div>

          <!-- body line-->
          <div id='bodyLine'>
            <?php



            if(isset($_GET['mode'])){

              $mode = $_GET['mode'];

              switch ($mode) {
                case 'bodyview':    //메뉴1(메인으로)
                  require_once "./view/body/productView/productView.php";
                  break;

                  require_once "./view/body/productView/productView.php";
                  break;

                case 'viewMyBasket' :
                  require_once "./view/body/BasketView/myBasket.php";
                  break;

                case 'modifyContent':
                  require_once "./view/body/boardView/modifyContent.php";
                  break;

                case 'searchView':
                  require_once "./view/body/productView/searchView.php";
                  break;

              }
            } else{
                  // 상품 상세보기
              if(isset($_GET['product'])){
                  require_once "./view/body/productView/product_detail.php";
              }
              //     // 장바구니에서 상품상세보기
              // else if(isset($_GET['myBasket_pd'])){
              //   require_once "./view/body/BasketView/mybasket_p_d.php";
              // }
                  // 아무런 값이 없을 때에는 상품메인 보여주기
              else{
                // require_once "./view/body/productView/productView.php";
              }
            }




            ?>
          </div>
  </div>

<?php
    }





                                  //arg로받은 배열은 값있음
    public function printContentData($argContentValuesArray, $arg_C_rowCount){
      // echo "그냥 로우카운트".$rowCount."<br>";          //값이없음.
      // echo "디스 로우카운트".$this->rowCount."<br>";    //상품의 행숫자가 들어가있음 (현재는 16)
      // echo "매개변수받은것 ".$arg_C_rowCount."<br>";    //컨텐츠의 행숫자가 들어가있음 (현재는 11)

          // echo "그냥 컨텐츠배열".$contentValuesArray[0][0]."<br>";         //빈값
          // echo "매개변수 컨텐배열".$argContentValuesArray[0][0]."<br>";    //23 이라는값 있음.(글번호)
          // echo "디스 컨텐츠배열".$this->contentValuesArray[0][0]."<br>";   //언디파인트 offset:0 에러
      $this->C_rowCount = $arg_C_rowCount;
      // echo "디스 로우카운트".$this->C_rowCount."<br>";   // 컨텐츠 행숫자로 값이 바뀜 (현재는 11)
      $tempArray = array();

      for($i = 0 ; $i < $this->C_rowCount; $i++){

        $this->contentValuesArray[0][$i] = $argContentValuesArray[0][$i];  // num
        $this->contentValuesArray[1][$i] = $argContentValuesArray[1][$i];  // id
        $this->contentValuesArray[2][$i] = $argContentValuesArray[2][$i];  // name
        $this->contentValuesArray[3][$i] = $argContentValuesArray[3][$i];  // nick
        $this->contentValuesArray[4][$i] = $argContentValuesArray[4][$i];  // content
        $this->contentValuesArray[5][$i] = $argContentValuesArray[5][$i];  // regist
        // $this->contentValuesArray[0][$i] = $argContentValuesArray[0][$i];  // num
        // $this->contentValuesArray[1][$i] = $argContentValuesArray[1][$i];  // id
        // $this->contentValuesArray[2][$i] = $argContentValuesArray[2][$i];  // name
        // $this->contentValuesArray[3][$i] = $argContentValuesArray[3][$i];  // nick
        // $this->contentValuesArray[4][$i] = $argContentValuesArray[4][$i];  // content
        // $this->contentValuesArray[5][$i] = $argContentValuesArray[5][$i];  // regist
                            //   이제야 값이 들어감.

                        // echo $contentValuesArray[2][$i];    //   값이 없음



      }
    }


    // 새로고침 효과
    public function replacePage(){
      echo "<script> location.replace('./index.php'); </script>";
    }

    // 회원가입 페이지 호출
    public function callPageCreateUser(){
      echo "<script> location.replace('./view/login/createUser.php'); </script>";
    }

    // 로그인페이지 호출
    private function login(){
      require_once "./view/login/login.php";
    }

    // 회원정보 버튼 눌렀을 때.
    public function CallBeforeUserData(){
      echo "<script>location.replace('./view/login/userModify.php')</script>";
    }

  }
 ?>
