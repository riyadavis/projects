        </div>
    </nav>
    <br>
    <!-- <form class="container" method="post" action="<?php echo site_url('MyWebsiteApi/selectDB') ?>">
        <div class="signup">
            <label>Login</label>
        </div>
        <?php 
            if($msg!=null)
            {
                if($msg=='password')
                {
                    $message = "Invalid Password";
                }
                else
                {
                    $message = "Invalid User";
                }
        ?>
                <div class="messageBox">
                <?php echo $message;?>
            </div>        
        <?php
            }
        ?>
        <div class="login-form">
            <div class="form-group">
                <label for="email2"><b>Email:</b></label>
                <input type="email" class="form-control" name="email2" placeholder="Enter your email" id="email" oninput="validation();">
            </div>
            <div class="form-group">
                <label for="pass2"><b>Password:</b></label>
                <input type="password" class="form-control" name="pass2" placeholder="Enter your password" id="pwd" oninput="validation();">
            </div>
            <div class="form-group">
                <div class="btnflex">
                    <button type="submit" class="btn btn-warning " name="btn2" id="btn">Login</button>
                </div>
            </div>
         </div>
    </form> -->

    <form class="container">
        <div class="signup">
            <label>Login</label>
        </div>
        
        <div class="messageBox" id="message">
            
        </div>        

        <div class="login-form">
            <div class="form-group">
                <label for="email2"><b>Email:</b></label>
                <input type="email" class="form-control" name="email2" placeholder="Enter your email" id="email" oninput="validation();">
            </div>
            <div class="form-group">
                <label for="pass2"><b>Password:</b></label>
                <input type="password" class="form-control" name="pass2" placeholder="Enter your password" id="pwd" oninput="validation();">
            </div>
            <div class="form-group">
                <div class="btnflex">
                    <button type="button" class="btn btn-warning " onclick="ajax();" name="btn2" id="btn">Login</button>
                </div>
            </div>
         </div>
    </form>

    <script type="text/javascript">
        var btn = document.getElementById('btn');
        var email = document.getElementById('email');
        var pass = document.getElementById('pwd');
        var message = document.getElementById('message'); 
        message.style.display = "none";          
        btn.disabled = true;

        function validation()
        {
            if(email.value.length > 3)
            {
                if(pass.value.length > 2)
                {
                    btn.disabled = false;
                }
            }
        }

        async function ajax()
        {
            console.log('Logging In..');
            var url ='http://localhost/MyWebsite/MyWebsiteApi/selectDB';            
            var form = new FormData();
            form.append('email2',email.value);
            form.append('pass2', pass.value);
            // var newData = { 'email2' : email.value, 'pass2' : pass.value};
            var request = await fetch(url, {
                            method: 'POST',
                            body: form
            });
            var response = await request.json();
            console.log('Finished');
            console.log(response);
            if(response.error=='username')
            {
                message.style.display = "block";
                message.textContent = 'Invalid Username';
            }
            else if(response.error == 'password')
            {
                message.style.display = "block";                
                message.textContent = "Invalid Password";
            }
            else
            {
                console.log('Logged In');
                 location.reload();
            }
        }
    </script>