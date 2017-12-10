<?php
require_once('DateConverter.php');

$converter = new DateConverter();

if(isset($_POST) && $_POST['start'] != '' && $_POST['end'] != '') {

    $result = json_decode($converter->index(strip_tags($_POST['start']), strip_tags($_POST['end'])));

    echo 'Total days diff:'.$result->total_days.'<br>';
    echo 'Years diff:'.$result->years.'<br>';
    echo 'Months diff:'.$result->month.'<br>';
    echo 'Days diff:'.$result->days.'<br>';
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>TEST Title</title>
    </head>
    <body>
        <header>
            
        </header>
        <section class="main-content">
            <form action="/" method="post">
                <label for="start">Please enter start date</label>
                <input type="text" name="start" placeholder="YYYY-MM-DD" required pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" title="YYYY-MM-DD"/>
                <br><br>
                
                <label for="end">Please enter end date</label>
                <input type="text" name="end" placeholder="YYYY-MM-DD" required pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" title="YYYY-MM-DD"/>
                <br><br>
                
                <button type="submit">Submit</button>
            </form>
        </section>
    </body>
</html>