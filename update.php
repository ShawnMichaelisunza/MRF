<!DOCTYPE html>
<html>

    <?php include('navbar/header.php')?>
    
    <!-- Update Button -->
    <?php

    include('db_connect/connection.php');

    $id = $_GET['id'];
    $sql = "SELECT * FROM bpcodes WHERE recno = '$id'"; 
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['update'])) { 
        $clientName = $_POST['client-name'];
        $bpCode = $_POST['bpcode']; 
        $noPsp = $_POST['No-psp']; 
        $date = $_POST['date'] = date('Y-m-d');


        $sql = "UPDATE bpcodes SET client_name='$clientName', client_bpcode='$bpCode' , no_of_psp_contract='$noPsp'
         WHERE recno=$id"; 
        if (mysqli_query($conn, $sql)) {
            
            header('Location: index.php');
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    ?>

<div class="container">
        <div>
            <h1 style="text-align: center; margin: 30px 0 20px 0;">Update PSP</h1>
        </div>
    <div class="add-psp">
        <div class="add-form">
        <form action="update.php" method="POST">
        <input type="hidden" name="id" method="GET" value="<?php echo $row['recno']; ?>"> 
        <div class="mb-3">
        <label class="form-label">Client Name</label>
        <input type="text" class="form-control" name="client-name"  value="<?php echo $row['client_name']; ?>">
        </div>
        <div class="mb-3">
        <label  class="form-label">Client BPcode</label>
        <input type="text" class="form-control" name="bpcode" value="<?php echo $row['client_bpcode']; ?>">
        </div>

        <div class="mb-3">
        <label  class="form-label">No. of PSP ( Contract )</label>
        <input type="text" class="form-control" name="No-psp" value="<?php echo $row['no_of_psp_contract']; ?>">
        </div>

        <div class="mb-3">
        <!-- <label  class="form-label">Date</label> -->
        <input type="hidden" class="form-control" name="date" value="">
        </div>

        <div class="add-btn">
        <button type="update" class="btn btn-primary" name="submit"><a href="index.php" style="text-decoration: none; color: white;">Update</a></button>
        <button type="reset" class="btn btn-danger"><a href="index.php" style="text-decoration: none; color: white;">Back</a></button>
        </div>
        </form>
        </div>
    </div>
</div>



    <?php mysqli_close($conn); ?> 
</body>
</html>