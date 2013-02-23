<?php
 
 session_start();

?>

<html>
   <?php 
        include_once("connection/db_connection.php"); 
        $oid = $_REQUEST['oid'];
        $info = getObjectInfomation($oid);
        $creater = Database::getUserName((int)$info['uid']);
    ?> 
	<head>
		 <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title> <?=$info['name']?> </title>
	</head>

	<body>       
		 <h1> <?=$info['name']?> </h1>
           <h2> 创建者 </h2>  <?=$creater ?>
           <h2>  创建时间</h2> <?= $info['since'] ?>
           <h2>  描述 </h2>
              <p>   <?= $info['description']?>  </p>
           <h2>  标签 </h2>
           <?php
               
               $tags = getAllTags($oid);
               
               foreach($tags as $tag){
           ?>    
           
                 <span class = "tag"> <?=$tag['description']?> </span>    
          <?php    
               }

           ?> 

           <h3> 添加新标签 </h3>
           <form action=<?="connection/tag_controler.php?flag=create&oid=".$_REQUEST['oid']?> method="POST">
      
              description
              <textarea name="description" rows = "1" cols = "20"/>
              </textarea>
              </br>
              <input type="submit"/>
            </form> 

              <a href=<?="mynote.php?oid=".$_REQUEST['oid']?> target="view_window">  点击查看我的笔记 </a> </br>
              <a href=<?="friendsnote.php?oid=".$_REQUEST['oid']?> target="view_window"> 点击查看好友笔记 </a>  </br>
              <a href=<?="groupnote.php?oid=".$_REQUEST['oid']?> target="view_window"> 点击查看小组笔记 </a> 
          <h2> 评论 </h2>
           <?php
               
               $comments = getAllComments($oid);
               
               foreach($comments as $comment){
           ?>    

                <div>用户<?=Database::getUserName($comment['uid'])?></div>
                <div> 评论 <?=$comment['description']?> </div>

          <?php    
               }

           ?> 


          <h2> 添加我的评论 </h2>
              <form action=<?="connection/comments_controler.php?flag=create&oid=".$_REQUEST['oid']?> method="POST">
			   description </br>
                 <textarea name="description" rows = "3" cols = "100"/>
                 </textarea>
                 </br>
			           <input type="submit"/>
		          </form>
	</body>
</html>

<?php


function getObjectInfomation($oid){
    $query  = "select * from Objects where oid=$oid"; 
    $result = Database::selectFromDatabase($query);
    return $result[0];
}


function getAllComments($oid){
  $query = "select * from Comments where oid=$oid";
  return Database::selectFromDatabase($query);
}

function getAllTags($oid){
  
   $query = "select * from Tag where oid=$oid";
   return Database::selectFromDatabase($query);

}



?>
