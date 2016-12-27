<?php
  require_once "./model/model.php";
  require_once "./view/view.php";

  class control{
    private $model;
    private $view;
    private $product;
    private $rowCount;
    // private $C_rowCount;
    // private $searchRowCount;
    // private $searchProduct;
    // private $BoardContent;
    // private $BoardContentArray;


      // 객체생성됨과 동시에 모델, 뷰 객체 생성
    public function __construct(){
      $this->model = new model();
      $this->view = new view();
      $this->product = array();
      $this->BoardContent = array();
      $this->searchProduct = array();
      $this->selectProduct();
      // $this->selectBoardContent();
      // $this->model->view_content();
    }

      // 게시판 보여주기
    public function view_content(){
      $this->model->view_content();
      require_once "./view/body/boardView/ContentBoard.php";
    }

    // public function extest(){
    //   $this->product[0][0] = "0.0<br>";
    //   $this->product[0][1] = "0.1<br>";
    // }

      // 회원가입페이지 부르기
    public function callPageCreateUser(){
      $this->view->callPageCreateUser();
    }

      // 회원가입하기
    public function createUser(){
      $this->model->createUser();
      $this->view->replacePage();
    }

      // 로그인
    public function login(){
      $this->model->login();
      $this->view->replacePage();
    }

      // 로그아웃
    public function logout(){
      $this->model->logout();
    }

      // 회원정보 수정전 페이지에 기존 데이터 불러오기
    public function CallBeforeUserData(){
      $this->model->CallBeforeUserData();
      $this->view->CallBeforeUserData();
    }

      // 회원정보 수정하기
    public function userModify(){
      $this->model->userModify();
      $this->view->replacePage();
    }

      // 회원탈퇴
    public function deleteUser(){
      $this->model->deleteUser();
      $this->view->replacePage();
      session_destroy();
    }

      // (1)DB에서 상품갯수(DB행 찾기) -> 배열에 값대입 -> view로 던지기 연속동작
    public function selectProduct(){
      $rowCount = $this->model->selectProduct();
      $this->rowCount = $rowCount;
      // (2)
      // echo "상품의 총 갯수는 : ".$rowCount;   // 현재 16. 확인성공.
      // echo $this->rowCount;
      $this->substituteProductData($rowCount); // 모든 각 상품에 값 넣는 메서드
    }

      // (3)각 상품배열에 상품값들 대입하기
    public function substituteProductData($rowCount){
      // $rowCount = $this->rowCount;
      $product = $this->product;
      // var_dump($product);
      $productValuesArray = $this->model->substituteProductData($rowCount, $product);
            /*찾은 rowCount 와 배열을 매개변수로 View에 던진다.*/
       $this->view->printProductData($productValuesArray, $rowCount);
      //  $this->view->getProductValue($productValuesArray, $rowCount);
    }






      //(1)DB에서 글갯수 -> 배열에 값대입 -> view로 던지기 연속동작
    public function selectBoardContent(){
      $C_rowCount = $this->model->selectContent();

                  // echo "디스".$this->C_rowCount."<br>";    //아직 값이 없음. 빈값.
                  // echo "그냥".$C_rowCount."<br>";          //현재 11
      $this->C_rowCount = $C_rowCount;
      // (2)echo "글 총 갯수는 : ".$rowCount;

                  // echo "디스".$this->C_rowCount."<br>";    //107라인에서 넣었는데도  값이 없음. 빈값.. ...?
                  // echo "그냥".$C_rowCount."<br>";          //현재 11
      $this->substituteContentData($C_rowCount); // 배열에 글의 정보값 넣는 메서드
    }
      //  (3) 각 배열에 배열글의 정보대입하기
    public function substituteContentData($C_rowCount){
      $BoardContent = $this->BoardContent;      // <-- 확인해보니 둘다 빈값,
                                                // echo $BoardContent[0]."<br>";        // undefinded variable
                                                // echo $this->BoardContent[0]."<br>";  // offset:0 에러

      $contentValuesArray = $this->model->substituteContentData($C_rowCount, $this->BoardContent);
      //tempArray가 저장됨.(값이있음)                     // ↑행갯수, 빈객체를 던져서 값을 대입시킨다.

            /*찾은 rowCount 와 배열을 매개변수로 View에 던진다.*/
       $this->view->printContentData($contentValuesArray, $C_rowCount);
    }

      // 장바구니가 없다면 장바구니 만들기
    public function createBasket(){
      if($_SESSION['userid'] == "admin"){
        echo "<script>관리자는 장바구니를 이용하지 않습니다.</script>";
      }
      $this->model->createBasket();
    }

      // 장바구니에 담기
    public function insertBasket(){
      $this->model->insertBasket();
    }

      // 내 장바구니 보기
    public function showMyBasket(){
      $this->model->showMyBasket();
    }

      // 장바구니 내용 삭제
    public function basketProductDelete($argContent){
      $this->model->basketProductDelete($argContent);
    }

      // 상품 구매
    public function productBuy($pnum, $pname){
      if(isset($_SESSION['userid'])){
        $this->model->productBuy($pnum, $pname);
      } else{
        echo "<script>alert('로그인 후 이용가능합니다.');</script>";
      }
    }

      // 검색으로 상품 찾기
    public function searchProduct($search){
      $this->model->searchProduct($search);
    }


      // 검색어 초기화 (메인화면으로가기)
    public function resetSearch(){
      $this->model->selectProduct();
      $this->view->replacePage();
    }

      // 관리자가 상품등록
    public function insert_product(){
      $this->model->insert_product();
    }

    //   관리자가 상품제거
    public function product_delete($productValue){
      $this->model->product_delete($productValue);
    }

      // 게시글 작성
    public function create_content(){
      $this->model->create_content();
    }

    // 게시글 삭제
    public function contentDelete($argContent){
      $this->model->contentDelete($argContent);
    }

    // 게시글 수정
    public function contentModify($contentnum, $after_title, $after_content){
      $this->model->contentModify($contentnum, $after_title, $after_content);
    }




  }
?>
