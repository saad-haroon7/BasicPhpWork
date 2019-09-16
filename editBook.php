<?php include "dbConnection.php"?>
<?php include 'addBookApi.php'; ?>
<?php
    /*
     * Run When page is load and return row
     * on selected 'Id'!
     */
    if(empty($_POST)){
        try{
            $stmt = $conn->prepare("SELECT * from books where Id=".$_GET['id'].";");
            $result = $stmt->execute();
            if($result){
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();
            }
        }catch (Exception $e){
            echo $e->getMessage();
        }
        $conn = null;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="toCenter">
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" class="addBook" enctype="multipart/form-data">
        <h2>Edit Book</h2><br>
        <img src="img/1.png" width="200" height="200">
        <input type="text" id="bookName" name="bookName" placeholder="Book Name" value="<?php echo $result[0]['Book'];?>"><br>
        <span id="bookNameSpan">*Book Name is required<br></span>
        <input type="text" id="bookPublisher" name="bookPublisher" placeholder="Publisher Name" value="<?php echo $result[0]['Publisher'];?>"><br>
        <span id="bookPublisherSpan">*Book Publisher is required<br></span>
        <input type="text" id="bookIsbn" name="bookIsbn" placeholder="ISBN" maxlength="13" minlength="13" value="<?php echo ($result[0]['ISBN']);?>"><br>
        <span id="bookIsbnSpan">*Book ISBN is required<br></span>
        <input type="file" id="bookCover" name="bookCover" accept="image/*" onchange="readURL(this)"; ?>
        <img src="<?php echo "images/".$result[0]['Cover']?>" id="cover" width="50"/>
        <span id="bookCoverSpan">*Book Cover is required<br></span>
        <input type="submit" value="Edit" name="editBook" id="edit">
    </form>
</div>

<script src="jquery-3.4.1.min.js"></script>
<script src="main.js"></script>
</body>
</html>
