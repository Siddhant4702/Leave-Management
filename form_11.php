<?php
session_start();
if (isset($_POST['submit'])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "leave_mangt";

    $conn = mysqli_connect($servername, $username, $password, $db);

    if (!$conn) {
        die("can not connected to database <br> due to " . mysqli_connect_error());
    }
     else {
        $id = $_SESSION['username'];
        $name = $_POST['name'];
        $desg = $_POST['designation'];
        $dept = $_POST['department'];
        $period = $_POST['period'];
        $nature = $_POST['nature'];
        $l_from = $_POST['l_from'];
        $l_till = $_POST['l_till'];
        $reason = $_POST['reason'];
        $period_nature = $_POST['period_nature'];
        $address = $_POST['address'];
        $telephone = $_POST['telephone'];
        $file = $_POST['file'];

        $sql = "INSERT INTO `form1` (`staff_id`, `name`, `designation`, `dept_sec`, `period_leave_req_p_s`, `nature_leave`, `leave_from`, `leave_till`, `reason`, `period_nature`, `address`, `telephone`, `iamges`) VALUES ('$id','$name', ' $desg', '$dept','$period',' $nature', '$l_from','$l_till', '$reason', '$period_nature', '$address','$telephone','$file');";

        // $result = $conn->query($sql);

        if ($conn->query($sql) == true) {
            header("Location:./final_profile.php");
        } else {
            echo "ERROR: $sql <br> $conn->error"; // used to access key object from $con.
        }
        $conn->close();
    }
    //object operator ->
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
        $sql = "SELECT rem_casual from profile where id='$id'";
        $res = mysqli_fetch_assoc($conn->query($sql));
        $rem = (int)$res['rem_casual'];
        if ($rem < 1) {
        ?>
            <div>
                No Remaining Leaves
            </div>

        <?php
        } else {
            $sql = "SELECT * from profile where id='$id'";
            $row = mysqli_fetch_assoc($conn->query($sql));
        ?>


            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="icon" type=“image/png” href="/images/en_loop.png" />
                <link rel="icon" type=“image/png” href="./images/clg.png" />
                <title>Medical leave Form</title>
                <link rel="stylesheet" href="CSS/form11Style.css">
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
                            </span><br>


                            <label for="designation">Designation</label>
                            <span>
                                <input name="designation" id="designation" type="text" style="margin-right: 30px; float: right;" required />
                            </span><br>


                            <label for="department">Department/ Section</label>
                            <span>
                                <input name="department" id="department" type="text" style="margin-right: 30px; float: right;" />
                            </span><br>


                            <label for="period">
                                <p class="row">Period of Leave Required with</p>
                                <p class="row1"> Prefix/Suffix(Sunday/Public Holiday)</p>
                            </label>
                            <span>
                                <input name="period" id="period" type="text" style="margin-right: 30px; float: right;" />
                            </span><br><br><br>

                            <label for="nature">Nature of Leave</label>
                            <span>
                                <input name="nature" id="nature" type="text" style="margin-right: 30px; float: right;" />
                            </span><br>


                            <label for="l_from">leave from(Date) </label>
                            <span>
                                <input name="l_from" id="l_from" onchange="setDate(event)" type="date" style="margin-right: 30px; float: right;" />
                            </span><br>


                            <label for="l_till">leave Till(Date)</label>
                            <span>
                                <input name="l_till" id="l_till" disabled type="date" style="margin-right: 30px; float: right;" />
                            </span><br>


                            <label for="reason">Reason for requirement of Leave</label>
                            <span>
                                <input name="reason" id="reason" type="text" style="margin-right: 30px; float: right;" />
                            </span><br>


                            <label for="period_nature">
                                <p class="row">Period & Nature of Leave</p>
                                <p class="row1"> enjoyed prior to this leave</p>
                            </label>
                            <span>
                                <input name="period_nature" id="period_nature" type="text" style="margin-right: 30px; float: right;" />
                            </span><br><br><br>


                            <label for="address">Address during the leave period</label>
                            <span>
                                <input name="address" id="address" type="text" style="margin-right: 30px; float: right;" />
                            </span><br>


                            <label for="telephone">Telephone No./Mobile No. if any</label>
                            <span>
                                <input name="telephone" id="telephone" type="number" style="margin-right: 30px; float: right;" />
                            </span><br>


                            <label for="file">Attach file </label>
                            <span>
                                <input name="file" id="file" type="file" style="margin-right: 30px; float: right;" />
                            </span><br>
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
