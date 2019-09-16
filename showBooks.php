<?php include 'getBooksData.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Show Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="tableCenter">
    <form id="searchForm" method="POST">
        <input type="search" class="search" name="Search" placeholder="Search" onkeypress="if (event.keyCode == 13) {this.form.submit();}">
    </form>
    <a href="addBook.php" class="btnAdd">Add Book</a>
    <table class="booksTable">
        <caption>Show Book Listing</caption>
        <thead>
        <tr>
            <th>ID</th>
            <th>Book Name</th>
            <th>Publisher Name</th>
            <th>ISBN</th>
            <th>Book cover</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
    <!-- Showing all the books-->
        <?php foreach ($result as $row){?>
            <tr>
                <td><?php echo $row['Id'] ?></td>
                <td><?php echo $row["Book"] ?></td>
                <td><?php echo $row["Publisher"] ?></td>
                <td><?php echo $row["ISBN"] ?></td>
                <td><img src='<?php echo "images/".$row["Cover"]?>' width="50" height="50"></td>
                <td><a href="editBook.php?id=<?php echo $row["Id"]?>" class="btnEdit">Edit</td>
                <td><input type="button" name="delete" value="Delete" id="<?php echo $row["Id"]?>" class="btnDelete"></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <!-- Pagination links -->
        <div class="pagination">
            <?php if($pageSection >= 1) {?>
            <a href="showBooks.php?prevSec=prev & pageSection=<?php echo $pageSection ?>">PREV</a>
            <?php } ?>

            <?php for ($i = 0, $j = 0; $i <= $noOfPages; $i++) {
                if($i % 10 == 0){ $j++; };
                if($i >= 10){?>
                    <a href="showBooks.php?page=<?php echo $i+1 ?>&pageSection=<?php echo $j ?>" id='page<?php echo $i+1 ?>' style="display: none" class="pageLinks"><?php echo $i+1?></a>
                <?php }
                else{ ?>
                    <a href="showBooks.php?page=<?php echo $i+1 ?> & pageSection=<?php echo $j ?>" id='page<?php echo $i+1 ?>' class="pageLinks"><?php echo $i+1?></a>
                <?php }
            }
            if($noOfPages > 10){ ?>
                <a href="showBooks.php?nextSec=next & pageSection=<?php echo $pageSection ?>">NEXT</a>
            <?php } ?>

        </div>


</div>
    <script src="jquery-3.4.1.min.js"></script>
    <script src="main.js"></script>
</body>
</html>