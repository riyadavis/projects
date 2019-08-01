    <br>
    <div class="container">
        <form autocomplete="off"> 
            <div class="signup">
                <label>Signup</label>
            </div>
            <!-- // echo $this->router->fetch_class(). ' '.$this->router->fetch_method();
                // echo $this->uri->segment(2); -->

            <div class="messageBox" id="message">
            </div>        
            <div id='myForm'>
                <div class="form-group">
                    <label for="name"><b>Name:</b></label>
                    <input type="text" class="form-control" name="name" placeholder="Enter your email" id="name1" autofocus>
                </div>
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" id="email1">
                </div>
                <div class="form-group">
                    <label for="gender"><b>Gender:</b></label>
                    <select class="form-control" name="gender" id="gender1">
                        <option selected="true" disabled="disabled">--select--</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pass"><b>Password:</b></label>
                    <input type="password" class="form-control" name="pass" placeholder="Enter your password" id="pass1">
                </div>
                <div class="form-group">
                    <div class="btnflex">
                        <button type="button" class="btn btn-warning " name="btn" id="btn1" onclick="ajax();">Signup</button>
                    </div>
                </div>
            </div>
        </form>  

        <script type="text/javascript">
            userName = document.getElementById('name1');
            email = document.getElementById('email1');
            gender = document.getElementById('gender1');
            pass = document.getElementById('pass1');
            message = document.getElementById('message'); 
            message.style.display = "none";     

            async function ajax()
            {
                var url="http://localhost/MyWebsite/MyWebsiteApi/insertDB";
                var form = new FormData();
                form.append('name',userName.value);
                form.append('email',email.value);
                form.append('gender',gender.value);
                form.append('pass',pass.value);

                var request = await fetch(url,{
                        method : 'POST',
                        body : form
                });
                var response = await request.json();
                console.log(response);
                if(response.signup=='success')
                {
                    message.style.display = "block";
                    message.textContent = 'Thank You for Signing Up';
                }
                else if(response.signup=='failed')
                {
                    message.style.display = "block";
                    message.textContent = 'Please Try Again';
                }
                else
                {
                    message.style.display = "block";
                    message.textContent = 'Existing Email Id';
                }               
            }
            
        </script>  
    </div>
   