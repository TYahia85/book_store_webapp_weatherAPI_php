<?php

    require_once("../crud/php/db.php");
    require_once("../crud/php/ops.php");
    createdb();

    // search weather function
    function weather(){
        if(isset($_POST['search-weather'])){
            // get city name
            $city_name = $_POST['weather-input'];
    
            if($city_name){
                // contact api
                $api_key = "95979ded7becff0834db0c708ecc57d0";
                $url = "https://api.openweathermap.org/data/2.5/weather?q="
                .$city_name
                ."&appid="
                .$api_key;
            
                // initilize curl
                $ch = curl_init();
            
                // set curl options
                curL_setopt($ch,CURLOPT_HEADER,0);
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        
                // execute curl 
                $response = curl_exec($ch);
                
                // cache api reponse
                $data = json_decode($response,true);
    
                if($e = curl_error($ch)){
                    echo $e;
                }else{
                    $city = $data["name"]." Weather | ";
                    $temp = $data["main"]["temp"];
                    $temp_c = round($temp - 273.15)."°C";
                    $description = $data["weather"]["0"]["description"]." ";
                    $clouds = $data["clouds"]["all"];
    
                    if($city && $temp_c && $description){
    
                        $weather = "<h4 class='weather-info rounded animated'>".$city." ".$temp_c." ".$description."</h4>";
                        echo $weather;
    
                    }

                    // close curl to free system resources
                    curl_close($ch);
                }
    
            }else{
                $msg = "<h6 class='error'>Please search weather by city name...</h6>";
                echo $msg;
            }
        }
    }


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
            <h1 class="py-4 bg-dark text-light rounded animated"><i class="fa-solid fa-book-open"></i> Book Store</h1>

            <h6 class="text-center bg-dark py-2 text-light rounded animated"><?php echo date("D  d-M-Y | H:i"); ?></h6>


            <!-- weather div -->
            <div class="d-flex justify-content-center">
                <form action="" method="post" class="w-50 weather rounded">
                    <div class="input-group mb-3">
                        <button name="search-weather" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                        <input type="search" name ="weather-input" placeholder="Search Weather by City Name..." id="form1" class="form-control" />
                        <label class="form-label" for="form1"></label>
                    </div>
                </form>
            </div>
            
            <!-- weather report -->
            <div class="d-flex justify-content-center py-4 rounded mb-2 weather-report animated">
                
                <!-- php weather-->
                <?php weather(); ?>

                
                <!-- *** JS weather display (ready to use when enabled from app.js) *** -->

                <!-- <span id="icon"></span>
                <h4> 
                <span id="city"></span>
                <span id="description"></span>
                <span id="temp"></span>
                <span id="humidity"></span>
                <span id="speed"></span> -->
                <!-- </h4> -->

            </div>
            <!-- end weather div -->

        </div>


        <div class="container text-center">
            <div class="d-flex justify-content-center">
                <form action="" method="post" class="w-50">
                    <!-- input feilds -->
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
                    <!-- end input feilds -->

                    <!-- buttons -->
                    <div class="d-flex justify-content-center btn-g animated-bottom">
                        <button class="btn btn-primary" name="create" id="btn-create" dat-toggle=tooltip data-placement=bottom title=Create><i class="fa-solid fa-plus"></i></button>
                        <button class="btn btn-success" name="read" id="btn-read" dat-toggle=tooltip data-placement=bottom title=Read><i class="fa-solid fa-retweet"></i></button>
                        <button class="btn btn-warning" name="update" id="btn-edit" dat-toggle=tooltip data-placement=bottom title=Update><i class="fa-regular fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" name="delete" id="btn-delete" dat-toggle=tooltip data-placement=bottom title=Delete><i class="fa-solid fa-trash"></i></button>

                        <!-- php call function -->
                        <?php deleteAllbtn(); ?>

                    </div>
                </form>
            </div>

            <!-- table -->
            <div class="d-flex table-data animated-bottom">
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
    <script src="app.js"></script>
</body>
</html>