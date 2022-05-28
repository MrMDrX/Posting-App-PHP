<?php

    include('config/db_connect.php');

    $title = $email = $tags = $post ='';
    $errors = array(
        'title' => '',
        'tags' => '',
        'post' => '',
        'email' => ''
    );
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $email = $_POST['email'];
        $tags = $_POST['tags'];
        $post = $_POST['post'];

        //check title
        if(empty($_POST['title'])){
            $errors['title'] = 'A title is required <br>';
        } else {
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $errors['title'] = 'Title must be letters and spaces only ! <br>';
            }
        }
        //check email
        if(empty($_POST['email']))
            $errors['email'] = 'an email is required <br>';
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Please enter a valid Email <br>';
            }
        }
        //check tags
        if(empty($_POST['tags'])){
            $errors['tags'] = 'At least one tag is required <br>';
        } else {
            if(!preg_match('/^([a-zA-Z\s]+)(,s*[a-zA-Z\s]*)*$/', $tags)){
            $errors['tags'] = 'Tags must be a comma separated list ! <br>';
            }
        }
        //check description
        if(empty($_POST['post']))
            $errors['post'] = 'A post body is required <br>';
        //check if form is valid or not
        if(array_filter($errors)){
            //echo 'there are errors in the form';
        } else{
            //saving data to database

            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $tags = mysqli_real_escape_string($conn, $_POST['tags']);
            $post = mysqli_real_escape_string($conn, $_POST['post']);

            //create sql
            $sql = "INSERT INTO posts(title,email,tags,post) VALUES('$title', '$email', '$tags', '$post')";

            //save to db and check
            if(mysqli_query($conn, $sql)){
                //success
                header('Location: index.php');
            }else{
                //error
                echo 'query error : ' . mysqli_errno($conn);
            }
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <?php
        include('templates/header.php');
    ?>

    <section class="container grey-text">
        <h4 class="center">Create a Post</h4>
        <form action="add.php" method="POST">

            <label for="title">Post Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"> <?php echo $errors['title']; ?> </div>

            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"> <?php echo $errors['email']; ?> </div>

            <label for="tags">Tags (comma separated)</label>
            <input type="text" name="tags" value="<?php echo htmlspecialchars($tags) ?>">
            <div class="red-text"> <?php echo $errors['tags']; ?> </div>

            <label for="post">Post</label>
            <textarea name="post" cols="30" rows="10"><?php echo htmlspecialchars($post) ?></textarea>
            <div class="red-text"> <?php echo $errors['post']; ?> </div>


            <div class="center">
                <input type="submit" name="submit" id="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    
    <?php
        include('templates/footer.php');
    ?>
</html>