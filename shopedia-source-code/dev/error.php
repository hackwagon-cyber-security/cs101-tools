<?php 
    if (isset($_GET['msg'])) {
        echo base64_decode($_GET['msg']);
    }
?>