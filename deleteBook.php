<?php include "dbConnection.php";?>
<?php
    $id = $_POST["bookId"];
try{
    /*
     * delete book from database
     */
    $stmt = $conn->prepare("Delete from books where books.Id=".$id.";");
    $result = $stmt->execute();
}catch (Exception $e){
    echo $e->getMessage();
}
    $conn = null;
?>