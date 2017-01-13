<!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Login
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Login</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive" src="asset/images/slideone.png" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="asset/images/slidetwo.png" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="asset/images/slidethree.png" alt="">
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>

            <!-- Login Sidebar Widgets Column -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <h3 class="breadcrumb">Form Login</h3>
                    </div>
                    
                    <form action="login.php" method="post" accept-charset="utf-8" id="login-form">
                        <div id="error">
                            <?php 
                                if (isset($error)) {
                            ?>
                            <div class="alert alert-danger alert-dismissable">
                                <i class="fa fa-fw fa-warning-sign"></i> &nbsp; <?php echo $error ?> !
                            </div>
                            <?php
                                }
                             ?>
                        </div>
                        <div class="form-group control-group">
                            <div class="controls">
                                <label>Username:</label>
                                <input type="text" class="form-control" name="username" required autofocus>
                                <p class="help-block">Ex. oimtrust or trustoim@gmail.com</p>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" required>
                                <p class="help-block"></p>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <button type="submit" name="btn-login" class="btn btn-info form-control">
                                    Login
                                </button>
                                <p class="help-block">Don't have an account? <a href="register.php">Register here</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            

            <!-- End Login Sidebar Widgets Column -->

        </div>