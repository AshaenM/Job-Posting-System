<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development - Assignment 1" />
    <meta name="keywords" content="Html,CSS,PHP" />
    <meta name="author" content="Ashaen Manuel" />
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Find a Job Vacancy</title>
</head>

<body>
    <main id="main-searchjobprocess-div">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $filename = "../../data/positions.txt"; //Get the path to the text file

            $jobTitleRequest = $_GET['job_title_find']; //Get the form data field "job_title_find" 
            $positionRequest = $_GET['position_find']; //Get the form data field "position_find" 
            $contractRequest = $_GET['contract_find']; //Get the form data field "contract_find" 
            $applicationTypeRequest = $_GET['application_type_find'];//Get the form data field "application_type_find" 
            $locationRequest = $_GET['location_find'];//Get the form data field "location_find" 

            $criteriaRequested = []; //Create an empty array

            if (!empty($jobTitleRequest)) {
                $criteriaRequested[] = $jobTitleRequest; //If the form data field isnt empty, add the value to the array
            }
            if (!empty($positionRequest)) {
                $criteriaRequested[] = $positionRequest; //If the form data field isnt empty, add the value to the array
            }
            if (!empty($contractRequest)) {
                $criteriaRequested[] = $contractRequest; //If the form data field isnt empty, add the value to the array
            }
            if (!empty($applicationTypeRequest)) {
                $criteriaRequested[] = $applicationTypeRequest; //If the form data field isnt empty, add the value to the array
            }
            if (!empty($locationRequest)) {
                $criteriaRequested[] = $locationRequest; //If the form data field isnt empty, add the value to the array
            }

            if (is_readable($filename)) { // Checks if the file is readable
                $jobs = []; //Create another empty array to store all the jobs
                echo "<h2 id='available-jobs-heading'>Available Jobs</h2>";
                $handle = fopen($filename, "r"); //Open the file in read only mode
                $jobFound = false;
                while (!feof($handle)) { //While reading until the end of the file
                    $onedata = fgets($handle); //Get the first line
                    if ($onedata != "") { // Checks if the line is empty
                        $data = explode("\t", $onedata);  //Separate the line by tab spaces into an array
                        array_shift($data); //Remove the first element in the array (Job ID)
                        $data = array_map('trim', $data); //Removes whitespaces
                        $data = array_filter($data); //Removes any empty values in the array
                        $data = array_values($data); //Re-indexes the array

                        $jobTitle = $data[0]; //Assigns the first element in the array to the variable
                        $jobDescription = $data[1]; //Assigns the second element in the array to the variable
                        $closingDate = $data[2]; //Assigns the third element in the array to the variable
                        $position = $data[3]; //Assigns the fourth element in the array to the variable
                        $contract = $data[4]; //Assigns the fifth element in the array to the variable
                        $location = $data[5]; //Assigns the sixth element in the array to the variable

                        if (count($data) == 7) { //Checks if there are 7 elements in the array (This is to see if Application by type has just "post"/"email" or both submitted)
                            $applicationType = $data[6]; //Assigns the seventh element in the array to the variable
                        }
                        if (count($data) == 8) { //Checks if there are 8 elements in the array
                            $applicationType = "$data[6] and $data[7]"; //Add both seventh and eigth elements to the array
                        }

                        $searchString = "$jobTitle $position $contract $location $applicationType"; //Create a string containing some of the values for filtering purposes

                        if (!empty($criteriaRequested)) { // If the user wants any filtering for the results
                            $allCriteriaFound = true;
                            foreach ($criteriaRequested as $criteria) { //Iterate through each criteria requested
                                if (stripos($searchString, $criteria) === false) { //If the filter is in the search string
                                    $allCriteriaFound = false;
                                    break;
                                }
                            }
                            if ($allCriteriaFound) { //Checks if the criteria has been found
                                $jobFound = true;
                                $jobs[] = [ //Create a 2D sub-array with keys denoting the name of each value
                                    'title' => $jobTitle,
                                    'description' => $jobDescription,
                                    'closingDate' => $closingDate,
                                    'position' => $position,
                                    'contract' => $contract,
                                    'location' => $location,
                                    'applicationType' => $applicationType
                                ];
                            }
                        } else { // If no filters required (User wants to see all results)
                            $jobFound = true;
                            $jobs[] = [ //Create a 2D sub-array with keys denoting the name of each value
                                'title' => $jobTitle,
                                'description' => $jobDescription,
                                'closingDate' => $closingDate,
                                'position' => $position,
                                'contract' => $contract,
                                'location' => $location,
                                'applicationType' => $applicationType
                            ];
                        }

                    }
                }

                fclose($handle); //Close the text file
                $todayDate = strtotime(date('Y-m-d')); //Get todays date as a timestamp
                $filteredJobs = []; //Create an array to store filtered jobs
                foreach ($jobs as $job){ //Loop through each job
                    $jobClosingDate = $job['closingDate']; //Get the closing date of the job
                    $jobClosingDate = DateTime::createFromFormat('d/m/y', $jobClosingDate); //Change the format of it using the DateTime class
                    $jobClosingDate = $jobClosingDate->getTimestamp(); //Get the timestamp of it
                    if ($jobClosingDate >= $todayDate){ //Check if the closing date is after todays date
                        $filteredJobs[] = $job; //If so, add the job to the array
                    }
                } //Jobs that have due dates passed the current date will not be stored in the filteredJobs array

                usort($filteredJobs, function($jobA, $jobB) { //Sort the array based on each job sub-array
                    $dateA = $jobA['closingDate']; //Get the closing date of job A
                    $dateA = DateTime::createFromFormat('d/m/y', $dateA); //Change the format of it using the DateTime class
                    $dateA = $dateA->getTimestamp();//Get the timestamp of it

                    $dateB = $jobB['closingDate']; //Get the closing date of job B
                    $dateB = DateTime::createFromFormat('d/m/y', $dateB); //Change the format of it using the DateTime class
                    $dateB = $dateB->getTimestamp();//Get the timestamp of it

                    return $dateB - $dateA; //return the job with the more future closing date
                });

                if ($jobFound){ // If jobs are found based on the criteria
                    echo "<ol>";
                    foreach ($filteredJobs as $job) { //For each job, output the fields in an un-ordered list with the title being in an ordered list
                        echo "<li><b>{$job['title']}</b></li><br>";
                        echo "<ul>";
                        echo "<li><b>Description:</b> {$job['description']}</li>";
                        echo "<li><b>Closing Date:</b> {$job['closingDate']}</li>";
                        echo "<li><b>Position:</b> {$job['position']}</li>";
                        echo "<li><b>Contract:</b> {$job['contract']}</li>";
                        echo "<li><b>Location:</b> {$job['location']}</li>";
                        echo "<li><b>Accepts Application by:</b> {$job['applicationType']}</li>";
                        echo "</ul><br>";
                    }
                    echo "</ol>";
                }

                else{ //If no jobs are found based on the user's criteria
                    echo "<p>No jobs found, try changing the title and/or filters</p>";
                }
            }
            else { //If file cannot be opened
                echo "<p>Cannot open file right now, please try again later.</p>";
            }
        }
        echo "<hr>";
        echo "<div id='return-home-button'><a href='index.php'>Return home</a></div><br>";
        echo "<div id='return-search-a-job-vacancy-button'><a href='searchjobform.php'>Search for a Job Vacancy</a></div>";
        ?>
    </main>
</body>

</html>