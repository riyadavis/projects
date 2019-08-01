<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="StyleSheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrap.min.css"; ?>">
    <link rel="StyleSheet" type="text/css" href="<?php echo base_url()."assets/css/main.css"; ?>">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <a class="navbar-brand" href="<?php echo site_url('MyWebsiteApi/home') ?>">My Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bg-dark" ><i class="fa fa-ban"></i></span>
            <!-- <i class="fas fa-bars" ></i> -->
            
        </button>
        <div class="collapse navbar-collapse navbar-dark" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="<?php echo site_url('MyWebsiteApi/home') ?>">Home</a>
                <a class="nav-item nav-link" href="#">About</a>
                <a class="nav-item nav-link" href="#">Gallery</a>
            </div>
            <div class="search">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" oninput="Search(event);" onchange="Details()" placeholder="Search" list="searches" aria-label="Search" id="search" autocomplete="off">
                    <datalist id="searches">
                    </datalist>
                    <button class="btn btn-outline-warning my-2 my-sm-0" type="button">Search</button>
                </form>
            </div>
            <?php
            if($this->uri->segment(2)=='signup')
            {
            ?>
            <form method="post" class="login">
                <a class="btn btn-warning" href="<?php echo site_url('MyWebsiteApi/login') ?>" name="login" role="button">Login</a>
            </form>            
            <?php
            }
            elseif($this->session->userdata('username')!=null)
            {
            ?>
                <form method="post" class="login">
                    <a class="btn btn-warning" href="<?php echo site_url('MyWebsiteApi/logout') ?>" name="logout" role="button">Logout</a>
                </form>
            <?php                
            }
            ?>
        </div>
    </nav>            
           
  <script>
    // var s = document.getElementById('search');
    // s.addEventListener('click',()=>{alert('Input Box focused!');});
    var search = document.getElementById('search');
    var datalist = document.getElementById('searches');

    function Details()
    {
        var nar = response.filter(r => r.email==search.value);
        var item = nar[0];
        console.log(item)
       
        for(var i in item)
        {
            modalBody = document.getElementById('modalBody');            
            var para = document.createElement('p');
            var textNode = document.createTextNode(i+":"+item[i]);
            para.appendChild(textNode);
            modalBody.appendChild(para);
        }
        
        $('#badModal').modal('show');
        
    }

    function modalBtn()
    {
        search.value = ""; 
        modalBody.innerHTML = "";
        searches.innerHTML = "";
        $('#badModal').modal('hide');
    }
    
    async function Search(event)
    {
        searches.innerHTML = "";
        if(event.inputType=='deleteContentBackward')
        {

        }    
        if(search.value.length> 0) 
        {
            url ='http://localhost/MyWebsite/MyWebsiteApi/search/?q='+search.value;                        
            request = await fetch(url);
            response = await request.json();
            response.map(r => {
                option = document.createElement('option');
                option.value = r.email; 
                option.id = r.id;
                datalist.appendChild(option);
            });
            
        }
    
    }

  </script>
  
  <!-- The Modal -->
<div class="modal" id="badModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">User Information</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" >
          <div id="modalBody">    

          </div>
            
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="modelBtn" onclick="modalBtn();">Close</button>
      </div>

    </div>
  </div>
</div>