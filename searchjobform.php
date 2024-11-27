<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development - Assignment 1" />
    <meta name="keywords" content="Html,CSS,PHP" />
    <meta name="author" content="Ashaen Manuel" />
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Search a Job Vacancy</title>
</head>

<body>
    <main id="main-searchjobform-div">
        <h2>Job Vacancy Posting System</h2>
        <form action="searchjobprocess.php" method="get">
            <fieldset>
                <legend>Find a Job:</legend>
                <table>
                <tr>
                    <td><label>Job Title</label></td>
                    <td><input type="text" name="job_title_find"></td>
                </tr>
                <tr>
                    <td><label>Position</label></td>
                    <td>
                        <select name="position_find">
                            <option label="None"></option>
                            <option value="part time">Part Time</option>
                            <option value="full time">Full Time</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Contract</label></td>
                    <td>
                        <select name="contract_find">
                            <option label="None"></option>
                            <option value="on-going">On-going</option>
                            <option value="fixed term">Fixed Term</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Application Type</label></td>
                    <td>
                        <select name="application_type_find">
                            <option label="None"></option>
                            <option value="post">Post</option>
                            <option value="email">Email</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Location</label></td>
                    <td>
                        <select name="location_find">
                            <option label="None"></option>
                            <option value="on site">On Site</option>
                            <option value="remote">Remote</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="Submit" value="Search" id="search-job-submit-button"></td>
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