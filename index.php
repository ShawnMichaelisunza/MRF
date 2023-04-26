<?php

include('db_connect/connection.php');

// Date






// 

// get page number
if(isset($_GET['page_no']) && $_GET['page_no'] !==""){
    $page_no = $_GET['page_no'];
}else{
    $page_no = 1;
}

// total rows or records to display

$total_records_per_page = 16;

// get the page offset for the LIMIT query

$offset = ($page_no -1) * $total_records_per_page;

// get previous page
$previous_page = $page_no -1;
// get next page 
$next_page = $page_no + 1;


// get the total count of records
$result_count = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM cmatrixi_mrf.bpcodes")
 or die(mysqli_error($conn));

//  total records
$records = mysqli_fetch_array($result_count);
// store total_records to a variable

$total_records = $records['total_records'];

// get total pages
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// write query from database

$sql = "SELECT * FROM bpcodes ORDER BY modified_date LIMIT $offset , $total_records_per_page";

// make query & get result

$result = mysqli_query($conn, $sql);

// fetch the resultiing rows an array

$requests = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory

mysqli_free_result($result);

// close connection

mysqli_close($conn);



?>




<!DOCTYPE html>
<html lang="en">
    <?php include('navbar/header.php')?>

    <div class="container"> 
        <div class="MRF">
            <div class="MRF-btn">
                <div>
                <form class="search" method="GET" action="search.php">
                <button class="btn btn-primary" type="submit">Search</button>
                <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search">
                </form> 
                </div>
                <button type="button" class="add-btn btn btn-primary" ><a href="add.php">Add</a></button>
            </div>
            <div class="MRF-table">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">ID</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Client BPcode</th>
                        <th scope="col">No. of PSP( Contact )</th>
                        <th scope="col">No. of PSP( Payroll )</th>
                        </tr>
                    </thead>
                    <?php foreach($requests as $mrf){?>
                        <tr>
                        <td><?php echo htmlspecialchars($mrf['add_date'])?></td>
                        <th scope="row" name="id"><?php echo htmlspecialchars($mrf['recno'])?></th>
                        <td><?php echo htmlspecialchars($mrf['client_name'])?></td>
                        <td><?php echo htmlspecialchars($mrf['client_bpcode'])?></td>
                        <td><?php echo htmlspecialchars($mrf['no_of_psp_contract'])?></td>
                        <td><?php echo htmlspecialchars($mrf['no_of_psp_payroll'])?></td>
                        <td><button type="button"  class="btn btn-success" name="update">
                        <a href="update.php?id=<?php echo htmlspecialchars($mrf['recno'])?>">Update</a></button></td>
                        </tr>
                        <?php }?>
                </table>
            </div>
        </div>
        <nav class="page_bar">
            <ul>
                <li><a class=" <?=($page_no <= 1)? 'disabled' : '';?>"
                <?= ($page_no > 1)? 'href=?page_no=' . $previous_page : '';?>>Previous</a></li>

                
                <?php for($counter =1; $counter <= $total_no_of_pages; $counter++){?>
                    <?php if($page_no != $counter){?>
                <li><a href="?page_no=<?= $counter?>"><?= $counter?></a></li>
                    <?php } else {?>
                    <li><a><?= $counter?></a></li>
                    <?php }?>
                <?php }?>


                <li><a class=" <?=($page_no >= $total_no_of_pages)? 'disabled' : '';?>"
                <?= ($page_no < $total_no_of_pages)? 'href=?page_no=' . $next_page : '';?>>Next</a></li>
            </ul>
            <div class="display-page">
            <strong>Page <?= $page_no;?> of <?= $total_no_of_pages;?></strong>
            </div>
        </nav>
    </div>

    <?php include('navbar/footer.php')?>
