<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <title>FormProcessor Demo</title>
  <style type="text/css">
body {
  font-family: georgia;
  margin: 2em;    
}
div label {
  display: block;
  font-size: 0.8em;
}
div {
  margin-bottom: 0.5em;    
}
input.invalid {
  background-color: pink;
}
strong.error {
  color: red;
}
  </style>
</head>
<body>
<h1>FormProcessor Demo</h1>
<?php

include('FormProcessor.class.php');

$form = <<<EOD
<form action="test.php" method="post">
<errorlist>
<ul>
<erroritem> <li><message /></li>
</erroritem></ul>
</errorlist>
<div>
 <label for="name">Name: </label>
 <input type="text" name="name" id="name" compulsory="yes" validate="alpha" callback="uniqueName" size="20" /><error for="name"> <strong class="error">!</strong></error>
</div>
<errormsg field="name" test="compulsory">You did not enter your name</errormsg>
<errormsg field="name" test="alpha">Your name must consist <em>only</em> of letters</errormsg>
<div>
 <label for="email">Email: </label>
 <input type="text" name="email" id="email" compulsory="yes" validate="email" size="20" /><error for="email"> <strong class="error">!</strong></error>
</div>
<errormsg field="email" test="compulsory">You must provide an email address</errormsg>
<errormsg field="email" test="validate">Your email address is invalid</errormsg>
<div>
 <label for="pass1">Password: </label>
 <input type="password" name="pass1" id="pass1" compulsory="yes" validate="alphanumeric" size="10" /><error for="pass1"> <strong class="error">!</strong></error>
</div>
<errormsg field="pass1" test="compulsory">You did not provide a password</errormsg>
<errormsg field="pass1" test="validate">Your password must contain only letters and numbers</errormsg>
<div>
 <label for="pass2">Repeat password: </label>
 <input type="password" name="pass2" id="pass2" validate="alphanumeric" mustmatch="pass1" size="10" /><error for="pass2"> <strong class="error">!</strong></error>
</div>
<errormsg field="pass2" test="mustmatch">The two passwords did not match</errormsg>
<div>
 <label for="dob">DOB [dd/mm/yyyy]: </label>
 <input type="text" name="dob" id="dob" compulsory="yes" regexp="|^\\d\{2}/\\d\{2}/\\d\{4}$|" size="10" /><error for="dob"> <strong class="error">!</strong></error>
</div>
<errormsg field="dob" test="regexp">Your DOB must be in the form dd/mm/yyyy</errormsg>
<errormsg field="dob" test="compulsory">You must provide a date of birth</errormsg>
<div><input type="submit" value="Create Account" /></div>
</form>
EOD;

function uniqueName($name) {
    return true;
}

$processor =& new FormProcessor($form);
if ($processor->validate()) {
    echo '<p>Form data is OK.</p><pre>';
    print_r($_POST);
    echo '</pre>';
} else {
    $processor->display();
}

?>

<p>The above form was generated from the following FormML:</p>

<pre><code class="xml">
<?php print htmlentities(wordwrap($form, 80)); ?>
</code></pre>

</body>
</html>