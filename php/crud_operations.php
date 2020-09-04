<?php

require_once("db.php");
require_once("components.php");

$con = Createdb();

// CRUD Buttons Validation
if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}

if(isset($_POST['deleteall'])){
    deleteAll();

}

// CREATE
function createData(){
    $bookname = textboxValue("book_name");
    $bookpublisher = textboxValue("book_publisher");
    $bookprice = textboxValue("book_price");

    if($bookname && $bookpublisher && $bookprice){

        $sql = "INSERT INTO books (book_name, book_publisher, book_price) 
                        VALUES ('$bookname','$bookpublisher','$bookprice')";

        if(mysqli_query($GLOBALS['con'], $sql)){
            ErrorMsg("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }else{
            ErrorMsg("error", "Provide Data in the Textbox");
    }
}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}


// ERROR MESSAGES
function ErrorMsg($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}


// READ
function getData(){
    $sql = "SELECT * FROM books";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

// UPDATE
function UpdateData() {

    $bookid = textboxValue("book_id");
    $bookname = textboxValue("book_name");
    $bookpublisher = textboxValue("book_publisher");
    $bookprice = textboxValue("book_price");

    if($bookname && $bookpublisher && $bookprice) {
        $sql = "
                UPDATE books SET book_name='$bookname', book_publisher = '$bookpublisher', book_price = '$bookprice' WHERE id='$bookid';                    
        ";

        if(mysqli_query($GLOBALS['con'], $sql)) {
            ErrorMsg("success", "Data Successfully Updated !");
        }
        else {
            ErrorMsg("error", "Unable to Update Data ..");
        }

    }
    else {
        ErrorMsg("error", "Select Data Using Edit Icon");
    }


}

// DELETE
function deleteRecord() {

    $bookid = (int)textboxValue("book_id");

    $sql = "DELETE FROM books WHERE id=$bookid";

    if(mysqli_query($GLOBALS['con'], $sql)) {
        ErrorMsg("success","Record Deleted Successfully !");
    }
    else {
        ErrorMsg("error","Unable to Delete Record ..");
    }

}

// Create A 'Delete All' Button To DROP The Table When The Table Has More Than 3 Rows 
function deleteBtn(){

    $result = getData();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)) {
            $i++;
            if($i > 3) {
                buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                return;
            }
        }
    }
}


// DELETE ENTIRE TABLE (Minimum 3 Rows Required)
function deleteAll() {
    $sql = "DROP TABLE books";

    if(mysqli_query($GLOBALS['con'], $sql)) {
        ErrorMsg("success","Deleted Entire Table !");
        Createdb();
    }
    else {
        ErrorMsg("error","Something Went Wrong. Record Wasn't Deleted !");
    }
}


// Setting Auto ID To Textbox
function setID(){
    $getid = getData();
    $id = 0;
    if($getid) {
        while ($row = mysqli_fetch_assoc($getid)) {
            $id = $row['id'];
        }
    }
    return ($id + 1);
}


?>