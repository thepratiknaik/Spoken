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
    <title>COMPUTER DEPARTMENT HOMEPAGE</title>
    <link rel="stylesheet" href="css//stm_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: linear-gradient(270deg,#d53685,#16abbe);">

    <?php
    $query = "SELECT SUM(appeared) AS sum1 FROM `stm_comp_result` WHERE year = '2015-2016' ";
    $query_result1 = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_result1)) {
        $appeared = "" . " " . $row['sum1'];
    }
    // FOR SUM OF PASSED
    $query = "SELECT SUM(passed) AS sum2 FROM `stm_comp_result` WHERE year = '2015-2016' ";
    $query_result2 = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_result2)) {
        $passed = "" . " " . $row['sum2'];
    }

    echo $appeared;
    echo $passed;
    ?>

    



</body>

</html>