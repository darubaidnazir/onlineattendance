<?php
require("header.php");
?>
<style>
    .first {

        width: 200px;
        margin: auto;

    }

    .first form select {
        background-color: green;
        color: white;
        padding: 10px;
        font-size: larger;
        font-style: bold;

    }
    input{
        background-color: black;
        color:white;
        padding: 10px;
        border-radius: 5px;
        border: 0;
        margin:5px;
        font-size:large;
    }
    input:hover{
        background-color: grey;
        cursor: pointer;
        pointer-events: visible;
    }
    </style>

<head>

    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <div class="first">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            
                <lable > 
                   Select a Class
                </lable>
                <option   >Slecta  class</option>
                <?php
                $teacherid = $_SESSION['teacherid'];
                $sqlteacher = "SELECT * FROM `classes` WHERE `teacherid` ='$teacherid'";
                $sqlteacherresult = mysqli_query($conn, $sqlteacher);
                $countclass = mysqli_num_rows($sqlteacherresult);
                if ($countclass > 0) {
                    while ($row = mysqli_fetch_assoc($sqlteacherresult)) {

                ?> <option    value="<?php echo $row['classid1']; ?>" > <?php echo $row['classname']; ?> </option> 
                
                <?php
                                                                                                            }

                                                                                                                ?>


                <?php
                } else {
                    echo "No Class found";
                }
                ?>
            </select>
            <input type="submit" name="load" Value="Load Attendance">
        </form>

    </div>
    
   
 <table>
        <caption>Attendance Details</caption>
        <caption style="color:blue">
            
        </caption>


        <thead>

            <tr>
                <th scope="col">Student Roll No</th>
                <th scope="col" title="Click Here To Take Attendance">Student Name</th>
                <th scope="col">Total Class</th>
                <th scope="col" title="Click Here To See Student Attendance Report">Present</th>
                <th scope="col">Absent</th>
                <th scope="col">Percenteage</th>
            </tr>
        </thead>
        <tbody>


    <?php
    
    require("footer.php");
    ?>
    <script>

        function loadbox(e){
            alert("hi");
        }
    </script>