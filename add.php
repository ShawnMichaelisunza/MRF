<?php

include('db_connect/connection.php');

$error = array('client-name' => '', 'bpcode' => '', 'No-psp' => '');
$clientName = $bpCode = $noPsp = '';
if(isset($_POST['submit'])){

    $clientName = $_POST['client-name'];
    $bpCode = $_POST['bpcode'];
    $noPsp = $_POST['No-psp'];

    if(empty($_POST['client-name'])){
        $error['client-name'] = '* Client name is Required';
    }else{
        if(!preg_match('/^[a-zA-Z\s]+$/', $clientName)){
            $error['client-name'] = '* Letters only';
        }
    }

    if(empty($_POST['bpcode'])){
        $error['bpcode'] = '* BP Code is Required';
    }else{

    }

    if(empty($_POST['No-psp'])){
        $error['No-psp'] = '* Number of PSP is Required';
    }else{

    

        $clientName = mysqli_real_escape_string($conn, $_POST['client-name']);
        $bpCode = mysqli_real_escape_string($conn, $_POST['bpcode']);
        $noPsp = mysqli_real_escape_string($conn, $_POST['No-psp']);

        $sql = "INSERT INTO bpcodes(client_name, client_bpcode, no_of_psp_contract) VALUES ('$clientName','$bpCode','$noPsp')";

        if(mysqli_query($conn, $sql)){
            // Success
            header('Location: index.php');
        }else{
            echo 'query errors' . mysqli_error($conn); 
        }

    }
}


?>


<!DOCTYPE html>
<html lang="en">
<?php include('navbar/header.php')?>

<div class="container">
        <div>
            <h1 style="text-align: center; margin: 30px 0 20px 0;">Add PSP</h1>
        </div>
    <div class="add-psp">
        <div class="add-form">
        <form action="add.php" method="POST">
        <div class="mb-3">
        <label class="form-label">Client Name</label>
        <input type="text" class="form-control" name="client-name"  value="">
        <div style="color: red; font-size: 13px;"><?php echo htmlspecialchars($error['client-name']); ?></div>
        </div>
        <div class="mb-3">
        <label  class="form-label">Client BPcode</label>
        <input type="text" class="form-control" name="bpcode" value="">
        <div style="color: red; font-size: 13px;"><?php echo htmlspecialchars($error['bpcode']); ?></div>
        </div>

        <div class="mb-3">
        <label  class="form-label">No. of PSP ( Contract )</label>
        <input type="text" class="form-control" name="No-psp" value="">
        <div style="color: red; font-size: 13px;"><?php echo htmlspecialchars($error['No-psp']); ?></div>
        </div>

        <div class="add-btn">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <button type="reset" class="btn btn-danger" name="cancel"><a href="index.php" style="color: white; text-decoration: none;">Cancel</a></button>
        </div>
        </form>
        </div>
    </div>
</div>

<?php include('navbar/footer.php')?>