<?php 
    require_once("../book-crud/php/components.php");
    require_once("../book-crud/php/crud_operations.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Database Management</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        <?php 
            include('style.css')
        ?>
    </style>

    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>

    <main>

        <div class="container my-cs text-center">
            <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook"></i> Book Store</h1>

            <div class="d-flex justify-content-center">
                <form action="" method="post" class="w-50">
                    <div class="py-2">
                        <?php  inputElement("<i class='fas fa-id-badge'></i>", "ID", "book_id", setID());   ?>  
                    </div>
                    <div class="pt-2">
                        <?php  inputElement("<i class='fas fa-book'></i>", "Book Name", "book_name", "");   ?>
                    </div>
                    <div class="row pt-2">
                        <div class="col">
                            <?php  inputElement("<i class='fas fa-fax'></i>", "Publisher", "book_publisher", "");   ?>
                        </div>
                        <div class="col">
                            <?php  inputElement("<i class='fas fa-rupee-sign'></i>", "Price", "book_price", "");   ?>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <?php buttonElement("btn-create","btn btn-success","<i class='fas fa-plus'></i>","create","data-toggle='tooltip' data-placement='bottom' title='Create'"); ?>
                        <?php buttonElement("btn-read","btn btn-primary","<i class='fas fa-sync'></i>","read","data-toggle='tooltip' data-placement='bottom' title='Read'"); ?>
                        <?php buttonElement("btn-update","btn btn-light border","<i class='fas fa-pen-alt'></i>","update","data-toggle='tooltip' data-placement='bottom' title='Update'"); ?>
                        <?php buttonElement("btn-delete","btn btn-danger","<i class='fas fa-trash-alt'></i>","delete","data-toggle='tooltip' data-placement='bottom' title='Delete'"); ?>
                        <?php deleteBtn(); ?>
                    </div>
                   
                </form>
            </div>

            <!-- Database Table -->
            <div class="d-flex table-data">
                <table class="table table-striped table-dark">
                    
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Book Name</th>
                            <th>Publisher</th>
                            <th>Book Price</th>
                            <th>Edit</th>
                        </tr>
                    </thead>

                    <tbody id="tbody">
                        <?php

                            if(isset($_POST['read'])){
                                $result = getData();

                                if($result){

                                    while ($row = mysqli_fetch_assoc($result)){ ?>

                                        <tr>
                                            <td data-id="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>
                                            <td data-id="<?php echo $row['id']; ?>"><?php echo $row['book_name']; ?></td>
                                            <td data-id="<?php echo $row['id']; ?>"><?php echo $row['book_publisher']; ?></td>
                                            <td data-id="<?php echo $row['id']; ?>"><?php echo 'Rs. ' . $row['book_price']; ?></td>
                                            <td><i class="fas fa-edit btnedit" data-id="<?php echo $row['id']; ?>"></i></td>
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

    <!-- Custom JS File -->
    <script src="app.js"></script>

    <!-- Bootstrap JS CDN -->  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>