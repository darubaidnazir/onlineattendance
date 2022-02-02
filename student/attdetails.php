<?php
require 'header.php';

$studentid = $_SESSION["studentid"];
?>

<head>

    <link rel="stylesheet" href="css/table.css">
</head>

<body>

    <table>
        <caption>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="class">Select a Class:</label>
                <select name="classid" id="class">
                    <option value="hi">Select a Class: </option>
                    <?php
                    $totalclass1 = "SELECT * FROM `classes` NATURAL join `enrolledclass` WHERE studentid = '$studentid'";
                    $totalclassr1 = mysqli_query($conn, $totalclass1);
                    while ($row = mysqli_fetch_assoc($totalclassr1)) {



                    ?>

                        <option value="<?php echo $row['classid1']; ?>"><?php echo $row['classname'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br><br>
                <input type="submit" value="Find" name="submit">
            </form>

        </caption>


        <thead>

            <tr>
                <th scope="col">Class Id</th>
                <th scope="col">Class Name</th>
                <th scope="col">Total class</th>
                <th scope="col">Present/Absent</th>
                <th scope="col">Percentage</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['submit'])) {
                $classid['classid'] = $_POST['classid'];
                $classid1 = $_POST['classid'];
                $classname = "Select * FROM classes where classid1='$classid1'";
                $classnamer = mysqli_query($conn, $classname);
                $att = "SELECT * FROM `$classid1` WHERE studentid = '$studentid'";
                $attr = mysqli_query($conn, $att);
                if ($classid1 == "hi") {
                    exit();
                } else {
                    $countclass['totalclass'] = mysqli_num_rows($attr);
                }



                $att1 = "SELECT * FROM `$classid1` WHERE studentid = '$studentid' and Status =0";
                $attr1 = mysqli_query($conn, $att1);
                if ($classid1 == "hi") {
                } else {
                    $countclass['totalpresent'] = mysqli_num_rows($attr1);
                }



            ?>

                <tr>
                    <td data-label="Class Id">
                        <?php
                        if (isset($classid['classid'])) {
                            echo $classid['classid'];
                        }
                        ?>
                    </td>
                    <td data-label="Class Name">

                    <?php
                    $classnamerow = mysqli_fetch_assoc($classnamer);
                    echo $classnamerow['classname'];
                }
                    ?>
                    </td>
                    <td data-label="Total Class">
                        <?php if (isset($countclass['totalclass'])) {
                            echo $countclass['totalclass'];
                        }
                        ?>
                    </td>

                    <td data-label="Prsent/Absent">
                        <?php if (isset($countclass['totalpresent'])) {
                            echo $countclass['totalpresent'];
                            echo '-';
                            echo  $countclass['totalclass'] - $countclass['totalpresent'];
                        }
                        ?>

                    </td>
                    <td data-label="Persentage">
                        <?php if (isset($countclass['totalpresent'])) {
                            if ($countclass['totalclass'] == 0) {
                                echo 0;
                            } else {
                                $result =  $countclass['totalpresent'] / $countclass['totalclass'] * 100;
                                echo $result;
                            }


                            echo '%';
                        }
                        ?>

                    </td>
                </tr>

        </tbody>
    </table>
    <?php
    require 'footer.php';
    ?>
</body>