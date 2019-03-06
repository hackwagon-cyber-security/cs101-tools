<?php
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log(`" . $output . "`);</script>";
    }
    if (isset($_SESSION) && $_SESSION != NULL) {
        var_dump($_SESSION);
    }
?>