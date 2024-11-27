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
    <main id="main-postjobprocess-div">
        <?php
        $errors = []; //Creates an array
        
        $positionID = '';
        if (isset($_POST["positionID"])) { //Checks if a form field named "positionID" was submitted
            $positionID = $_POST["positionID"]; //If it does, assign its value to the variable
        }

        $title = '';
        if (isset($_POST["title"])) { //Checks if a form field named "title" was submitted
            $title = $_POST["title"];//If it does, assign its value to the variable
        }

        $description = '';
        if (isset($_POST["description"])) { //Checks if a form field named "description" was submitted
            $description = $_POST["description"];//If it does, assign its value to the variable
        }

        $date = '';
        if (isset($_POST["date"])) {//Checks if a form field named "date" was submitted
            $date = $_POST["date"];//If it does, assign its value to the variable
        }

        $job_position = '';
        if (isset($_POST["job-position"])) {//Checks if a form field named "job-position" was submitted
            $job_position = $_POST["job-position"];//If it does, assign its value to the variable
        }

        $job_contract = '';
        if (isset($_POST["job-contract"])) {//Checks if a form field named "job-contract" was submitted
            $job_contract = $_POST["job-contract"]; //If it does, assign its value to the variable
        }

        $job_location = '';
        if (isset($_POST["job-location"])) {//Checks if a form field named "job-location" was submitted
            $job_location = $_POST["job-location"];//If it does, assign its value to the variable
        }

        $application_by_post = '';
        if (isset($_POST["application-by-post"])) {//Checks if a form field named "application-by-post" was submitted
            $application_by_post = $_POST["application-by-post"];//If it does, assign its value to the variable
        }

        $application_by_email = '';
        if (isset($_POST["application-by-email"])) {//Checks if a form field named "application-by-email" was submitted
            $application_by_email = $_POST["application-by-email"];//If it does, assign its value to the variable
        }

        $dir = "../../data";
        $filename = "$dir/positions.txt"; //Assign a variable the path to a text file where all jobs data will be stored
        
        if (empty($positionID)) { //Checks if the variable has no data sent
            $errors[] = "Job Position ID can not be empty."; //If so, add the string to the array
        } elseif (!preg_match("/^ID\d{3}$/", $positionID)) { // Checks if it has data but it doesnt match the required format
            $errors[] = "Job Position ID must start with 'ID' and end with 3 digits."; // Adds this string to the array
        } else {
            if (is_readable($filename)) { //Checks if the file is readable
                $file_content = file_get_contents($filename); //Gets the values in the file
                if (strpos($file_content, $positionID) !== false) { //Checks if the exact string is in the file
                    $errors[] = "Job Position ID must be unique."; //If so, add this string to the array
                }
            }
        } //Basically it checks if the Job ID is unique
        if (empty($title)) { //Checks if the variable has no data sent
            $errors[] = "Job Title can not be empty."; //If so, add the string to the array
        } elseif (!preg_match("/^[a-z A-Z 0-9 ,.!]{1,10}$/", $title)) { //Checks if it has data but it doesnt match the required format
            $errors[] = "Title must be 1 to 10 characters long and can only contain letters, digits, spaces, commas, periods, and exclamation marks."; // Adds this string to the array
        }
        if (empty($description)) { //Checks if the variable has no data sent
            $errors[] = "Job Description can not be empty."; // Add the string to the array
        } elseif (strlen($description) > 250) { //Checks if the variable has data but the length is more than 250 characters
            $errors[] = "Job description must be between 1 to 250 characters long."; //If so, add this string to the array
        }
        if (empty($date)) { //Checks if the variable has no data sent
            $errors[] = "Job Closing Date can not be empty"; // Add the string to the array
        } elseif (!preg_match("/^\d{1,2}\/\d{1,2}\/\d{2}$/", $date)) { // Checks if it has data but it doesnt match the required format 
            $errors[] = "Date must match the format dd/mm/yy"; //Add the string to the array
        } else {
            list($day, $month, $year) = explode('/', $date); //Breaks down the variable into 3 separate variables
            if ($day > 31 or $month > 12) { //Checks if the date is valid
                $errors[] = "Date must match the format dd/mm/yy"; // If not, add the string to the array
            }
        }
        if (empty($job_position)) { //Checks if the variable is empty
            $errors[] = "Job Position can not be empty."; //Add the string to the array
        }
        if (empty($job_contract)) { //Checks if the variable is empty
            $errors[] = "Job Contract can not be empty"; //Add the string to the array
        }
        if (empty($job_location)) { //Checks if the variable is empty
            $errors[] = "Job Location can not be empty.";//Add the string to the array
        }
        if (empty($application_by_post) && empty($application_by_email)) { //Checks if both variables are empty
            $errors[] = "Please select at least one method of accepting applications (Post or Email)."; //Add the string to the array
        }

        if ($errors) { // Checks if there are any values in the array
            echo "<h2 id='errors-heading'>The following errors were found</h2>";
            echo "<ul id = 'postjobprocess-errors-list'>";
            foreach ($errors as $error) {
                echo "<li>$error</li>"; //Output each string in the array as an unsorted list
            }
            echo "</ul>";
            echo "<div id='return-home-button'><a href='index.php'>Return home</a></div>";
            echo "<div id='return-post-a-job-vacancy-button'><a href='postjobform.php'>Post a Job Vacancy</a></div>";
        } else {// If there is no data in the array (All data is valid and ready to be stored in the text file)
            umask(0007); //Sets the default file permission
        
            if (!is_dir($dir)) { // Checks if the directory doesnt exist
                mkdir($dir, 02770); //If it doesnt, create the directory with the permissions
            }

            $handle = fopen($filename, "a"); //Opens the file in Write only mode (Creates the file if it doesnt exist)
            $data = "$positionID\t$title\t$description\t$date\t$job_position\t$job_contract\t$job_location\t$application_by_post\t$application_by_email\n";
            fwrite($handle, $data); //Writes the above string to the file
            fclose($handle); //Close the file
            echo "<h2 id='successful-form-submission-heading'> The Job Vacancy has successfully been posted! </h2>";
            echo "<div id='return-home-button-centerred'><a href='index.php'>Return home</a></div>";
        }
        ?>
    </main>
</body>

</html>