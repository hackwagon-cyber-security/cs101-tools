<?php 
    if (isset($_GET['file_name'])) {
        $command  = "cat " . $_GET['file_name'];
        exec($command, $output);
        foreach($output as $value){
            echo $value;
        }
    } else {
        echo "Please input the correct file name in the file_name parameter!";
    }
?>
