<?php include 'addBookApi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="toCenter">
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" class="addBook" id="myForm" enctype="multipart/form-data">
        <h2>Add Book</h2><br>
        <img src="img/1.png" width="200" height="200">
        <input type="text" id="bookName" name="bookName" placeholder="Book Name" value="<?php echo $_POST['bookName']?>"><br>
        <span id="bookNameSpan">*Book Name is required<br></span>
        <input type="text" id="bookPublisher" name="bookPublisher" placeholder="Publisher Name" value="<?php echo $_POST['bookPublisher']?>"><br>
        <span id="bookPublisherSpan">*Book Publisher is required<br></span>
        <input type="text" id="bookIsbn" name="bookIsbn" placeholder="ISBN" maxlength="13" minlength="13" value="<?php echo $_POST['bookIsbn']?>"><br>
        <span id="bookIsbnSpan">*Book ISBN is required<br></span>
        <input type="file" id="bookCover" name="bookCover" accept="image/*" onchange="readURL(this)">
        <img src="" id="cover" width="50"/>
        <span id="bookCoverSpan">*Book Cover is required<br></span>
        <input type="submit" value="Add Book" name="addBook" id="add">
    </form>
</div>

<script src="jquery-3.4.1.min.js"></script>
<script src="main.js"></script>
</body>
</html>
