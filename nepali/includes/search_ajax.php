<?php
include('../clientobjects.php');

$key = $_POST['key'];
$limit = 6;

$sql = "SELECT * FROM groups WHERE (name like '%$key%' 
					OR urlname like '%$key%'
					OR shortcontents like '%$key%'
					OR contents like '%$key%'
					OR pageTitle like '%$key%'
					OR pageKeyword like '%$key%'
					OR pageDescription like '%$key%') 
					AND (name !='' AND (shortcontents != '' OR contents != '')) 
					ORDER BY onDate DESC, id DESC 
					";

$sql2 = $sql . " LIMIT " . $limit;

$result = $conn->exec($sql2);

$total = $conn->exec($sql);
if ($conn->numRows($total) > 0)
{
  while ($row = $conn->fetchArray($result))
  {
    ?>
    <div class="search">
      <h2 class="title"><a href="<?php echo $row['urlname']; ?>"><?php echo $row['name']; ?></a></h2>
      <p>
        <?php echo substr(strip_tags($row['shortcontents']), 0, 100); ?>
      </p>
    </div>

    <?php
  }
  if ($conn->numRows($total) > $limit)
  {
    ?>
    <div class="search">
      <h2 class="title" style="text-align: center; padding-bottom:15px; ">
        <form action="search" method="post">
          <input type="hidden" name="key" value="<?php echo $_POST['key']; ?>">
          <button class="btn btn-default" type="submit">View More</button>
        </form></h2>
    </div>
    <?php
  }
}
else
{
  ?>
  <div class="search">
    <h2 class="title" style="text-align: center; padding-bottom:15px; ">
      Sorry No Result Found.
    </h2>
  </div>
  <?php
}
?>
 


