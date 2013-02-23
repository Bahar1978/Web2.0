
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
    ?>

	<body>
		 <h1>   笔记   </h1>
         <h2>   我的笔记 <h2>
         <?php
               $notes = getUserNotes($uid,$oid);
               
               if(count($notes)== 0){
                  
                  echo "<h3> 您暂无笔记 </h3>";

               }else{
                   foreach($notes as $note){
                       
                 ?>
                      <div  class = "mynote">
                      <h3> 标题     </h3> 
                       <p> <?= $note['title']?> </p>
                      <h3> 创建时间 </h3>  
                       <p> <?=$note['since']?>  </p>
                      <h3> 具体描述 </h3>  
                      <p> <?=$note['description']?> </p>
		               </div>
                 <?php

                   }
               }
              
         ?>

         
         <h2>  添加您的笔记 </h2>
         <form action = <?="connection/notes_controler.php?flag=create&oid=".$_REQUEST['oid']?> method="POST">
      
            name<input type="text" name="title"/></br>
			      description </br>
            <textarea name="description" rows = "3" cols = "100"/>
            </textarea>
            </br>
            Public<input type = "checkbox" name = "isPublic" value = "checked">  </br>
			 <input type="submit"/> 
		  </form>
	</body>
</html>

<?php


function getUserNotes($uid,$oid){ 
   
   $query = "select * from Notes where uid=$uid and oid=$oid";
    
   return Database::selectFromDatabase($uid,$oid);

}


?>