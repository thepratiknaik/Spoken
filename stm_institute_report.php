<?php 
    require "dbc.php";
?>

<?php
error_reporting(0);
$conn = mysqli_connect("localhost", "root", "", "dims_db");

// FOR SUM OF APPEARED
$query = "SELECT SUM(appeared) AS sum1 FROM `inst_overall_table`";
$query_result1 = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($query_result1)) {
    $output1 = "" . " " . $row['sum1'];
}
// FOR SUM OF PASSED
$query = "SELECT SUM(passed) AS sum2 FROM `inst_overall_table`";
$query_result2 = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($query_result2)) {
    $output2 = "" . " " . $row['sum2'];
}
// FOR SUM OF FAILED
$query = "SELECT SUM(failed) AS sum3 FROM `inst_overall_table`";
$query_result3 = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($query_result3)) {
    $output3 = "" . " " . $row['sum3'];
}




$sql = "SELECT * FROM `inst_overall_table`";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Computer', 'Information Technology', 'Electronics & Telecommunication', 'Electronics', 'Overall'],
            <?php
            $query = "SELECT * FROM report_overall";
            $res = mysqli_query($conn, $query);
            while ($data = mysqli_fetch_array($res)) {
                $year = $data['year'];
                $comps = $data['comps'];
                $it = $data['it'];
                $extc = $data['extc'];
                $elect = $data['elect'];
                $overall = $data['overall'];
                // ,'Percentage'
                // $percentage = $data['percentage'];
                // ,<?php echo $percentage;
            ?>['<?php echo $year; ?>', <?php echo $comps; ?>, <?php echo $it; ?>, <?php echo $extc; ?>, <?php echo $elect; ?>, <?php echo $overall; ?>],
            <?php
            }
            ?>
        ]);

        // var options = {
        //   chart: {
        //     title: 'Yearly Comparision',
        //     subtitle: 'From Year 2015-2020',
        //   }
        // };
        var options = {
            title: 'Yearly Comparision (Overall)',
            vAxis: {
                title: 'Passing Percentage',
                titleTextStyle: {
                    color: 'red'
                }

            },
            hAxis: {
                title: 'Year',
                titleTextStyle: {
                    color: 'red'
                }
            },
            colors: ['#de5709', '#ffea00', '#08d450', '#03adfc', '#cf0808'],
            is3D: true
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INSTITUTE REPORT</title>
    <link rel="stylesheet" href="css//stm_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


</head>

<body style="background-image: linear-gradient(90deg,#3bbd42,#16abbe);">


    <img class="header_img" src="image//header.jpg" alt="">



    <!-- <div class="headeerr">
    <img class="image-fluid" src="image//header.jpg" alt="">
</div> -->


    <nav class="navbar navbar-expand-lg navbar-light bg-dark" style="background-image: linear-gradient(-90deg,#3bbd42,#16abbe); font-weight:bolder;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SAKEC SPOKEN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="stm_institute_homepage.php"><i class="fas fa-home mx-1"></i>Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-university mx-1"></i>Department
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="stm_computer_homepage.php">Computer Engineering</a></li>
                            <li><a class="dropdown-item" href="stm_it_homepage.php">Information Technology</a></li>
                            <li><a class="dropdown-item" href="stm_extc_homepage.php">Electronics & Telecommunication</a></li>
                            <li><a class="dropdown-item" href="stm_electronics_homepage.php">Electronics Engineering</a></li>
                            <li><a class="dropdown-item" href="stm_ai_homepage.php">Artifical Intelligence & Data Science</a></li>
                            <li><a class="dropdown-item" href="stm_cys_homepage.php">Cyber Security</a></li>
                            <!-- <li><a class="dropdown-item" href="#">Another action</a></li> -->

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stm_institute_report.php"><i class="far fa-chart-bar mx-1"></i>Report</a>
                    </li>
                </ul>
                <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    </form> -->
                <button class="btn btn-danger" type="submit"><i class="far fa-user mx-1"></i>Profile</button>
            </div>
        </div>
    </nav>

    <div class="mx-1">
        <marquee behavior="" direction="">Welcome To SAKEC SPOKEN !... </marquee>
    </div>

    <!-- <h4><span class="badge bg-danger my-2 mx-auto">Report 2015-2021</span></h4> -->

    <div class="mx-auto my-2" style="width: 200px;">
        <h4><span class="badge bg-primary mx-auto">Report 2015-2021</span></h4>
    </div>




    <div class="chart_box my-1">
        <div id="columnchart_material"></div>
    </div>


    
<table class="mx-auto my-3" border="2">    
        <tr id="header">
            
            <th>Year</th>
            <th>Appeared</th>
            <th>Passed</th>
            <!-- <th>Failed</th> -->
            <th>Percentage</th>
        </tr>
        <?php 
           $output4 = ($output2/$output1)*100;
        ?>
        <?php
           while($row = mysqli_fetch_assoc($result)){
               echo "<tr> 
                       
                       <td>".$row['year']."</td>
                       <td>".$row['appeared']."</td>
                       <td>".$row['passed']."</td>
                       
                       <td>".$row['percentage']."%</td>
                    </tr>";
           }
        ?>
        <tr>
            <td><strong>Grand Total</strong></td>
            <td><strong><?php
                  echo $output1;
            ?> </strong>
            </td>
            <td><strong><?php
                  echo $output2;
            ?> </strong>
            </td>
            <td><strong><?php
                $output4 = round($output4,0);
                echo $output4;
            ?>%</strong>
            </td>
            
            <!-- <td><strong>
            </td> -->
        </tr>
    </table>
    






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>