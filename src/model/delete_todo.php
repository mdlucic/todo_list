<?php
/**
 *Deletes from db where id of message matches with given one and redirects user to the same page
 */

require ("../../config/database.php");

$sql = "DELETE FROM todo.messages WHERE id = :id";
$db = new DBConn;
$stmt = $db->connect()->prepare($sql);
$stmt->bindParam(':id', $_POST['delete']);

if($stmt->execute())
{
	header("Location: ../../public/view/homepage.php?deleted");
	exit();
}
else
{
	echo "<p>Error, not deleted";
}
$db = null;

?>
