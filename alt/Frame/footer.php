<?php
	if(strpos("footer.php",$_SERVER["PHP_SELF"])) {
  		exit;
	}
	
        $ausgabe.='</body>';
        $ausgabe.='</html>';
        echo $ausgabe;
 


?>