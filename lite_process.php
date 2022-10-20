<?
// URL: www.freecontactform.com
// Version: FreeContactForm Lite V1.0
// Copyright (c) 2009 Stuart Cochrane <stuartc1@gmail.com>
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.
if(isset($_POST['email_address'])) {
	
	include 'lite_settings.php';
	
	if($email_to == "you@yourdomain.com") {
		die("This message is for the Webmaster. Please enter your email address into the file 'lite_settings.php'");
	}
	
	function died($error) {
		echo "Sorry, but there were error(s) found with the form your submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}
	
	if(	!isset($_POST['userName']) ||
		!isset($_POST['email_address']) ||
		!isset($_POST['mobile']) ||
		!isset($_POST['message'])) {
		died('We are sorry, but there appears to be a problem with the form your submitted.');		
	}

	//variable declaration required
	
	$userName = $_POST['userName']; // required
	$email_address = $_POST['email_address']; // required
	$mobile = $_POST['mobile']; // required
	$message = $_POST['message']; // not required
	
		
	$error_message = "";
	$email_from ="";
	$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
    $count="";
  if(!preg_replace($email_exp,$email_from,$count)) {
  	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
  /*
  if(strlen($First_Name) < 2) {
  	$error_message .= 'Your Name does not appear to be valid.<br />';
  }
  if(strlen($Special_Needs) < 2) {
  	$error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  
  if(strlen($error_message) > 0) {
  	died($error_message);
  }*/
	$email_message = "Form details below.\r\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	$email_message="";
	$email_message .= "Name : ".clean_string($userName)."\r\n";
	$email_message .= "Email Address : ".clean_string($email_address)."\r\n";
	$email_message .= "Phone : ".clean_string($mobile)."\r\n";
    $email_message .= "Interested  : ".clean_string($message)."\r\n";
	//services
	if (isset($_POST["Services"]) && is_array($_POST["Services"])
    && count($_POST["Services"]) > 0)
    {
	    foreach($_POST['Services']  as  $checkFeatures)  {
	    	$email_message .= "Features: $checkFeatures\n";
	    }
    } // END services
$email_from =$email_address;	
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion(). "\r\n";
mail($email_to, $email_subject.$userName, $email_message);
header("Location: $thankyou");
?>
<script>location.replace('<? echo $thankyou;?>')</script>
<?
}
?>
