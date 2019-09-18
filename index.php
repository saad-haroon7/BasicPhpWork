<?php include 'getBooksData.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Show Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">

</head>
<body>
<div class="tableCenter">
    <div class="listingHeading">
        <span class="successMessage"><?php echo $_GET['message']?></span><br>
        <h1>Show Book Listing</h1>
    </div>
    <a href="addBook.php" class="btnAdd">Add Book</a>
    <form id="searchForm" method="GET">
        <input type="search" class="search" name="Search" placeholder="Search"
               value="<?php echo $_GET['Search']?>" onkeypress="if (event.keyCode == 13) {this.form.submit();}">
    </form>
    <table class="booksTable">
        <thead>
        <tr>
            <th>Book Name</th>
            <th>Publisher Name</th>
            <th>ISBN</th>
            <th>Book cover</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <!-- Showing all the books-->
        <?php foreach ($result as $row){?>
            <tr>
                <td><?php echo $row["Book"] ?></td>
                <td><?php echo $row["Publisher"] ?></td>
                <td><?php echo $row["ISBN"] ?></td>
                <td><img src='<?php echo "images/".$row["Cover"] ?>' width="50" height="50"></td>
                <?php if($_GET['Search']){ ?>
                    <td><a href="editBook.php?Search=<?php echo $_GET['Search'] ?>&page=<?php echo $_GET['page'] ?>&id=<?php echo $row["Id"] ?>" class="btnEdit">Edit</td>
                <?php   }else { ?>
                    <td><a href="editBook.php?page=<?php echo $_GET['page'] ?>&id=<?php echo $row["Id"] ?>" class="btnEdit">Edit</td>
                <?php }?>
                <td><input type="button" name="delete" value="Delete" id="<?php echo $row["Id"] ?>" class="btnDelete"></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
    <!-- Pagination links -->
        <?php
            if($noOfPages > 1){ ?>
       <div class="pagination">
             <?php if($_GET['Search']){ ?>
                    <a href="index.php?Search=<?php echo $_GET['Search'] ?>&page=1" class="pageNavigation">First</a>
                <?php   }else { ?>
                    <a href="index.php?page=1" class="pageNavigation">First</a>
                <?php   } ?>
                <?php if($_GET['Search']){ ?>
                    <a href="index.php?Search=<?php echo $_GET['Search'] ?>&page=<?php echo $page?>&prevSec=prev" class="pageNavigation">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                <?php   }else { ?>
                    <a href="index.php?page=<?php echo $page?>&prevSec=prev" class="pageNavigation">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                <?php   } ?>

            <?php

            for($i = 1; $i <= $noOfPages; $i++){
                if($i >= $page AND $i <= $page+8){
                    if($_GET['Search']){?>
                        <a href="index.php?Search=<?php echo $_GET['Search'] ?>&page=<?php echo $i ?>" class="pageLinks"><?php echo $i ?></a>
                    <?php }else {?>
                    <a href="index.php?page=<?php echo $i ?>" class="pageLinks"><?php echo $i ?></a>
        <?php       }
                }else {
                    if($page >= $noOfPages-8 AND $i >= $noOfPages-8) {
                        if ($_GET['Search']) { ?>
                            <a href="index.php?Search=<?php echo $_GET['Search'] ?>&page=<?php echo $i ?>"
                               class="pageLinks"><?php echo $i ?></a>
                        <?php } else { ?>
                            <a href="index.php?page=<?php echo $i ?>" class="pageLinks"><?php echo $i ?></a>
                        <?php }
                    }
                    else {
                        if($_GET['Search']){ ?>
                            <a href="index.php?Search=<?php echo $_GET['Search'] ?>&page=<?php echo $i ?>" style="display: none" class="pageLinks"><?php echo $i ?></a>
                        <?php }
                        else { ?>
                            <a href="index.php?page=<?php echo $i ?>" style="display: none" class="pageLinks"><?php echo $i ?></a>
                  <?php }
                    }
                }
            } ?>
                <?php if($_GET['Search']){ ?>
                    <a href="index.php?Search=<?php echo $_GET['Search'] ?>&page=<?php echo $page?>&nextSec=next" class="pageNavigation">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
        <?php   }else { ?>
                    <a href="index.php?page=<?php echo $page?>&nextSec=next" class="pageNavigation">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
        <?php   } ?>

                <?php if($_GET['Search']){ ?>
                    <a href="index.php?Search=<?php echo $_GET['Search'] ?>&page=<?php echo $noOfPages ?>" class="pageNavigation">Last</a>
                <?php   }else { ?>
                    <a href="index.php?page=<?php echo $noOfPages ?>" class="pageNavigation">Last</a>
                <?php   } ?>
       </div>
            <?php   }elseif($noOfPages == 0) {?>
                <div class="noDataFound">
                    No Records!
                </div>
        <?php }?>
</div>
<script src="jquery-3.4.1.min.js"></script>
<script src="main.js"></script>
<script>
        $( "a.pageLinks:contains('<?php echo $page ?>')" ).css( "background-color" , "orange" );
</script>
</body>
</html>