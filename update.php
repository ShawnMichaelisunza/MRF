<!DOCTYPE html>
<html>

    <?php include('navbar/header.php')?>
    <?php include('db_connect/connection.php');?>

        <!-- Update Button -->

        <?php
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            

            $query = "SELECT * from bpcodes WHERE recno = $id";

            $result = mysqli_query($conn, $query);

            if(!$result){
                die("query failed").mysqli_error();
            }
            else{

                $row = mysqli_fetch_assoc($result);


        }
                                      
    }                                        
    
        ?>                                       

        <?php
        
        if(isset($_POST['update'])){
            if(isset($_GET['id_new'])){
                $idnew = $_GET['id_new'];
            }
            
            $clientName = $_POST['client-name'];
            $bpCode = $_POST['bpcode'];
            $noPsp = $_POST['No-psp'];
            $dropdown = $_POST['dropdown'];

            $query = "UPDATE bpcodes SET client_name = '$clientName', client_bpcode = '$bpCode', no_of_psp_contract = '$noPsp', e_comp = '$dropdown'
            WHERE recno = '$idnew'";
            

            $result = mysqli_query($conn, $query);

            if(!$result){
                die("query failed").mysqli_error();
            }
            else{
                header('Location: index.php');

            }
        }
        ?>

<div class="container">
        <div>
            <h1 style="text-align: center; margin: 30px 0 20px 0;">Update</h1>
        </div>
    <div class="add-psp">
        <div class="add-form">
        <form action="update.php?id_new=<?php echo $id; ?>" method="POST">

        <div class="comp-add mb-3">
        <label for="">Company Address</label>
        <select name="dropdown" class="btn btn-success">
        <option value="">Company Address</option>
        <option value="Option 1">Option 1</option>
        <option value="Option 2">Option 2</option>
        <option value="Option 3">Option 3</option>
        </select>
        </div>

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
        <button type="update" class="btn btn-primary" name="update"><a  style="text-decoration: none; color: white;">Update</a></button>
        <button type="reset" class="btn btn-danger"><a href="index.php" style="text-decoration: none; color: white;">Back</a></button>
        </div>
        </form>
        </div>
    </div>
</div>



</body>
</html>