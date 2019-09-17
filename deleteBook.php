<?php include "dbConnection.php";?>
<?php
    $id = $_POST["bookId"];
try{
    /*
     * delete book from database having selected Id
     */
    $stmt = $conn->prepare("Delete from books where books.Id=".$id.";");
    $result = $stmt->execute();
    echo "BOOK DELETED with id : $id";
}catch (Exception $e){
    echo $e->getMessage();
}
    $conn = null;
?>