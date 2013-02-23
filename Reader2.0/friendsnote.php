

 <?php  
      include_once("connection/db_connection.php"); 
      session_start();
           
      $oid = $_REQUEST['oid'];
      $uid = $_SESSION['uid'];
      $friends = getAllFriends($uid);
      $objectName = getObjectName($oid);
      $flag = 0;
?>
<html>
   <head>
		 <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		 
		<title> <?=$objectName['name']?> </title>
	</head>
   
	<body>
		 <h1>   <?=$objectName['name']?>   </h1>
		 <h2>  好友笔记  </h2>
	     <?php 
             
	         foreach($friends as $friend){
	         	$notes = getUserNotes($friend['uid1'],$oid);
                 
	         	if(count($notes) != 0){
	         		$flag = 1;
	         		foreach($notes as $note){
      ?>
		 
		   <div  class = "friendnote">
               <p><?= $note['title']?> </p>
              <p><?= Database::getUserName($note['uid'])?> </p>
              <p><?=$note['since']?> </p>
              <p> <?=$note['description']?> </p>
            </br>
		   </div>
         
          <?php 
                 }
               }

            }

            if(!$flag){
                echo "<h3>暂无好友笔记</h3>";
            }
         ?>

	</body>
</html>

<?php

function getObjectName($oid){
    $query  = "select name from Objects where oid=$oid"; 
    $result = Database::selectFromDatabase($query);
    return $result[0];
}

function getAllFriends($uid){
  $query = "select * from Friends where uid1=$uid";
  
  return Database::selectFromDatabase($query);
}


function getUserNotes($uid,$oid){ 
   
   $query = "select * from Notes where uid=$uid and oid=$oid";
   
   return Database::selectFromDatabase($query);

}

function getAllFriendsNotes($uid,$oid){
   
    $Friends = getAllFriends($uid);

    $notes = array();
    $counter = 0;
    foreach ($Friends as $value) {
    	$notes[$counter] = getUserNotes($value,$oid);
    	$counter = $counter + 1;
    }
     
   return $notes;
}
?>