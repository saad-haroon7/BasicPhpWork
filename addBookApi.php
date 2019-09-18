<?php include 'dbConnection.php'; ?>
<?php
    $errMsg = "";
    $flag = true;
    $bookName = $_POST['bookName'];
    $bookPublisher = $_POST['bookPublisher'];
    $bookIsbn = $_POST['bookIsbn'];
    $bookCover = $_FILES['bookCover']['name'];

/*
    Return to the show books page after displaying message
 */
    function redirectToShowBooks($msg){
        echo "<script type='text/javascript'> alert('$msg'); 
                     window.location.href='index.php';</script>";
    }
    /*
     * Do PHP validation for ADD BOOK form
     */
    function validateBookForm() {
        if($GLOBALS['bookCover'] == ""){
            if(isset($_POST['editBook'])){
                $GLOBALS['flag'] = true;
            }else{
                $GLOBALS['flag'] = false;
                $GLOBALS["errMsg"] = "*Upload Book Cover";
            }
        }
        if($GLOBALS['bookName'] == ""){
            $GLOBALS['flag'] = false;
            $GLOBALS["errMsg"] = "*Insert Book Name";
        }elseif (!preg_match("/^[a-zA-Z ]*$/",$GLOBALS['bookName'])){
            $GLOBALS['flag'] = false;
            $GLOBALS["errMsg"] = "*Only Alphabets and White Space allowed in Book Name";
        }
        if($GLOBALS['bookPublisher'] == ""){
            $GLOBALS['flag'] = false;
            $GLOBALS["errMsg"] = "*Insert Book Publisher";
        }elseif (!preg_match("/^[a-zA-Z ]*$/",$GLOBALS['bookPublisher'])){
            $GLOBALS['flag'] = false;
            $GLOBALS["errMsg"] = "*Only Alphabets and White Space allowed in Book Publisher";
        }
        if($GLOBALS['bookIsbn'] == ""){
            $GLOBALS['flag'] = false;
            $GLOBALS["errMsg"] = "*Insert Book ISBN";
        }elseif (!preg_match("/^[0-9]*$/",$GLOBALS['bookIsbn'])){
            $GLOBALS['flag'] = false;
            $GLOBALS["errMsg"] = "*Only Numbers are allowed in ISBN";
        }
    }
    if (!empty($_POST)){
        validateBookForm();
        /*
         * Enter if block when add book form validate true
         */
        if($flag){
            try{
                /*
                 * true when add book button is clicked
                 * then add book in database
                 */
                if(isset($_POST['addBook'])){
                    $target = "images/".basename($_FILES['bookCover']['name']);
                    $stmt = $conn->prepare("INSERT INTO books(Book,Publisher,ISBN,Cover) 
                                    VALUES (:bName,:bPublisher,:bIsbn,:bCover)");
                    $stmt->bindParam(":bName",$bookName);
                    $stmt->bindParam(":bPublisher", $bookPublisher);
                    $stmt->bindParam(":bIsbn",$bookIsbn);
                    $stmt->bindParam(":bCover", $bookCover);
                    $stmt->execute();
                    $tmp = $_FILES['bookCover']['tmp_name'];
                    if (move_uploaded_file($tmp, $target)){
                        $msg = "IMAGE UPLOAD";
                    }else{
                        $msg = "IMAGE NOT UPLOAD";
                    }
                    echo "<script>location.href='index.php?message=Successfully Added and $msg&page=1'</script>";
                /*
                 true when add book button is clicked
                 then add book in database
                 */
                }elseif(isset($_POST['editBook'])){
                    $relPage = $_GET['page'];
                    $id = $_GET['id'];
                    if($bookCover == ''){
                        $stmt = $conn->prepare("UPDATE books SET Book=:bName, Publisher=:bPublisher, ISBN=:bIsbn
                                           WHERE Id=:bId");
                        $stmt->bindParam(":bName",$bookName);
                        $stmt->bindParam(":bPublisher", $bookPublisher);
                        $stmt->bindParam(":bIsbn",$bookIsbn);
                        $stmt->bindParam(":bId",$id);
                    }
                    else{
                        $stmt = $conn->prepare("UPDATE books SET Book=:bName, Publisher=:bPublisher, ISBN=:bIsbn, Cover=:bCover
                                           WHERE Id=:bId");
                        $stmt->bindParam(":bName",$bookName);
                        $stmt->bindParam(":bPublisher", $bookPublisher);
                        $stmt->bindParam(":bIsbn",$bookIsbn);
                        $stmt->bindParam(":bCover", $bookCover);
                        $stmt->bindParam(":bId",$id);
                        /*
                         * FILE SAVE IN PROJECT
                         */
                        $target = "images/".basename($_FILES['bookCover']['name']);
                        $tmp = $_FILES['bookCover']['tmp_name'];
                        if (!move_uploaded_file($tmp, $target)){
                            $msg = " BUT IMAGE NOT UPLOAD";
                        }
                    }
                    $result = $stmt->execute();
                    $search = $_GET['Search'];
                    if($search==NULL){
                        echo "<script>location.href='index.php?message=Successfully Edited $msg&page=$relPage'</script>";
                    }
                    else
                        echo "<script>location.href='index.php?message=Successfully Edited $msg&Search=$search&page=$relPage'</script>";
                }
            }catch (Exception $e){
                echo $e->getMessage();
            }
            $conn = null;
        }
    }
?>