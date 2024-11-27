<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development - Assignment 1" />
    <meta name="keywords" content="Html,CSS,PHP" />
    <meta name="author" content="Ashaen Manuel" />
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>About this Assignment</title>
</head>

<body>
    <main id="main-about-this-assignment-div">
        <h2>About this Assignment</h2>
        <hr>
        <br>
        <h3>What is the PHP version installed in Mercury?</h3>
        <?php
        echo "<p>PHP version: " . phpversion() . "</p>"; //gets the PHP version of the server
        ?>
        <h3>What tasks you have not attempted or not completed?</h3>
        <p>I have completed all tasks in this assignment.</p>
        <h3>What special features have you done, or attempted, in creating the site that we should know about?</h3>
        <p>Apart from all the required features, I've also implemented CSS styling in a way that automatically becomes responsive for different sized screens.
            When you right click a page, go to inspect and try resizing the screen, you will see that the output automatically adjusts well upto certain extents.
        </p>
        <h3>What discussion points did you particpate on, in the unit's discussion board for Assignment 1?</h3>
        <p>I particpated in 2 discussion board questions.</p>
        <img src="style/discussion_answer_1.png" alt="First screenshot of my reply" class="my_discussion_board_replies">
        <br>
        <img src="style/discussion_answer_2.png" alt="Second screenshot of my reply"
            class="my_discussion_board_replies">
        <hr>
        <div id="return-home-button">
            <a href="index.php">Return home</a>
        </div>
    </main>
</body>

</html>