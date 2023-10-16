<?php
require "includes//stm_navbar_computer.php";
?>
<?php
include "dbc.php";
?>


<?php
$year_select = $_GET['year_select'];
?>

<?php
error_reporting(0);
$conn = mysqli_connect("localhost", "root", "", "dims_db");

// FOR SUM OF APPEARED
$query = "SELECT SUM(appeared) AS sum1 FROM `stm_comp_result` WHERE year = '$year_select' ";
$query_result1 = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($query_result1)) {
    $output1 = "" . " " . $row['sum1'];
}
// FOR SUM OF PASSED
$query = "SELECT SUM(passed) AS sum2 FROM `stm_comp_result` WHERE year = '$year_select' ";
$query_result2 = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($query_result2)) {
    $output2 = "" . " " . $row['sum2'];
}
// FOR SUM OF FAILED
$query = "SELECT SUM(failed) AS sum3 FROM `stm_comp_result` WHERE year = '$year_select' ";
$query_result3 = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($query_result3)) {
    $output3 = "" . " " . $row['sum3'];
}

$output_percentage = (($output2 / $output1) * 100);


$sql = "SELECT * FROM `stm_comp_result` where year = '$year_select'";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>COMPUTER DEPARTMENT RESULT</title>
    <link rel="stylesheet" href="css//stm_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: linear-gradient(270deg,#d53685,#16abbe);">

    <form action="stm_computer_result.php" method="get" class="my-3 mx-3" style="display: none;">

        <select name="year_select" id="">
            <option selected>--Select Year--</option>
            <option value="2015-2016">2015-2016</option>
            <option value="2016-2017">2016-2017</option>
            <option value="2017-2018">2017-2018</option>
            <option value="2018-2019">2018-2019</option>
            <option value="2019-2020">2019-2020</option>
            <option value="2020-2021">2020-2021</option>
            <!-- <option value="2021-2022">2021-2022</option>
            <option value="2022-2023">2022-2023</option> -->

        </select>
        <input type="submit">
    </form>


    <div class="mx-auto my-2" style="width: 200px;">
        <h4><span class="badge bg-primary mx-auto"><?php echo "$year_select";  ?></span></h4>
    </div>

    <table class="mx-auto my-3" border="2">    
        <tr id="header">
            <th>Year</th>
            <th>Class</th>
            <th>Course</th>
            <th>Date</th>
            <th>Appeared</th>
            <th>Passed</th>
            <!-- <th>Failed</th> -->
            <th>Percentage</th>
        </tr>
        <?php
        $output4 = ($output2 / $output1) * 100;
        ?>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr> 
                       <td>" . $row['year'] . "</td>
                       <td>" . $row['class'] . "</td>
                       <td>" . $row['course'] . "</td>
                       <td>" . $row['date'] . "</td>
                       <td>" . $row['appeared'] . "</td>
                       <td>" . $row['passed'] . "</td>
                       
                       <td>" . $row['percentage'] . "%</td>
                    </tr>";
        }
        ?>
        <tr>

            <td colspan="4"><strong>Grand Total</strong></td>
            <td><strong><?php
                        echo $output1;
                        ?> </strong>
            </td>
            <td><strong><?php
                        echo $output2;
                        ?> </strong>
            </td>
            <td>
                <strong><?php
                echo round($output_percentage);
                ?>%</strong>
            </td>

        </tr>
    </table>





</body>

</html>