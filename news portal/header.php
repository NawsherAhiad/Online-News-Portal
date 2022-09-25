<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a href = "index.php" class="navbar-brand"><img src="logo.jpg" style="height: 150px; width: 250px;"></a>
        <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
          <ul class="navbar-nav mr-auto">
               
          <li class="nav-item dropdown">
               
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                    <i class="fa fa-fw fa-user"></i>Category</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="newsListByCategory.php?news_type=national">National</a>
                    <a class="dropdown-item" href="newsListByCategory.php?news_type=international">International</a>
                    <a class="dropdown-item" href="newsListByCategory.php?news_type=sports">Sports</a>
                    <a class="dropdown-item" href="newsListByCategory.php?news_type=entertainment">Entertainment</a>
                    <a class="dropdown-item" href="newsListByCategory.php?news_type=lifestyle">Lifestyle</a>
                  </div>
               
          
        <?php
        if(isset($_SESSION['id']))
        {
          if($_SESSION['rank'] == "User")
          {
               ?>
               <li class="nav-item"><a href = "accountSettings.php" class="nav-link" style="color: white;"><i class="fa fa-fw fa-user"></i><?php echo $_SESSION['name']?></a>
               <li class="nav-item"><a href = "logout.php" class="nav-link" style="color: white;"><i class="fas fa-sign-out-alt"></i> Logout</a>
               <?php
          }
          elseif ($_SESSION['rank'] == "Admin") 
          {
               ?>
               
               <li class="nav-item"><a href = "admin.php" class="nav-link" style="color: white;"><i class="fa fa-fw fa-user"></i> Admin</a></li>
               <li class="nav-item"><a href = "logout.php" class="nav-link" style="color: white;"><i class="fas fa-sign-out-alt"></i> Logout</a>
               

               <?php

          }

        }
        else
        {
          ?>
          
          <li class="nav-item"><a href = "login.php" class="nav-link" style="color: white;"><i class="fa fa-fw fa-user"></i> Login</a></li>
          <li class="nav-item"><a href = "signup.php" class="nav-link" style="color: white;"><i class="fas fa-sign-out-alt"></i> Register</a>
          
          <?php
        }
        ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="POST" action="searchNews.php">
          <input class="form-control mr-sm-2" type="search" placeholder="Search News" name="keyword" aria-label="Search" required size= 50>
          <button class="btn btn-outline-light" type="submit"><i class="fa fa-fw fa-search"></i>Search</button>
        </form>
        </div>
</nav>

