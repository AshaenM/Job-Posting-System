<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development - Assignment 1" />
    <meta name="keywords" content="Html,CSS,PHP" />
    <meta name="author" content="Ashaen Manuel" />
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Post a Job Vacancy</title>
</head>

<body>
    <main id="main-searchjobform-div">
        <h2 id = "post-a-job-vacancy-heading">Post a Job Vacancy</h2>
        <form action="postjobprocess.php" method="post">
            <fieldset>
                <legend><b>Job Vacancy Data:</b></legend>
                <table id="post-job-table">
                    <tr>
                        <td><label>Position ID: </label></td>
                        <td><input type="text" name="positionID"></td>
                    </tr>
                    <tr>
                        <td><label>Title: </label></td>
                        <td><input type="text" name="title"></td>
                    </tr>
                    <tr>
                        <td><label>Description: </label></td>
                        <td><textarea name="description"></textarea></td>
                    </tr>
                    <tr>
                        <td><label>Closing Date: </label></td>
                        <td><input type="text" name="date" value="<?php echo date('d/m/y'); ?>"></td> <!-- Sets todays date as the default value-->
                    </tr>
                    <tr>
                        <td><label>Position: </label></td>
                        <td>
                            <label>Part Time</label>
                            <input type = "radio" name = "job-position" value="Part Time">
                            <br>
                            <label>Full Time</label>
                            <input type = "radio" name = "job-position" value="Full Time">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Contract: </label></td>
                        <td>
                            <label>On-going</label>
                            <input type = "radio" name = "job-contract" value="On-going">
                            <br>
                            <label>Fixed Term</label>
                            <input type = "radio" name = "job-contract" value="Fixed Term">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Location: </label></td>
                        <td>
                            <label>On Site</label>
                            <input type = "radio" name = "job-location" value="On Site">
                            <br>
                            <label>Remote</label>
                            <input type = "radio" name = "job-location" value="Remote">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Accept Application by: </label></td>
                        <td>
                            <label>Post</label>
                            <input type = "checkbox" name = "application-by-post" value="Post">
                            <br>
                            <label>Email</label>
                            <input type = "checkbox" name = "application-by-email" value="Email">
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" id="post-job-submit-button"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <div id="return-home-button">
            <a href="index.php">Return home</a>
        </div>
    </main>
</body>

</html>