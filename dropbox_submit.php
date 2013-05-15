<?php
if ($_POST) {
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("dropbox_class.php");
$customer_key = "customer_key";
$customer_secret = "customer_secret";
$oauth_token = "oauth_token";
$oauth_access_token_secret = "oauth_access_token_secret";
$method = "PLAINTEXT";
$url = "https://api.dropbox.com/1/oauth/access_token";
$filename = $_FILES['upload']['name'];
$filepath = $_FILES['upload']['tmp_name'];
$filesize = $_FILES['upload']['size'];
$path = "/$filename";
$url = "https://api-content.dropbox.com/1/files_put/sandbox/$path?overwrite=false";
$fp = fopen($filepath, 'r');
    if (!$fp) {
        die('could not open temp memory data');
    }
fwrite($fp, $body);
fseek($fp, 0);
$dropbox = new authentication();
$dropbox->getConsumberKey($customer_key);
$dropbox->getConsumberSecret($customer_secret);
$dropbox->getAuthMethod($method);
$dropbox->getAuthToken($oauth_token);
$dropbox->getAuthTokenSecret($oauth_access_token_secret);
$dropbox->buildSignature();
$dropbox->autharray();
//$url = $dropbox->getUrl($url);
$result = $dropbox->upload($url,$fp,$filesize);
$resultarray = json_decode($result);

if (isset($resultarray->modified))
print("<div style=\"margin:50px\">We receive your file. Thanks</div>");
else
print("<div cstyle=\"margin:50px\">An error happened while you were uploading the file. Please contect xxxx</div>");

}
else {
?>

<div class="box">

<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="upload" />
<input type="submit" name="submit" value="Upload" />
</form>
</div>

<?php } ?>

	