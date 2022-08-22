  <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="myaccount.php">
                    <h1 class="tm-site-title mb-0">API-SaaS</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link active" href="myaccount.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="https://documenter.getpostman.com/view/12280928/VUqmwKSG" target="_blank">
                                <i class="fas fa-file"></i>
                                Docs
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">
                                <i class="far fa-user"></i>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php" >
                                <i class="fas fa-cog"></i>
                                <span>
                                    Settings
                                </span>
                            </a>
                            
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="login.php?lg=1">
                                <?php echo $user->getName(); ?>, <b>Logout</b>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>