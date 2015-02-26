<?php
	if($_POST['formSubmit'] == "Submit") 
    {
		$errorMessage = "";

              $varfname = $_POST['fname'];
		$varsname = $_POST['sname'];
		$varemail = $_POST['email'];
		$vartel = $_POST['tel'];
		$vargender = $_POST['gender'];
		$vardate = $_POST['date'];
		$varcomment = $_POST['comment'];
		
		if(empty($_POST['fname']) ||!preg_match("/^[a-zA-Z ]*$/",$varfname)) 
        {
			$errorMessage .= "<li>Error in Name</li>";
		}
		if(empty($_POST['sname']) ||!preg_match("/^[a-zA-Z ]*$/",$varsname)) 
        {
			$errorMessage .= "<li>Error in Surename</li>";
		}
		if(empty($_POST['email']) ||!filter_var($varemail, FILTER_VALIDATE_EMAIL)) 
        {
			$errorMessage .= "<li>Email Not Valid!</li>";
		}
              $regex = '/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/';
		if(empty($_POST['tel'])||!preg_match($regex, $vartel)) 
        {
			$errorMessage .= "<li>Enter Telephone Number!</li>";
		}
		if(empty($_POST['gender'])) 
        {
			$errorMessage .= "<li>Gender not Entered!</li>";
		}
		$regexy = '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/';
		if(empty($_POST['date'])||!preg_match($regexy,$vardate)) 
        {
			$errorMessage .= "<li>Date Not Valid!</li>";
		}
		if(empty($_POST['comment'])) 
        {
			$errorMessage .= "<li>Comment Not entered!</li>";
		}
		if(empty($errorMessage)) 
        {
require 'configf.php';
$sql="INSERT INTO form (fname,sname,email,tel,gender,date,comment) 
VALUES(".
							PrepSQL($varfname) . ", " .
							PrepSQL($varsname) . ", " .
							PrepSQL($varemail) . ", " .
							PrepSQL($vartel) . ", " .
							PrepSQL($vargender) . ", " .
							PrepSQL($vardate) . ", " .
							PrepSQL($varcomment) . ")";
			mysql_query($sql);
			
			header("Location: thankyou.html");
			exit();
		}
	}
            
    function PrepSQL($value)
    {
        // Stripslashes
        if(get_magic_quotes_gpc()) 
        {
            $value = stripslashes($value);
        }

        $value = "'" . mysql_real_escape_string($value) . "'";

        return($value);
    }
?>
<!DOCTYPE HTML> 
<html>
<head>
	
<script type ="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script > 
jQuery(document).ready(function ($) {
    $('#next').click(function () {
        $('#nam').slideUp();
        $('#det').slideDown();
        $('#det').show();
        return false;
    });
        $('#next1').click(function () {
        $('#det').slideUp();
        $('#mes').slideDown();
        $('#mes').show();
        return false;
    });
});
</script>

<style>
    
label,a 
{
	font-family : Arial, Helvetica, sans-serif;
	font-size : 14px; 
}
    
 #content{
        width: 500px;
    }

#title {
	background-color: #f1af09; 
    border-radius: 5px;
	width: 495px;
    color: white;
    text-align: left;
    margin-top: 2px;
    height: 30px;
    line-height: 30px;
    padding-left: 5px;

}

#nam, #det, #mes { 
    margin-top: -14px;
    background-color: #dedede;
    width: 500px;
    border-radius: 5px;
    padding-bottom: 30px;
}
    
#next, #next1, #formsubmit {
    border-radius: 4px;
    background-color: #5c57ac;
    float:right;
    margin-right: 20px;
    color: white;  
}

p {
    margin-left: 8px;
}

p1 {
    float: right;
    margin-top: -53px;
    margin-right: 120px;
}
    
    
#form {
        width:500px;
        border-radius: 5px;
        box-shadow:2px 2px 10px 10px #C9C9C9;
        -webkit-box-shadow:2px 2px 10px 10x #C9C9C9;
        -moz-box-shadow:2px 2px 10px 10px #C9C9C9;
}
    
input, textarea {
    border: 1px solid #ccc;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
    box-shadow: inset 0px 0px 5px rgba(0,0,0,0.9);
	font-size: 14px;
	outline: 2px;
	-webkit-appearance: none;
}

select {
    background-color: #f1f1f1;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    box-shadow: inset 0px 0px 5px rgba(0,0,0,0.9);
}
    
body {
background-color:#d2e1ff;
}
    
</style>
</head>

<body>

       <?php
		    if(!empty($errorMessage)) 
		    {
			    echo("<p>There was an error with your form:</p>\n");
			    echo("<ul>" . $errorMessage . "</ul>\n");
            }
        ?>
    <div id ="form">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
			
<section id="title">Step 1: Details</section>
			<div id="nam">

			<p>
				<label for='fname'>First Name</label><br/>
				<input type="text" name="fname" maxlength="50"/>
			</p>
			<p1>
				<label for='sname'>Surename</label><br/>
				<input type="text" name="sname" maxlength="50" />
			</p1>
			<p>
				<label for='email'>Email Address: </label><br/>
				<input type="text" name="email" maxlength="80" />
			</p>
			<button id="next" type="submit">Next</button>
 			</div>
<section id="title">Step 2: More comments</section>
			<div id="det" style="display:none;">
			<p>
			<p>
				<label for='tel'>Telephone Number: </label><br/>
				<input type="text" name="tel" maxlength="80" />
			</p>
                <p1>
				<label for='gender'>Gender:</label><br/>
				<select name="gender">
					<option value="" selected>Select Gender</option>
					<option value="Male" >Male</option> 
    					<option value="Female">Female</option> 
				</select>
                </p1>
			</p>
			<p>
				<label for='date' >Date of Birth: </label><br/>
				<input type="text" name="date" />
			</p>
			<button id="next1" type="submit">Next</button>
                     </div>
<section id="title">Step 3: Final comments</section>
			<div id="mes" style="display:none;">
			<p>
				<label for='comment'>Comments: </label><br/>
				<textarea name="comment" rows="5" cols="40" ></textarea>
			</p>
				<input type="submit" name="formSubmit" value="Submit" id="formsubmit"/>
                     </div>
		</form>
    </div>
</body>
</html>