<?php
include "includes//stm_navbar_cys.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>COMPUTER DEPARTMENT HOMEPAGE</title>
    <link rel="stylesheet" href="css//stm_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: linear-gradient(270deg,#d53685,#16abbe);">



    <div class="main">
        <div class="con1">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade my-2 carousel_department" data-bs-ride="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="image//slider_pic6.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="image/slider_pic2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="image/slider_pic3.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="con2">
            <div class="child1">
                <div class="dynamic_btn">
                    <div class="box">
                        <div class="icon"><i class="fa fa-youtube-play" aria-hidden="true"></i></div>
                        <div class="content">
                            <a href="https://www.youtube.com/user/SpokenTutorialIITB">
                                <h3>Spoken Videos</h3>
                            </a>
                            <p>This function provides Spoken Tutorial Videos!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="child2">
                <div class="dynamic_btn">
                    <div class="box">
                        <div class="icon"><i class="fa fa-trophy" aria-hidden="true"></i></div>
                        <div class="content">
                            <a href="toppers_main.php">
                                <h3>Toppers!</h3>
                            </a>
                            <p>Click Here To View Toppers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</body>

</html>