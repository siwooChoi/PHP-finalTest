<?php
  require_once "./model/DBManager.php";

  class model{
    private $dbo;
    public $rc; //  초기화블럭에서는 초기화만, 값이 들어가는 구간은 프로그램 실행 후 곧바로
                //  DB의 있는 상품들을 조회한 후의 rowCount.
    public $pr; //  배열에 값을넣기 위한 sql에서 값을 다 넣은 상태를 복사해온것.

      // model객체 생성과 동시에 DB연동
    public function __construct(){
      try{
        $this->rowCount = 0;
        $this->pr = array();
            $this->dbo = connect();
      }catch(PDOException $e) {
         exit("에러발생 {$e->getMessage()}");
      }
    }

      // 회원가입
    public function createUser(){

        $sql = "select id from member where id = :id_of_post";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':id_of_post'=>$_POST["createId"]));
        $row = $stt->fetch();

        echo $row[0];

        // id중복검사
        if($_POST['createId'] == ""){
          echo "<script> alert('ID를 입력하세요.');</script>";
          echo "<script> history.go(-1); </script>";
          exit;
        }

        if($_POST['createId'] == $row[0]){
          echo "<script> alert('중복된 아이디 입니다.');</script>";
          echo "<script> history.go(-1); </script>";
          exit;
        }

        // 비번, 비번확인  같은가
        if($_POST['createPw1'] != $_POST['createPw2']){
          echo "<script> alert('비밀번호와 비밀번호확인이 일치하지 않습니다.');</script>";
          echo "<script> history.go(-1); </script>";
          exit;
        }

        // 아이디,비번 이외의 입력공간에 공백이 있을 경우
        if($_POST['createName'] == "" ||
            $_POST['createNick'] == "" ||
            $_POST['createTel1'] == "" ||
            $_POST['createTel2'] == "" ||
            $_POST['createTel3'] == "" ||
            $_POST['createEmail1'] == "" ||
            $_POST['createEmail2'] == ""){
          echo "<script> alert('입력하지 않은 내용이 있습니다.');</script>";
          echo "<script> history.go(-1); </script>";
            exit;
        }

        $createTel = $_POST['createTel1']."-".$_POST['createTel2']."-".$_POST['createTel1'];
        $createEmail = $_POST['createEmail1']."@".$_POST['createEmail2'];
        $regist_day = date("Y-m-d (H:i)");
        $level = 1;
        $sql = "insert into member(id, pass, name, nick, hp, email, regist_day, level, basket) values(:id, :pass, :name, :nick, :hp, :email, :regist_day, :level, :basket)";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':id'=>$_POST["createId"],
                            ':pass'=>$_POST["createPw1"],
                            ':name'=>$_POST["createName"],
                            ':nick'=>$_POST["createNick"],
                            ':hp'=>$createTel,
                            ':email'=>$createEmail,
                            ':regist_day'=>$regist_day,
                            ':level'=>$level,
                            ':basket'=>"off"
                          )
                          );
        // echo "<script> alert('입력하지 않은 내용이 있습니다.');</script>";
      }
//
      // 로그인
      public function login(){
        // echo $_POST["userid"];

            $sql = "select * from member where id = :id_of_post and pass = :pw_of_post";
            $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
            $stt->execute(array(':id_of_post'=>$_POST["userid"], ':pw_of_post'=>$_POST["userpw"]));
            $result = $stt->rowCount();

              // if는 0일때 false, 0이 아닌 숫자일 경우 1
            if($result){

              $sql = "select * from member where id = :id";
              $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
              $stt->execute(array(':id'=>$_POST['userid']));
              $row = $stt->fetch();

              $_SESSION['userid'] = $row['id'];
            
              $_SESSION['userName'] = $row['name'];
              $_SESSION['userNick'] = $row['nick'];
              $temp_hp = $row['hp'];
              $explode_hp = explode("-", $temp_hp);
              $_SESSION['userTel1'] = $explode_hp[0];
              $_SESSION['userTel2'] = $explode_hp[1];
              $_SESSION['userTel3'] = $explode_hp[2];

              $temp_email = $row['email'];
              $explode_email = explode("@", $temp_email);
              $_SESSION['userEmail1'] = $explode_email[0];
              $_SESSION['userEmail2'] = $explode_email[1];

              // $this->view_content();
              // $this->view_product();
              // control::logon($result, $_POST["userid"], $_POST["userpw"]);

            } else{
              echo "<script> alert('아이디 및 비밀번호가 잘못되었습니다.');</script>";
              echo "<script> location.replace('./index.php'); </script>";
            }

      }

      // 로그아웃
      public function logout(){

        // echo $this->rc."<br>";
        // for($x = 0; $x < 5; $x++){   // $rc, $pr을 확인하기 위한 Test
        //   echo $this->pr[$x][$x]."<br>";
        // }

        session_destroy();    // 세션공간까지 다 지움.
        // session_unset();   // 세션공간 살리고 값만 지움.
        echo("<script>  location.replace('./index.php');  </script>");


        // unset($_SESSION['userid']);
        // unset($_SESSION['userpw']);
        // unset($_SESSION['userName']);
        // unset($_SESSION['userNick']);
        // unset($_SESSION['userTel1']);
        // unset($_SESSION['userTel3']);
        // unset($_SESSION['userTel2']);
        // unset($_SESSION['userEmail1']);
        // unset($_SESSION['userEmail2']);
      }

      // 회원 정보수정 하기 전 기존 데이터 불러오기
      public function CallBeforeUserData(){
        $sql = "select * from member where id = :id";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':id'=>$_SESSION['userid']));
        $row = $stt->fetch();

        $_SESSION['beforeName'] = $row['name'];
        $_SESSION['beforeNick'] = $row['nick'];
            /*explode 사용예
                $문자열 = "문자열-문자열";
                $arr = explode("-", $문자열);
                echo $arr[0];
                echo $arr[1];
            */
        $temp_hp = $row['hp'];
        $explode_hp = explode("-", $temp_hp);
        $_SESSION['beforeTel1'] = $explode_hp[0];
        $_SESSION['beforeTel2'] = $explode_hp[1];
        $_SESSION['beforeTel3'] = $explode_hp[2];

        $temp_email = $row['email'];
        $explode_email = explode("@", $temp_email);
        $_SESSION['beforeEmail1'] = $explode_email[0];
        $_SESSION['beforeEmail2'] = $explode_email[1];
      }

      // 데이터베이스의 회원정보 수정하기
      public function userModify(){

              // 비번, 비번확인  같은가
              if($_POST['modifyPw1'] != $_POST['modifyPw2']){
                echo "<script> alert('비밀번호와 비밀번호확인이 일치하지 않습니다.');</script>";
                echo "<script> history.go(-1); </script>";
                exit;
              }

              // 아이디,비번 이외의 입력공간에 공백이 있을 경우
              if(($_POST['modifyName'] || $_POST['modifyNick'] || $_POST['modifyTel1'] || $_POST['modifyTel2']
                || $_POST['modifyTel3'] || $_POST['modifyEmail']) == ""){
                echo "<script> alert('입력하지 않은 내용이 있습니다.');</script>";
                echo "<script> history.go(-1); </script>";
                  exit;
              }

              $modifyTel = $_POST['modifyTel1']."-".$_POST['modifyTel2']."-".$_POST['modifyTel1'];
              $modifyEmail = $_POST['modifyEmail1']."@".$_POST['modifyEmail2'];



              $sql = "update member set pass=:pass, name=:name, nick=:nick, hp=:hp, email=:email where id=:id;)";
              $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
              $stt->execute(array(':pass'=>$_POST["modifyPw1"],
                                  ':name'=>$_POST["modifyName"],
                                  ':nick'=>$_POST["modifyNick"],
                                  ':hp'=>$modifyTel,
                                  ':email'=>$modifyEmail,
                                  ':id'=>$_SESSION['userid']

                                ));

                  $_SESSION['userName'] = $_POST['modifyName'];
                  $_SESSION['userNick'] = $_POST['modifyNick'];
      }

      // 회원탈퇴                              <---- 장바구니 같이 사라지게 하게 구현해야됨
      public function deleteUser(){
        $sql = "delete from member where id = :id";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':id'=>$_SESSION["userid"]));

        echo "<script> alert('탈퇴 완료.');</script>";
      }

      // DB에서 상품이 총 몇개인지 판별
      public function selectProduct(){
        $sql = "select * from product";
        $stt = $this->dbo->prepare($sql);
        $stt->execute();
        $rowCount = $stt->rowCount();

        $this->rc = $rowCount;

        return $rowCount;
      }


        // DB 검색으로 상품 찾기
      public function selectProduct_search($search){
        $s = "%".$search."%";
        $sql = "select * from product where p_Name like :p_name or p_Comment like :p_name2";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(
                            ':p_name'=>$s,
                            ':p_name2'=>$s
                          ));
        $rowCount = $stt->rowCount();

        $this->rc = $rowCount;

        return $rowCount;
      }


      // DB에 있는 상품들을 각 배열에 값저장하기
      public function substituteProductData($rowCount, $product){
        $sql = "select * from product order by p_Number desc";
        $stt = $this->dbo->prepare($sql);
        $stt->execute();
        $row = $stt->fetchAll();

        $tempArray = array();

            for($i = 0 ; $i<$rowCount;$i++){
              $tempArray[0][$i] = $product["p_Number_$i"] = $row[$i]["p_Number"];
              $tempArray[1][$i] = $product["p_Name_$i"] = $row[$i]["p_Name"];
              $tempArray[2][$i] = $product["p_Price_$i"] = $row[$i]["p_Price"];
              $tempArray[3][$i] = $product["p_Comment_$i"] = $row[$i]["p_Comment"];
              $tempArray[4][$i] = $product["p_Type_$i"] = $row[$i]["p_Type"];
              $tempArray[5][$i] = $product["p_Amount_$i"] = $row[$i]["p_Amount"];
              $tempArray[6][$i] = $product["p_Imgname_$i"] = $row[$i]["p_Imgname"];
              $tempArray[7][$i] = $product["p_Detail_$i"] = $row[$i]["p_detail"];
            }
            $this->pr = $tempArray;
            return $tempArray;

                          //2차원배열로 출력 성공!  ver.2
            // for($i = 0 ; $i<$rowCount;$i++){
            //   echo $tempArray[0][$i]."<br>";
            //   echo $tempArray[1][$i]."<br>";
            //   echo $tempArray[2][$i]."<br>";
            //   echo $tempArray[3][$i]."<br>";
            //   echo $tempArray[4][$i]."<br>";
            //   echo $tempArray[5][$i]."<br>";
            //   echo $tempArray[6][$i]."<br>";
            //   echo $tempArray[7][$i]."<br><br>";
            // }



                  // 아래는 백업본. ver.1
        // for($i = 0 ; $i<$rowCount;$i++){
        //   $product["p_Number_$i"] = $row[$i]["p_Number"];
        //   $product["p_Name_$i"] = $row[$i]["p_Name"];
        //   $product["p_Price_$i"] = $row[$i]["p_Price"];
        //   $product["p_Comment_$i"] = $row[$i]["p_Comment"];
        //   $product["p_Type_$i"] = $row[$i]["p_Type"];
        //   $product["p_Amount_$i"] = $row[$i]["p_Amount"];
        //   $product["p_Imgname_$i"] = $row[$i]["p_Imgname"];
        //   $product["p_Detail_$i"] = $row[$i]["p_detail"];
        // }
        //            // 출력 성공! ver.1출력버전
        // for($i = 0 ; $i<$rowCount;$i++){
        //   echo $product["p_Number_$i"]."<br>";
        //   echo $product["p_Name_$i"]."<br>";
        //   echo $product["p_Price_$i"]."<br>";
        //   echo $product["p_Comment_$i"]."<br>";
        //   echo $product["p_Type_$i"]."<br>";
        //   echo $product["p_Amount_$i"]."<br>";
        //   echo $product["p_Imgname_$i"]."<br>";
        //   echo $product["p_Detail_$i"]."<br>";
        //   echo "<br><br>";
        // }

            // 값저장은 했음.  view에 뿌리기



      }





      // DB에 있는 게시글 값들 각각 배열에 저장하기.
      public function substituteContentData($rowCount, $content){
        $sql = "select * from content";
        $stt = $this->dbo->prepare($sql);
        $stt->execute();
        $row = $stt->fetchAll();

        $tempArray = array();

            for($i = 0 ; $i<$rowCount;$i++){
              $tempArray[0][$i] = $content[0][$i] = $row[$i]["num"];
              $tempArray[1][$i] = $content[1][$i] = $row[$i]["id"];
              $tempArray[2][$i] = $content[2][$i] = $row[$i]["name"];
              $tempArray[3][$i] = $content[3][$i] = $row[$i]["nick"];
              $tempArray[4][$i] = $content[4][$i] = $row[$i]["content"];
              $tempArray[5][$i] = $content[5][$i] = $row[$i]["regist_day"];
              // echo $tempArray[0][$i]."<br>";   // 값이 들어감.
            }
            return $tempArray;
          }


          // 구매하기 (남은수량 줄어들게하기)
      public function productBuy($pnum, $pname){
        $productNumber = $pnum;
        $productName = $pname;


            // 재고 구하기.
        $sql = "select * from product where p_Number = :pnum";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':pnum'=>$productNumber));
        $rowcount = $stt->rowcount();
        $row = $stt->fetch();
        //
        //     // 해당상품의 재고에 따라 판매가능, 불가능
        if($row['p_Amount'] <= 0){
          echo "<script>alert('<$pnum>는(은) 재고가 없습니다.');</script>";
          echo "<script> location.replace('./index.php?mode=bodyview'); </script>";
        //
      }else{
        //         // 판매 한다면 재고수량 -1 시키기
        //     // 반복시킬 최대값 상품번호 조회하기 (중앙에 숫자가 비어있을수도 있으므로 번호만 조회하면 안됨)
        //     $sql = "select max(p_Number) from product";
        //     $stt = $this->dbo->prepare($sql);
        //     $stt = execute();
        //     $maxValue = $stt->fetch();
        //     $icount = $maxValue['p_Number'];
        //
        //     for($i = 0; $i < $icount; $i++){
        //       if($i == $productNumber){
                $sql = "update product set p_Amount = p_Amount - 1 where p_Number = :pnum and p_Amount > 0";
                $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
                $stt->execute(array(':pnum'=>$productNumber));
          //
          //     }
          //   }
            echo "<script>alert('<$productName>을(를) 구매하셨습니다.');</script>";
          //   echo "<script> location.replace('./index.php?mode=bodyview'); </script>";
          //
          echo "<script> location.replace('./index.php?mode=bodyview'); </script>";
        }
      }

      // 장바구니 만들기
      public function createBasket(){
        $sql = "select basket from member where id = :id";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(
                            ':id'=>$_SESSION['userid']
                          ));
        $row = $stt->fetch();
        // echo $row['basket'];    아직 안만들었으면 off;

        if($row['basket'] == "off"){
          $id = $_SESSION['userid'];
          $sql = "create table $id(
                   p_Number int AUTO_INCREMENT,
                   p_Name varchar(30) not null,
                   p_Price int not null,
                   p_Comment varchar(40),
                   p_Type varchar(15),
                   p_Amount int not null,
                   p_Imgname varchar(40),
                   regist_day char(20),
                   primary key(p_Number)
                   )";
          // $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
          // $stt->execute(array(  ':id'=>$_SESSION['userid']  ));

          $stt = $this->dbo->prepare($sql);
          $stt->execute();
        $this->modifyBasket();  // member 에서 $row['basket']  on으로 바꿔주기
        // echo "장바구니 생성!";
        } else{
          // echo "장바구니 이미 있음<br>";
        }
      }

      // 장바구니존재여부 값 바꾸기
      public function modifyBasket(){
        $sql = "update member set basket='on' where id = :id;";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':id'=>$_SESSION['userid']));

            // 장바구니 on으로 변경되는지 확인
        // $sql = "select basket from member where id = :id";
        // $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        // $stt->execute(array(
        //                     ':id'=>$_SESSION['userid']
        //                   ));
        // $row = $stt->fetch();
        //
        //
        // echo $row['basket'];  //  아직 안만들었으면 off;  만들었으면 on
      }

      // 장바구니 insert
      public function insertBasket(){
                //장바구니 담을 때 사용할 변수들.
                // $id = $_SESSION['userid'];
                //   $_POST['insertBasket_pName']
                //   $_POST['insertBasket_pPrice']
                //   $_POST['insertBasket_pComment']
                //   $_POST['insertBasket_pType']
                //   $_POST['insertBasket_pAmount']
                //   $_POST['insertBasket_pImgname']
        $id = $_SESSION['userid'];
        $regist_day = date("Y-m-d (H:i)");

        $sql = "insert into $id(p_Name, p_Price, p_Comment, p_Type, p_Amount, p_Imgname, regist_day)
                        values(:p_name, :p_price, :p_comment, :p_type, :p_amount, :p_imgname, :regist_day)";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':p_name' => $_POST['insertBasket_pName'],
                            ':p_price' => $_POST['insertBasket_pPrice'],
                            ':p_comment' => $_POST['insertBasket_pComment'],
                            ':p_type' => $_POST['insertBasket_pType'],
                            ':p_amount' => $_POST['insertBasket_pAmount'],
                            ':p_imgname' => $_POST['insertBasket_pImgname'],
                            ':regist_day'=> $regist_day
                          )
                          );

        echo "<script> alert('장바구니에 담았습니다.');</script>";
        echo "<script> history.go(-1); </script>";

      }

      // 내 장바구니 보기
      public function showMyBasket(){
        $id = $_SESSION['userid'];
        $sql = "select * from $id";
        $stt = $this->dbo->prepare($sql);
        $stt->execute();
        $rowCount = $stt->rowCount();
        $row = $stt->fetchAll();

        $_SESSION['inBasket_row'] = $row;
        $_SESSION['inBasket_rowCount'] = $rowCount;


        for($i = 0 ; $i<$rowCount;$i++){
          $_SESSION["inBasket_p_Num_$i"] = $row[$i]["p_Number"];
          $_SESSION["inBasket_p_Name_$i"] = $row[$i]["p_Name"];
          $_SESSION["inBasket_p_Price_$i"] = $row[$i]["p_Price"];
          $_SESSION["inBasket_p_Comment_$i"] = $row[$i]["p_Comment"];
          $_SESSION["inBasket_p_Type_$i"] = $row[$i]["p_Type"];
          $_SESSION["inBasket_p_Amount_$i"] = $row[$i]["p_Amount"];
          $_SESSION["inBasket_p_Imgname_$i"] = $row[$i]["p_Imgname"];
          $_SESSION["inBasket_p_registday_$i"] = $row[$i]["regist_day"];
        }
      }

      // 장바구니에서 상품삭제.
      public function basketProductDelete($argContent){
        $id = $_SESSION['userid'];
        $p_num = $argContent;
        $sql = "delete from $id where p_Number = :p_num";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':p_num'=>$p_num));

        // echo $p_num;
        echo "<script> alert('장바구니에서 지웠습니다.');</script>";
        $this->showMyBasket();
        echo "<script> location.replace('./index.php?mode=viewMyBasket'); </script>";

      }

      // // 게시판글 갯수가 몇개인지 확인하기.
      // public function selectContent(){
      //   $sql = "select * from content";
      //   $stt = $this->dbo->prepare($sql);
      //   $stt->execute();
      //   $rowCount = $stt->rowCount();
      //
      //   return $rowCount;
      // }

      // 게시판 글 보여주기
      public function view_content(){
        $sql = "select * from content";
        $stt = $this->dbo->prepare($sql);
        $stt->execute();
        $rowCount = $stt->rowCount();
        $row = $stt->fetchAll();

        echo $rowCount;
        $_SESSION['content_row'] = $row;
        $_SESSION['content_rowCount'] = $rowCount;


        for($i = 0 ; $i<$rowCount;$i++){
          $_SESSION["c_num_$i"] = $row[$i]["num"];
          $_SESSION["c_id_$i"] = $row[$i]["id"];
          $_SESSION["c_name_$i"] = $row[$i]["name"];
          $_SESSION["c_nick_$i"] = $row[$i]["nick"];
          $_SESSION["c_content_$i"] = $row[$i]["content"];
          $_SESSION["c_registday_$i"] = $row[$i]["regist_day"];
        }

      }


      // 게시판 글 작성
      public function create_content(){
        $regist_day = date("Y-m-d");

        $sql = "INSERT INTO content(id, name, nick, content, regist_day)
                          VALUES(:id, :name, :nick, :content, :regist_day)";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(
                            ':id'=>$_SESSION['userid'],
                            ':name'=>$_POST['boardname'],
                            ':nick'=>$_SESSION['userNick'],
                            ':content'=>$_POST['content'],
                            ':regist_day'=>$regist_day
                          ));

        echo "<script> alert('작성 완료.');</script>";
        // echo "<script> location.replace('../index.php'); </script>";
        echo "<script> location.replace('./index.php?mode=view_content'); </script>";

        $this->view_content();
      }

      // 게시판 글 삭제
      public function contentDelete($argContent){
        $c_num = $argContent;
        $sql = "delete from content where num = :num";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':num'=>$c_num));


        echo "<script> alert('삭제완료');</script>";
        $this->view_content();
        // echo "<script> history.go(-1); </script>";
      echo "<script> location.replace('./index.php?mode=view_content'); </script>";


      }

      // 게시 글 수정
      public function contentModify($contentnum, $after_title, $after_content){

        $sql = "update content set name=:name, content=:content where num=:num";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(
                            ':name'=>$after_title,
                            ':content'=>$after_content,
                            ':num'=>$contentnum
                          ));
                          echo "<script> alert('수정 완료.');</script>";

        $this->view_content();
        echo "<script> location.replace('./index.php?mode=view_content'); </script>";
      }


      // 관리자가 상품등록하기
      // 상품등록
      public function insert_product(){
        $sql = "INSERT INTO product(p_Name, p_Price, p_Comment, p_Type, p_Amount, p_Imgname, p_detail)
                          VALUES(:p_name, :p_price, :p_comment, :p_type, :p_amount, :p_imgname, :p_detail)";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(
                            ':p_name'=>$_POST['p_name'],
                            ':p_price'=>$_POST['p_price'],
                            ':p_comment'=>$_POST['p_comment'],
                            ':p_type'=>$_POST['p_type'],
                            ':p_amount'=>$_POST['p_amount'],
                            ':p_imgname'=>$_POST['p_imgname'],
                            ':p_detail'=>$_POST['p_detail']
                          ));

        echo "<script> alert('등록 완료.');</script>";
        echo "<script> location.replace('./index.php?mode=bodyview'); </script>";


      }

      // 관리자가 상품제거하기
      public function product_delete($productValue){
        $pValue = explode("~", $productValue);
        $sql = "delete from product where p_Number = :pValue";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(':pValue'=>$pValue[0]));

        echo "<script> alert('<$pValue[1]> 을(를) 삭제하였습니다.'); </script>";
        echo "<script> location.replace('./index.php?mode=bodyview'); </script>";
      }



      // 검색으로 상품찾기
      public function product_search($search){
        $s = "%".$search."%";
        $sql = "select * from product where p_Name like :p_name or p_Comment like :p_name2";
        $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        $stt->execute(array(
                            ':p_name'=>$s,
                            ':p_name2'=>$s
                          ));
        $rowCount = $stt->rowCount();
        $row = $stt->fetchAll();

        $_SESSION['row'] = $row;
        $_SESSION['rowCount'] = $rowCount;

        for($i = 0 ; $i<$rowCount;$i++){
          $_SESSION["p_Num_$i"] = $row[$i]["p_Num"];
          $_SESSION["p_Name_$i"] = $row[$i]["p_Name"];
          $_SESSION["p_Price_$i"] = $row[$i]["p_Price"];
          $_SESSION["p_Comment_$i"] = $row[$i]["p_Comment"];
          $_SESSION["p_Type_$i"] = $row[$i]["p_Type"];
          $_SESSION["p_Amount_$i"] = $row[$i]["p_Amount"];
          $_SESSION["p_Imgname_$i"] = $row[$i]["p_Imgname"];
          $_SESSION["p_detail_$i"] = $row[$i]["p_detail"];
        }
          echo "<script> location.replace('../index.php') </script>";
      }

        // // 검색으로 상품찾기
      // public function product_search($search){
      //   $s = "%".$search."%";
      //   $sql = "select * from product where p_Name like :p_name or p_Comment like :p_name2";
      //   $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      //   $stt->execute(array(
      //                       ':p_name'=>$s,
      //                       ':p_name2'=>$s
      //                     ));
      //   $rowCount = $stt->rowCount();
      //   $row = $stt->fetchAll();
      //
      //   $searchResult = array();
      //   for($i = 0 ; $i<$rowCount;$i++){
      //     $searchResult[1][$i] = $row[$i]["p_Name"];
      //     $searchResult[2][$i] = $row[$i]["p_Price"];
      //     $searchResult[3][$i] = $row[$i]["p_Comment"];
      //     $searchResult[4][$i] = $row[$i]["p_Type"];
      //     $searchResult[5][$i] = $row[$i]["p_Amount"];
      //     $searchResult[6][$i] = $row[$i]["p_Imgname"];
      //     $searchResult[7][$i] = $row[$i]["p_detail"];
      //
      //     return $searchResult;
      //   }
      //
      //     // echo "<script> location.replace('./index.php?mode=searchView') </script>";
      //     // echo "<script> history.go(-1); </script>";
      // }



}
?>
