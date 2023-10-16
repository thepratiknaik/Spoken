<?php
include "includes//stm_navbar_computer.php";
?>
<?php
include "dbc.php";
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>COMPUTER DEPARTMENT COURSE HISTORY</title>
    <link rel="stylesheet" href="css//stm_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: linear-gradient(270deg,#d53685,#16abbe);">



    <div class="mx-auto my-2" style="width: 20vw;">
        <h4><span class="badge bg-primary mx-auto">Course History</span></h4>
    </div>

    <table class="mx-auto my-3" border="2">
        <tr id="header">
            <th>Class</th>
            <th>Course</th>
            <th>Date</th>
        </tr>

        <?php

        //define total number of results you want per page  
        $results_per_page = 05;

        //find the total number of results stored in the database  
        $query = "select * from `stm_comp_course_history`";
        $result = mysqli_query($conn, $query);
        $number_of_result = mysqli_num_rows($result);

        //determine the total number of pages available  
        $number_of_page = ceil($number_of_result / $results_per_page);

        //determine which page number visitor is currently on  
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page - 1) * $results_per_page;

        //retrieve the selected results from database   
        $query = "SELECT *FROM `stm_comp_course_history` LIMIT " . $page_first_result . ',' . $results_per_page;
        $result = mysqli_query($conn, $query);

        // //display the retrieved result on the webpage  
        // while ($row = mysqli_fetch_array($result)) {  
        //     echo $row['class'] . ' ' . $row['course'] . '</br>';  
        // }  
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["class"] . "</td><td>"
                    . $row["course"] . "</td><td>" . $row["date"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </table>


    <div class="mx-auto my-2" style="width: 200px;">
        
                <?php
                //display the link of the pages in URL  
                for ($page = 1; $page <= $number_of_page; $page++) {
                    echo '<a class="btn btn-primary mx-3" href = "stm_computer_course_history.php?page=' . $page . '">' . $page . ' </a>';
                }

                ?>
    </div>

    <!-- <div class="container mx-auto
     my-3 pagination_btn">


    </div> -->

</body>

</html>