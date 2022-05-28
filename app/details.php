<?php 

   include('config/db_connect.php');

   //to delete
   if(isset($_POST['delete'])){

      $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

      //make sql
      $sql = "DELETE FROM posts WHERE id = $id_to_delete";

      if(mysqli_query($conn, $sql)){
         //success
         header('Location: index.php');
      } else{
         //error
         echo 'querey error : ' . mysqli_error($conn);
      }

      //free mem and close conx
      mysqli_free_result($result);
      mysqli_close($conn);
   }

   //check GET request id parameter
   if(isset($_GET['id'])){
      $id = mysqli_real_escape_string($conn, $_GET['id']);

      //make sql
      $sql = "SELECT * FROM posts WHERE id = $id";

      //get the query result
      $result = mysqli_query($conn, $sql);
      
      //fetch result in an array format
      $post = mysqli_fetch_assoc($result);

      //free mem and close conx
      mysqli_free_result($result);
      mysqli_close($conn);

   }


?>




<!DOCTYPE html>
 <html lang="en">
    <?php include('templates/header.php'); ?>

    <div class="container center">
         <?php if($post): ?>
            <h4> <?php echo htmlspecialchars($post['title']); ?> </h4>
            <p> Created by <?php echo htmlspecialchars($post['email']); ?> </p>
            <h6>Tags :</h6>
            <ul>
                <?php foreach(explode(',', $post['tags']) as $tag) : ?>
                <li> <?php echo htmlspecialchars('#'.$tag); ?> </li>
                 <?php endforeach ?>
            </ul>
            <!-- <p> <?php //echo htmlspecialchars($post['tags']); ?> </p> -->
            <h6>Post :</h6>
            <p> <?php echo htmlspecialchars($post['post']); ?> </p>
            <p> <?php echo date($post['created_at']); ?> </p>

            <!-- delete form -->
            <form action="details.php" method="POST">
               <input type="hidden" name="id_to_delete" value="<?php echo $post['id']; ?>">
               <input type="submit" name="delete" value="delete" class="btn brand z-depth-0">
            </form>

         <?php else: ?>
            <h5>Error, No such a post exists !!!</h5>
         <?php endif ?>
    </div>
    <?php include('templates/footer.php');?>
 </html>