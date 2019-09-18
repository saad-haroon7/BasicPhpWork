/*
   It read the cover pic url and show it
   on img tag
 */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#cover').attr('src', e.target.result);
            $('#cover').attr('height','50');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(function(){
    /*
       show cover pic when change
     */
    $("#cover").change(function() {
        readURL(this);
    });

    /*
    delete the selected book from datbase and
    front-end
     */
    $(".booksTable tbody").on("click",".btnDelete",function () {
        if(confirm("Do you really want to delete this Book?")){
            $.ajax({
                type: "POST",
                url: "deleteBook.php",
                data: { "bookId": $(this).attr('id')},
                success: function (e) {
                    location.reload();
                    alert(e);
                }
            });
            $(this).parents("tr").remove();
        }
    });

    /*
    jQuery validation on Add book form
     */
    $("form.addBook").submit(function () {
        var flag = true;
        if ($("#bookName").val() == ""){
            $("#bookName").css('border','2px solid red');
            $("#bookNameSpan").css('display','inline');
            flag = false;
        }else {
            $("#bookName").css('border','1px solid darkgrey');
            $("#bookNameSpan").css('display','none');
        }
        if ($("#bookPublisher").val() == ""){
            $("#bookPublisher").css('border','2px solid red');
            $("#bookPublisherSpan").css('display','inline');
            flag = false;
        }else {
            $("#bookPublisher").css('border','1px solid darkgrey');
            $("#bookPublisherSpan").css('display','none');
        }
        if ($("#bookIsbn").val() == ""){
            $("#bookIsbn").css('border','2px solid red');
            $("#bookIsbnSpan").css('display','inline')
            flag = false;
        }else {
            $("#bookIsbn").css('border','1px solid darkgrey');
            $("#bookIsbnSpan").css('display','none');
        }
        if ($("#bookCover").val() == ""){
            if ($(document.activeElement).val() !== 'Edit'){
                $("#bookCover").css('border','2px solid red');
                $("#bookCoverSpan").css('display','inline');
                flag = false;
            }
        }else {
            $("#bookCover").css('border','1px solid darkgrey');
            $("#bookCoverSpan").css('display','none');
        }
        if(!flag){
            return false;
        }
    });
});

