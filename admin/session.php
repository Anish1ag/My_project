<?php
            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
?>
<?php
            if(isset($_SESSION['query'])){
                echo $_SESSION['query'];
                unset($_SESSION['query']);
            }
?>