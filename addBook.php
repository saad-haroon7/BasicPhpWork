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
    <div class="formsHeading">
        <span class="errorMessage"><?php echo $errMsg ?></span>
        <h1>Add Book</h1>
    </div>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" class="addBook" id="myForm" enctype="multipart/form-data">
        <img src="img/1.png" width="200" height="200">
        <div>
            <input type="text" id="bookName" name="bookName" placeholder="Book Name" value="<?php echo $_POST['bookName']?>" required>
            <span class="asterisk_input">  </span>
            <span id="bookNameSpan">*Book Name is required<br></span>
        </div>

        <div>
            <input type="text" id="bookPublisher" name="bookPublisher" placeholder="Publisher Name" value="<?php echo $_POST['bookPublisher']?>" required>
            <span class="asterisk_input">  </span>
            <span id="bookPublisherSpan">*Book Publisher is required<br></span>
        </div>

        <div>
            <input type="text" id="bookIsbn" name="bookIsbn" placeholder="ISBN" maxlength="13" minlength="13" value="<?php echo $_POST['bookIsbn']?>" required>
            <span class="asterisk_input">  </span>
            <span id="bookIsbnSpan">*Book ISBN is required<br></span>
        </div>

        <div>
            <input type="file" id="bookCover" name="bookCover" accept="image/*" onchange="readURL(this)" required>
            <img src="" id="cover" width="50"/>
            <span class="asterisk_input">  </span>
            <span id="bookCoverSpan">*Book Cover is required<br></span>
        </div>

        <input type="submit" value="Add Book" name="addBook" id="add">
    </form>
</div>
    <a href="showBooks.php" class="showListing">Go back</a>

<script src="jquery-3.4.1.min.js"></script>
<script src="main.js"></script>
</body>
</html>
