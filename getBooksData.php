<?php include 'dbConnection.php'; ?>
<?php
try{
    $page = $_GET['page'];
    $searchItem = $_GET['Search'];
    /*
     when search form is submitted
     */
    if (!empty($_GET)){
        if(isset($_GET['Search'])){
            if($_GET['Search'] == NULL){
                /*
                 When person enters empty string in search
                 */
                echo "<script>location.href='index.php'</script>";
            }
            else{
                /*
                 returns rows related to searched item
                 */
                $searchItem = $_GET['Search'];
                $searchItem = '%'.$searchItem.'%';
                $stmt = $conn->prepare("SELECT * from books where (Book LIKE :bName) OR (Publisher LIKE :bPublisher) OR (ISBN LIKE :bIsbn);");
                $stmt->bindParam(":bName",$searchItem);
                $stmt->bindParam(":bPublisher", $searchItem);
                $stmt->bindParam(":bIsbn",$searchItem);
                $stmt ->execute();
                $rowsCount =  $stmt->rowCount();
                $noOfPages = round(ceil($rowsCount/10),0);
                if ($_GET['page'] == NULL){
                    $_GET['page'] = 1;
                    $page = 1;
                    $lowLimit = 0;
                    $offset = 10;
                }else{
                    $page = $_GET['page'];
                    $lowLimit = ($page - 1) * 10;
                    $offset = 10;
                }
                if($_GET['nextSec']){
                    if($_GET['page'] == $noOfPages){
                        $_GET['page'] = $_GET['page'];
                    }else{
                        $_GET['page'] += 1;
                    }
                    $page = $_GET['page'] ;
                    $searchItem = $_GET['Search'];
                    echo "<script>location.href='index.php?Search=$searchItem&page=$page'</script>";
                }
                if($_GET['prevSec']){
                    if($_GET['page'] == 1){
                        $_GET['page'] = $_GET['page'];
                    }else{
                        $_GET['page'] -= 1;
                    }
                    $searchItem = $_GET['Search'];
                    $page = $_GET['page'] ;
                    echo "<script>location.href='index.php?Search=$searchItem&page=$page'</script>";
                }
                $stmt = $conn->prepare("SELECT * from books where (Book LIKE '$searchItem') OR (Publisher LIKE '$searchItem') OR (ISBN LIKE '$searchItem') 
                                        ORDER BY Id DESC
                                        LIMIT $lowLimit, $offset");
                $stmt->bindParam(":bName",$searchItem);
                $stmt->bindParam(":bPublisher", $searchItem);
                $stmt->bindParam(":bIsbn",$searchItem);
                $result = $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();
            }
        }
        else{
            $stmt = $conn->prepare("SELECT * from books");
            $stmt ->execute();
            $rowsCount =  $stmt->rowCount();
            $noOfPages = round(ceil($rowsCount/10),0);
            if ($_GET['page']){
                $page = $_GET['page'];
                $lowLimit = ($page - 1) * 10;
                $offset = 10;
            }
            if($_GET['nextSec']){
                if($_GET['page'] == $noOfPages){
                    $_GET['page'] = $_GET['page'];
                }else{
                    $_GET['page'] += 1;
                }
                $page = $_GET['page'] ;
                echo "<script>location.href='index.php?page=$page'</script>";
            }
            if($_GET['prevSec']){
                if($_GET['page'] == 1){
                    $_GET['page'] = $_GET['page'];
                }else{
                    $_GET['page'] -= 1;
                }
                $page = $_GET['page'] ;
                echo "<script>location.href='index.php?page=$page'</script>";
            }
            $stmt = $conn->prepare("SELECT * from books ORDER BY Id DESC LIMIT $lowLimit,$offset");
            $result = $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }
    }
    /*
     Returns all rows when showBooks page loads
     */
    else{
        $stmt = $conn->prepare("SELECT * from books");
        $stmt ->execute();
        $rowsCount =  $stmt->rowCount();
        $noOfPages = round(ceil($rowsCount/10),0);
        if($_GET['page'] == NULL){
            $_GET['page'] = 1;
            $page = 1;
            $lowLimit = 0;
            $offset = 10;
        }
        $stmt = $conn->prepare("SELECT * from books ORDER BY Id DESC LIMIT $lowLimit,$offset");
        $result = $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
    }
}catch (Exception $e){
    echo $e->getMessage();
}
$conn = null;
?>