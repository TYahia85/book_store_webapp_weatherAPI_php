<?php
require_once("db.php");

$con = createdb();

if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    updateData();
}

if(isset($_POST['delete'])){
    deleteData();
}

if(isset($_POST['deleteall'])){
    deleteAll();
}

function createData(){
    $id = checktextvalues('book-id');
    $bookname = checktextvalues('book-name');
    $bookpublisher = checktextvalues('book-publisher');
    $bookprice = checktextvalues('book-price');

    if($bookname && $bookpublisher && $bookprice){
        $sql = "INSERT INTO books(book_name,book_publisher,book_price) VALUES('$bookname','$bookpublisher','$bookprice');";

        if(mysqli_query($GLOBALS['con'],$sql)){
            textmsg("success","Record is added successfully");
        }else{
            textmsg("error","Record is Not added");
        }
    }else {
        textmsg("error","Please fill book information to add");
    }
}

function readData(){
    $sql = "SELECT * FROM books";

    $result = mysqli_query($GLOBALS['con'],$sql);

    return $result;

}

function updateData(){

    $id = checktextvalues('book-id');
    $bookname = checktextvalues('book-name');
    $bookpublisher = checktextvalues('book-publisher');
    $bookprice = checktextvalues('book-price');

    if($bookname && $bookpublisher && $bookprice){

        $sql = "UPDATE books SET book_name='$bookname',book_publisher='$bookpublisher',book_price='$bookprice' WHERE id='$id'";
        if(mysqli_query($GLOBALS['con'],$sql)){
            textmsg("success", "Record updated succesfully");
        }else{
            textmsg("error", "Unable to update record");
        }
    }else{
        textmsg("error","Please fill book information to update");
    }
}

function deleteData(){
    $id = checktextvalues('book-id');

    if($id){
        $sql = "DELETE FROM books WHERE id='$id'";
        if(mysqli_query($GLOBALS['con'], $sql)){
            textmsg("success","Record deleted");
        }else{
            textmsg("error","Unable to delete selected record");
        }
    }else{
        textmsg("error","Please select a record to delete");
    }
}

function deleteAllBtn(){
    $results = readData();
    $i = 0;
    while($row = mysqli_fetch_assoc($results)){
        $i++;
        if($i > 3){
            $delBtn = "<button class='btn btn-danger' name='deleteall'><i class='fa-solid fa-trash'></i> Delete All</button>";
            echo $delBtn;
            return;
        }

    }
}

function deleteAll(){
    $sql = "DROP TABLE books";
    if(mysqli_query($GLOBALS['con'],$sql)){
        textmsg("success","All records deleted successfylly");
        createdb();
    }else{
        textmsg("error","Unable to delete all records");
    }

}

function checktextvalues($value){
    $text = mysqli_real_escape_string($GLOBALS['con'],trim($_POST[$value]));
    if(empty($text)){
        return false;
    }else{
        return $text;
    }
}

function textmsg($class,$msg){
    $msg = "<h6 class='$class animated-left'>$msg</h6>";
    echo $msg;
}

// function deleteAllbtn(){
//     $delBtn = "<button class='btn btn-danger'><i class='fa-solid fa-trash'></i> Delete All</button>";
//     echo $delBtn;
// }