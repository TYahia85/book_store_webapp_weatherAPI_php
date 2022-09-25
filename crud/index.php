<?php

    require_once("../crud/php/db.php");
    require_once("../crud/php/ops.php");
    createdb();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/62720f59b4.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>
<body>
    <main>
        <div class="container text-center">
            <h1 class="py-4 bg-dark text-light rounded"><i class="fa-solid fa-book-open"></i> Book Store</h1>

            <h6 class="text-center bg-dark py-2 text-light rounded"><?php echo date("D  d-M-Y | H:i"); ?></h6>
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="input-group mt-2 mb-4 rounded search-form">
                        <input class="form-control border rounded-pill" type="text" placeholder="Search weather by city name..." value="" id="search-input">
                            <span class="input-group-append">
                            <button class="btn btn-outline-secondary bg-white border rounded-pill" type="button" id="search">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>


            <div class="-flex py-4 rounded mb-4 weather-info">
                <span id="icon"></span>
                <h4> 
                <span id="city"></span>
                <span id="description"></span>
                <span id="temp"></span>
                <span id="humidity"></span>
                <span id="speed"></span>
                </h4>
            </div>
        </div>
        </div>
        <div class="container text-center">
            <div class="d-flex justify-content-center">
                <form action="" method="post" class="w-50">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-id-badge"></i></span>
                        <input name ="book-id" type="text" class="form-control" placeholder="ID" aria-label="ID" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book-bookmark"></i></span>
                        <input  name ="book-name" type="text" class="form-control" placeholder="Book Name" aria-label="book-name" aria-describedby="basic-addon1">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-feather-pointed"></i></span>
                                <input  name ="book-publisher" type="text" class="form-control" placeholder="Book Publisher" aria-label="book-publisher" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-dollar-sign"></i></span>
                                <input  name ="book-price" type="text" class="form-control" placeholder="Book Price" aria-label="book-price" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center btn-g">
                        <button class="btn btn-primary" name="create" id="btn-create" dat-toggle=tooltip data-placement=bottom title=Create><i class="fa-solid fa-plus"></i></button>
                        <button class="btn btn-success" name="read" id="btn-read" dat-toggle=tooltip data-placement=bottom title=Read><i class="fa-solid fa-retweet"></i></button>
                        <button class="btn btn-warning" name="update" id="btn-edit" dat-toggle=tooltip data-placement=bottom title=Update><i class="fa-regular fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" name="delete" id="btn-delete" dat-toggle=tooltip data-placement=bottom title=Delete><i class="fa-solid fa-trash"></i></button>
                        <?php deleteAllbtn(); ?>
                    </div>
                </form>
            </div>
            <div class="d-flex table-data">
                <table class="table table-striped table-dark justify-content-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Name</th>
                            <th>Book Pblisher</th>
                            <th>Book Price</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                if(isset($_POST['read'])){
                                    $result = readData();
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){?>
                                        <tr>
                                            <td data-id= "<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>
                                            <td data-id= "<?php echo $row['id']; ?>"><?php echo $row['book_name']; ?></td>
                                            <td data-id= "<?php echo $row['id']; ?>"><?php echo $row['book_publisher']; ?></td>
                                            <td data-id= "<?php echo $row['id']; ?>"><?php echo $row['book_price']; ?></td>
                                            <td><i data-id= "<?php echo $row['id']; ?>" class="fas fa-edit btn-edit"></i></td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                }
                            ?>

                    </tbody>
                </table>
            </div>
        </div>
    </main>  
    
    
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <!-- JQuery CDN-->
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
    
    <!-- Custom JS -->
    <script src="main.js"></script>
</body>
</html>