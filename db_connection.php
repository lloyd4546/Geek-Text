<?php
    function openCon() {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "geek_text";

        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    
        return $conn;
    }

    function CloseCon($conn) {
        $conn -> close();
    }
?>