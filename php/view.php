<link rel="stylesheet" href="../css/view.css">

<?php include 'entry-point/unchanged.php';?>


<?php 
$mydata = new MyData();
$all_data = $mydata->search($keyword, $location, $category);
?>

<h3> Search criteria: </h3>
<ul> 
  </li>
  <li> Keyword:  <?php echo $mydata->get_keyword(); ?>  </li>
  <li> Location: <?php echo $mydata->get_location(); ?>  </li>
  <li> Category: <?php echo $mydata->get_category(); ?>  </li>
</ul>

<table class="list" style="width:100%">
  	  <tr class="tab_header">
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
  	    <th>Start</th>
  	    <th>Finish</th>
  	    <th>Location</th>
        <th>Category</th>
        <th>Private</th>
  	  </tr>
	  
<?php while ($row = mysqli_fetch_assoc($all_data)) { ?>

<tr class="tr_body">
  <td align="center" width="5%"> <?php echo h($row['id']); ?></td>
  <td width="15%"> <?php echo h($row['name']); ?></td>
  <td width="30%"> <?php echo h($row['description']); ?></td>
  <td width="10%"> <?php echo h($row['start']); ?></td>
  <td width="10%"> <?php echo h($row['finish']); ?></td>
  <td width="10%"> <?php echo h($row['location']); ?></td>
  <td width="10%"> <?php echo h($row['category']); ?></td>
  <td width="5%"> <?php echo h($row['private']); ?></td>
</tr>
<?php } ?>
</table>

   <?php
	  $mydata->free_data($all_data);
  ?>
  </div>
  

  