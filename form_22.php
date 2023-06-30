<?php
session_start();
// echo "Hello";
if (isset($_POST['submit'])) {
    echo "Hello";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "leave_mangt";

    $conn = mysqli_connect($servername, $username, $password, $db);

    if (!$conn) {
        die("can not connected to database <br> due to " . mysqli_connect_error());
    } else {
        //    echo"connected to database";
        $id = $_SESSION['username'];
        $name = $_POST['name'];
        $desg = $_POST['designation'];
        $perod_req = $_POST['days'];
        $l_from = $_POST['l_from'];
        $l_till = $_POST['l_till'];
        $reason = $_POST['reason'];
        $img = $_POST['file'];
        // echo $name;
        $sql = "INSERT INTO `form2` ( `id` , `name`, `designation`, `period_leave_req`, `leave_from`, `leave_till`, `reason`, `image`) VALUES ( '$id','$name', '$desg', '$perod_req', '$l_from', '$l_till', '$reason ','$img');";
        // $result = $conn->query($sql);
        if ($conn->query($sql) == true) {
            echo "<script> alert('done');</script>";
            header("Location: ./final_profile.php");
        } else {
            echo "<script> alert('Failed!!!!!!');</script>";
            echo "ERROR: $sql <br> $conn->error"; // used to access key object from $con.
        }
        $conn->close();
    }
    // $conn->close();
    header("Location: ./final_profile.php");
} else {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "leave_mangt";

    $conn = mysqli_connect($servername, $username, $password, $db);

    if (!$conn) {
        die("can not connected to database <br> due to " . mysqli_connect_error());
    } else {
        $id = $_SESSION['username'];
        $sql = "SELECT rem_medical from profile where id='$id'";
        $res = mysqli_fetch_assoc($conn->query($sql));
        $rem = (int)$res['rem_medical'];
        if ($rem < 1) {
            echo"<script>
            
            alert($rem);
            
        </script>";
?>  
        <script>
            
            alert($rem);
            alert("hello");
        </script>
            <div>
                No Remaining Leaves
            </div>
        <?php
        } else {
            $sql="SELECT rem_medical from profile where id='AAG';";
            $sql = "SELECT * from profile where id='$id'";
            $row = mysqli_fetch_assoc($conn->query($sql));
        ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="CSS/form22Style.css">
                <link rel="icon" type=“image/png” href="./images/clg.png" />
                <title>casual leave form</title>
            </head>

            <body>
                <div id="container">
                    <div id="head">
                        <p class="header" style="color: white;">APPLICATION &nbsp; FOR &nbsp; LEAVE</p>
                    </div>
                    <div id="body">
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST"><br>
                            <label for="name">Name of the Applicant</label>
                            <span>
                            <!-- value="<?= $row["name"] ?>" -->
                                <input name="name" id="name"  type="text" style="margin-right: 30px; float: right;" required />
                            </span><br><br>
                            <label for="designation">Designation</label>
                            <span>
                                <input name="designation" id="designation" type="text" style="margin-right: 30px; float: right;" require />
                            </span><br><br>
                            <label for="days">Period of Leave Required</label>
                            <span>
                                <input name="days" id="days" type="text" style="margin-right: 30px; float: right;" required />
                            </span><br><br>
                            <label for="l_from">Leave from</label>
                            <span>
                                <input name="l_from" id="l_from" onchange="setDate(event)" type="date" type="date" style="margin-right: 30px; float: right;" />
                            </span><br><br>
                            <label for="l_till">Leave Till</label>
                            <span>
                                <input name="l_till" id="l_till" disabled type="date" style="margin-right: 30px; float: right;" />
                            </span><br><br>
                            <label for="reason">Reason for Requirement of Leave</label>
                            <span>
                                <input name="reason" id="reason" type="text" style="margin-right: 30px; float: right;" />
                            </span><br><br>
                            <label for="file">Attach file </label>
                            <span>
                                <input name="file" id="file" type="file" style="margin-right: 30px; float: right;" />
                            </span><br><br>
                            <input type="submit" value="Submit" name="submit" style="align-content: center; font-size: 15px;">
                        </form>
                    </div>
                </div>
                <script>
                    document.getElementById("l_from").min = new Date().toISOString().split("T")[0];

                    function setDate(e) {
                        const st = new Date(e.target.value);
                        const start = new Date(e.target.value);
                        st.setDate(st.getDate() + <?= $rem ?> - 1)
                        document.getElementById("l_till").min = start.toISOString().split("T")[0];
                        document.getElementById("l_till").disabled = false
                        document.getElementById("l_till").max = st.toISOString().split("T")[0];
                    }
                    
                </script>
                
            </body>

            </html>
<?php
        }
    }
}
