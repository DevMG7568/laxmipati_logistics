<?php
@include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lp.png">
    <title>Laxmipati</title>
    <link rel="icon" href="lp.png">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    body{
        font-family: 'Poppins', sans-serif;
    }
    a{
        text-decoration: none;
    }
    .dj{
        background-color: #06033D;
        height:135px;
        width:100%;
    }
    .dj .rj{
        max-width: 1320px;
        margin: auto;
    }
    .dj .rj .top{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top:20px;
    }
    .dj .rj .top img{
        width: 200px;
        border-right: 1px solid white;
    }
    .dj .rj .top h2{
        font-size: 24px;
        font-weight: 500;
        color: white;
    }
    .dj .rj .bottom{

    }
    .dj .rj .bottom ul.a{
        list-style: none;
        display:block;
        background: transparent;
        box-shadow: none;
        width: auto;
        height: auto;
    }
    .dj .rj .bottom ul.a li{
        display: inline-block;
        margin: auto 10px;
    }
    .dj .rj .bottom ul.a li a{
        font-size: 20px;
        font-weight: 500;
        color: white;
    }
</style>
<body>
    <div class="dj">
        <div class="rj">
            <div class="top">
                <img src="logo.png" alt="">
                <h2>VEKARIYA AKSHAY HASMUKHABHAI</h2>
            </div>
            <div class="bottom">
                <ul class="a">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="get_booking.php">Booking</a></li>
                    <li><a href="allorder.php">All Booking</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>