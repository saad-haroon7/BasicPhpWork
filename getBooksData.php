<script src="jquery-3.4.1.min.js"></script>
<?php include 'dbConnection.php'; ?>
<?php
    try{
        $pageSection = $_GET['pageSection'];
        /*
         when search form is submitted
         */
        if (!empty($_POST)){
            if(isset($_POST['Search'])){
                if($_POST['Search'] == NULL){
                    /*
                     When person enters empty string in search
                     */
                    if ($_GET['page']){
                        $page = $_GET['page'];
                        $lowLimit = ($page - 1) * 10;
                        $offset = 10;
                    }else{
                        $lowLimit = 0;
                        $offset = 10;
                    }
                    $stmt = $conn->prepare("SELECT * from books");
                    $stmt ->execute();
                    $rowsCount =  $stmt->rowCount();
                    $stmt = $conn->prepare("SELECT * from books LIMIT $lowLimit,$offset");
                    $result = $stmt->execute();
                    $noOfPages = round(ceil($rowsCount/10),0);
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = $stmt->fetchAll();
                }
                else{
                    /*
                     returns rows related to searched item
                     */
                    $searchItem = $_POST['Search'];
                    $stmt = $conn->prepare("SELECT * from books where (Book LIKE :bName) OR (Publisher LIKE :bPublisher) OR (ISBN LIKE :bIsbn);");
                    $stmt->bindParam(":bName",$searchItem);
                    $stmt->bindParam(":bPublisher", $searchItem);
                    $stmt->bindParam(":bIsbn",$searchItem);
                    $result = $stmt->execute();
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = $stmt->fetchAll();
                }
            }
        }else{
            /*
             Returns all rows when showBooks page loads
             */
            if ($_GET['page']){
                $page = $_GET['page'];
                $lowLimit = ($page - 1) * 10;
                $offset = 10;
            }else{
                $lowLimit = 0;
                $offset = 10;
            }
            if($_GET['nextSec']){
                if($pageSection == NULL){
                    $pageSection = 1;
                    $page = 11;
                }
                else{
                    $pageSection += 1;
                    $_GET['pageSection'] = $pageSection;
                    $page = $_GET['pageSection'] * 10 + 1;
                }
                echo "<script>location.href='showBooks.php?page=$page&pageSection=$pageSection'</script>";
            }
            if($_GET['prevSec']){
                $pageSection -= 1;
                $_GET['pageSection'] = $pageSection;
                if($pageSection == 1){
                    $page = 1;
                }else{
                    $page = $_GET['pageSection'] * 10 + 1;
                }
                echo "<script>location.href='showBooks.php?page=$page&pageSection=$pageSection'</script>";
            }
            $stmt = $conn->prepare("SELECT * from books");
            $stmt ->execute();
            $rowsCount =  $stmt->rowCount();
            $noOfPages = round(ceil($rowsCount/10),0);
            $stmt = $conn->prepare("SELECT * from books LIMIT $lowLimit,$offset");
            $result = $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }
    $conn = null;
?>