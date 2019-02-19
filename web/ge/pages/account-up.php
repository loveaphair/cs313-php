
<?php include $path . '/modules/head.php'; ?>
<?php include $path . '/modules/header.php'; ?>
<script>
$(function(){
	$('#password').blur(function(){
		var matches = $(this).val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!#%*?&])[A-Za-z\d@$!#%*?&]{8,}$/);
		if(matches){
			$('#password_good_error').hide();
			$('input[type="submit"]').prop('disabled', false);
		}else{
			$('#password_good_error').show();
			$('input[type="submit"]').prop('disabled', true);
		}
	})
	$('#verify_password').keyup(function(){
		if($(this).val() != $('#password').val()){
			$('#password_match_error').show();
			$('input[type="submit"]').prop('disabled', true);
		}else{
			$('#password_match_error').hide();
			$('input[type="submit"]').prop('disabled', false);
		}
	});
});
</script>
<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <div class="main-area">
        <h2>Account Registration</h2>
    </div>
    <div class="main-room">
                <h5>(All Fields are required)</h5>

                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="POST" action="?f=account&a=registerNew">
                    <input type="text"  required placeholder="First Name" name="firstname"
                           id="firstname" <?php
                           if (isset($firstname)) {
                               echo "value='$firstname'";
                           }
                           ?>><br><br>
                    <input type="text"  required placeholder="Last Name" name="lastname"
                           id="lastname" <?php
                           if (isset($lastname)) {
                               echo "value='$lastname'";
                           }
                           ?>><br><br>
                    <input type="email" required placeholder="Email Address" name="email" 
                           id="email"  <?php
                           if (isset($email)) {
                               echo "value='$email'";
                           }
                           ?>><br><br>
                    <span>Enter the Registration Passphrase given by your administrator.</span><br>
                    <input type="text" required placeholder="Passphrase" name="passphrase" id="passphrase"><br><br>
                    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                    <input type="password" required placeholder="Password"
                           name="password"  id="password"
                           ><div id="password_good_error" style="display:none"><span style="color:red;font-weight:bold;">PASSWORDS DOES NOT MEET CRITERIA</span></div><br><br>
                    <span>Verify Password</span><br>
                    <input type="password" required placeholder="Verify Password"
                           name="verify_password"  id="verify_password"
                           pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><div id="password_match_error" style="display:none"><span style="color:red;font-weight:bold;">PASSWORDS DO NOT MATCH</span></div><br><br>
                    <input type="submit" value="Create Account">
                </form>
    </div>
</main>

<?php include $path . '/modules/footer.php'; ?>
