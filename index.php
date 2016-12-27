<?php
session_start();
  require_once "./contorl/control.php";

  $control = new control();

  if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
    switch ($mode) {

        // 회원가입하기
        case 'callPageCreateUser' :
        $control->callPageCreateUser();
        break;

        // 회원가입 판단하기
        case 'createUser' :
        $control->createUser();
        break;

        // 로그인하기
        case 'login' :
          $control->login();
          break;

        // 로그아웃
        case 'logout' :
          $control->logout();
          break;

        // 회원 정보수정 눌렀을 때
        case 'CallBeforeUserData' :
          $control->CallBeforeUserData();
          break;

        // 회원정보 수정하기 (수정한 데이터 저장)
        case 'userModify' :
          $control->userModify();
          break;

        // 회원탈퇴
        case 'deleteUser' :
          $control->deleteUser();
          break;

        // 검색으로 상품찾기
        // case 'productsearch' :
        //   $control->selectProduct_search($_POST['productsearch']);
        // break;

        //  장바구니 담기
        case 'basket' :
          if(!isset($_SESSION['userid'])){
            echo "<script> alert('로그인 후 이용하세요.'); </script>";
            echo "<script> history.go(-1); </script>";
          } else{
                  $control->createBasket();
                  $control->insertBasket();
          }
          break;

          // 게시판 보기
        case 'view_content':
          $control->view_content();
          break;

          // 글 작성페이지 띄우기
        case 'upload' :
          require_once "./view/body/boardView/uploadContent.php";
          break;

        // 검색결과 보기
        case 'searchView' :
          require_once "./view/view.php?mode=searchView";
          break;

        // 내 장바구니 보기
        case 'myBasket' :
          $control->showMyBasket();
          echo "<script> location.replace('./index.php?mode=viewMyBasket') </script>";
          break;

          // 메인화면으로 (로고클릭  or 메인화면  클릭시.)
          case 'resetSearch' :
            $control->resetSearch();
          break;

            // 회원정보 수정
          case 'modifyContent':
            require_once "./view/body/boardView/modifyContent.php";
            break;

            // 관리자 상품등록
          case 'admin_upload' :
            echo "<script> location.replace('./view/login/upload_product.php');</script>";
            break;

          case 'upload_product2' :
            $control->insert_product();
            break;

          // case 'admin_delete' :
          //

    }
  } else{
        //
    if(isset($_GET['product'])){
        // require_once "./view/product_details.php";
    }

        //
    // else if(isset($_GET['myBasket_pd'])){
    //   require_once "./view/mybasket_p_d.php";
    // }

      //
      else if(isset($_GET['messagenum'])){
        require_once "./view/body/boardView/readContent.php";
      }
    else{
      // require_once "./view/body.php";
    }

      // 장바구니에서 삭제 누른  POST가 넘어오는가?
    if(isset($_POST['hidden_basketproductdelete'])){
      $argContent = $_GET['deleteProductNum'];
      $control->basketProductDelete($argContent);
      break;
    }

    if(isset($_GET['buy'])){
      $pValue = explode("~", $_GET['buy']);
      $control->productBuy($pValue[0], $pValue[1]);
    }

      // 게시글 작성
    if(isset($_GET['create_content'])){
      $_SESSION['userfile'] = $_FILES['userfile']['name'];

       if($_POST['boardname'] == "" || $_POST['content'] == ""  )  {
        echo "<script>alert('제목 또는 내용을 입력하지 않았습니다.')</script>";
        echo "<script> location.replace('./index.php?mode=upload'); </script>";
      } else{

        $control->create_content();
      }
    }

    // 게시글 수정
  if(isset($_GET['modifycontentPage'])){

      $_SESSION['userfile'] = $_FILES['userfile']['name'];
       if($_POST['boardname'] == "" || $_POST['content'] == ""  )  {
        echo "<script>alert('제목 또는 내용을 입력하지 않았습니다.')</script>";

      echo "<script> location.replace('./index.php?mode=view_content'); </script>";

      } else{
        // echo $_POST['boardname']."<br>";                  //수정한 제목
        // echo $_POST['content']."<br>";                    //수정한 내용
          $control->contentModify($_GET['modifycontentPage'],
                                  $_POST['boardname'],
                                  $_POST['content']
                                  );
    echo "<script> location.replace('./index.php?mode=view_content'); </script>";
      }
    }

      // 게시글 삭제
    if(isset($_GET['deletecontentPage'])){
      $control->contentDelete($_GET['deletecontentPage']);
    }

      // 판매자의 상품삭제
    if(isset($_GET['product_delete'])){
        $control->product_delete($_GET['product_delete']);
      }


  }




?>
