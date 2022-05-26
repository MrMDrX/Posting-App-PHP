 <?php
    include('config/db_connect.php');

    //write querey for all todos
    $sql = 'SELECT id, title, tags FROM posts ORDER BY created_at';

    //make query & get result
    $result = mysqli_query($conn, $sql);

    //fetch the resulting rows as an array
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

    // printing the result
    // print_r($posts);
    // print_r(explode(',', $posts[1]['tags']));
?>

 <!DOCTYPE html>
 <html lang="en">
    <?php include('templates/header.php'); ?>

    <h3 class="center grey-text"> Posts </h3>

        <div class="container">
            <div class="row">
                
            <?php foreach($posts as $post) : ?>

                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <!-- add image to each todo -->
                        
                        <div class="card-content center">
                            <h5><?php echo htmlspecialchars($post['title']); ?></h5>
                            <p>
                                <?php foreach(explode(',', $post['tags']) as $tag) : ?>
                                <?php echo htmlspecialchars('#'.$tag); ?>
                                <?php endforeach ?>
                            </p>
                        </div>

                        <div class="card-action right-align">
                            <a class="brand-text" href="details.php?id=<?php echo $post['id'] ?>">more info</a>
                        </div>
                    </div> 
                </div>

                <?php endforeach ?>

                <!-- <?php  ?> -->
                <!-- <?php  ?> -->

            </div>
        </div>

    <?php include('templates/footer.php');?>
 </html>
