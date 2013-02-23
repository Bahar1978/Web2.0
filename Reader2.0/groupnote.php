
<html>
   <head>
		 <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		 
		<title></title>
	</head>
    <?php  
           include_once("connection/db_connection.php"); 
           session_start();
           $oid = $_REQUEST['oid'];
           $uid = $_SESSION['uid'];
           $groups = getAllGroups($uid);
          
           //print_r(getGroupName($groups[0]));
    ?>

	<body>
		 <h1>   小组笔记   </h1>
         
	     <?php 
            if(count($groups) == 0){
              echo "您尚未加入任何小组";
            }

	         foreach($groups as $group){
                  $groupName = getGroupName($group);    
        ?>  
            <div id = "group">
            <h2>  组名 <?= $groupName['name']?> </h2>
        <?php 
            
	         	$members = getAllMembers($group);          
	         		foreach($members as $member){
                $flag = 0; 
        ?>
                <p><?= Database::getUserName($member)?> </p>
        <?php


                $notes = getUserPublicNotes($member,$oid);
                if(count($notes) != 0) $flag = 1;
                foreach($notes as $note){

         ?>
		 
		          <div  class = "membernote">
                    <p><?= $note['title']?> </p>
                     <p><?=$note['since']?> </p>
                     <p> <?=$note['description']?> </p>
                   </br>
		          </div>
            </div>
          <?php
                } 
              }
            ?>
          </br>
            <?php
              if($flag == 0) 
                echo "该组暂无公开笔记";
            }
         ?>
         
	</body>
</html>

<?php



function getAllGroups($uid){
  
  
  $query = "select gid from UsersGroupsRelation where uid=$uid";
  $groups = Database::selectFromDatabase($query);
  
  $result = array();
  $counter = 0;
  
  foreach($groups as $group){
    
    $result[$counter] = $group['gid'];
    $counter  = $counter + 1;

  }

  return $result;
}

function getGroupName($gid){
   $query = "select name from Groups where gid=$gid";
   $result = Database::selectFromDatabase($query);

   return $result[0];
}


function getAllMembers($gid){
  
  $query = "select uid from UsersGroupsRelation where gid=$gid";
  $temp = Database::selectFromDatabase($query);
    
  $result = array();
  $counter = 0;
  foreach($temp as $user){
     
     $result[$counter] = $user['uid'];
     $counter = $counter + 1;

  }

  return $result;
}


function getUserPublicNotes($uid,$oid){ 
   
   $query = "select * from Notes where uid=$uid and oid=$oid and public = 1";
   $result = Database::selectFromDatabase($query);

   return $result;

}


?>