<?php
$index = 0;
//@include "./connection.php";
@include "include/config.php";
session_start();
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Card</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <style>
        @font-face {
            font-family: 'pop-regular';
            src: url('font/Poppins-Regular.ttf');
        }

        body {
            font-family: 'pop-regular';
            /* background-color: #f5f5f5; */
            /* display: flex; */
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            margin: 0;
        }

        .fleet {
            display: flex;
            flex-wrap: wrap;
            background-color: rgb(203, 231, 230);
            margin-top: 20px;
            justify-content: center;
            margin-left: -28px;
            margin-right: -28px;
        }

        .card {
            background-color: white;
            width: 315px;
            max-width: 1050px;
            border-radius: 10px;
            box-shadow: 0 4px 12px -5px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            padding: 20px;
            margin: 17px 10px;

           
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: -20px;
            /* margin-bottom: -25px; */
        }

        .card-title {
            font-size: 27px;
            color: #333;
            font-weight: bold;
        }

        .card-image img {
            width: 300px;
            margin: 20px 0px;
            border-radius: 5px;
            margin-top: 0px;
            height: 280px;
            align-items: center;
            margin-left: -13px;
            margin-top: -12px;
        }

        .description {
            font-size: 0.875rem;
            color: #666;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .card-footer {
            /* display: flex; */
            align-items: center;
            justify-content: space-between;
            /* margin-top: -14px; */
            /* flex-wrap: wrap; */
        }

        .price {
            font-size: 20px;
            color: #333;
            font-weight: bold;
            margin-top: 10px;
        }

        .order-button {
            background-color: #fff;
            color: #000;
            padding: 7px 15px;
            font-size: 0.875rem;
            border: 1px solid black;
            border-radius: 5px;
            cursor: pointer;
            width: 267px;
        }

        .capacity {
            margin-top: -7px;
            color: #333;
        }

        .fual {
            color: #333;
        }

        .button {
            text-decoration: none;
            color: #000;
            font-size: 20px;
        }

        #header {
            margin-top: 10px;
            /* background-color: #b1d7d6; */
            width: 100%;
        }

        .badge {
            background-color: #ddbebe;
            color: #ff4d4d;

            border-radius: 15px;
            font-size: 18px;
            display: inline-block;
            margin-bottom: 10px;
            margin-top: 14px;
            padding-left: 24px;

        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header h1 {
            font-size: 35px;
            margin-bottom: 15px;
            color: black;
        }
    </style>
</head>
<?php
@include "navbar.php";
?>

<body>
    <?php
    @include "advertisement.php";
    ?>
    <?php
    @include "explore_car.php"
    ?>

    <div class="fleet">
        <div class="header" id="header">
            <span class="badge" style="padding: 4px 11px; width: 178px;">Most Popular Car</span>
            <h1>Most Popular Car</h1>

        </div>
        <?php

$select_car = mysqli_query($conn, "SELECT * from car_list order by vid  desc  LIMIT 3");
if (mysqli_num_rows($select_car) > 0) {
    while ($row = mysqli_fetch_array($select_car)) {
        $image=explode(",",$row['image']);
        //print_r($image); 
?>
<a href="car_detail.php?vid=<?php echo $row['vid']; ?>" >
        <div class="card">
            <div class="card-image">
           <img src="admin/img/<?php echo $image[0]; ?>">
            </div>
            <div class="card-header">
                <h2 class="card-title"><?php echo $row['cname']; ?></h2>
            </div>
            <div class="card-body">
                <p class="description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <hr>
                <div class="card-footer">
                    <h3 class="price"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $row['price']; ?>/-(per day)</h3>
                    <h3 class="price" style="margin-top: -10px;"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $row['chprice']; ?>/-(per hour)</h3>
                </div>
                <h3 class="capacity"><i class="fa-solid fa-car"></i> Capacity: <?php echo $row['seat']; ?></h3>
                <h3 class="fual"><i class="fa-solid fa-gas-pump"></i> fual: <?php echo $row['fual']; ?></h3>
                <div>
                            <?php if ($_SESSION["alogin"]) { ?>
                                <button class="order-button button" type="submit" name="rent-now">Rent Now</button></a>
                            <?php } else { ?>

                                <button class="order-button"><a href="login.php" class="button">Login For Book</a></button>
                            <?php } ?>
                        </div>
            </div>
        </div> 
        <?php
            };
        };
        ?> 
    </div> 
    <?php
    @include "explore_brand.php";
    ?>
    
    <?php
    @include "we_best.php";
    ?>

    <?php
    @include "slider.php";
    ?>
    <?php
    @include "footer.php";
    ?>

</body>

</html>