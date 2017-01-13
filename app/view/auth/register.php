<!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Register
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Register</li>
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
                        <h3 class="breadcrumb">Form Register</h3>                        
                    </div>
                    <div class="form-group">
                        <?php
                            if (isset($error)) {
                                foreach ($error as $error) {
                        ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <i class="fa fa-fw fa-warning-sign"></i> &nbsp; <?php echo $error; ?>
                                </div>
                                <?php 
                                    }
                                }
                                elseif (isset($_GET['joined'])) {
                                    ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <i class="fa fa-fw fa-log-in"></i>&nbsp;Successfully registered
                                        <a href="login.php">Login</a> here.
                                    </div>
                                    <?php 
                                        }
                                     ?>
                    </div>
                    
                    <form method="post">
                        <div class="form-group control-group">
                            <div class="controls">
                                <label>Username:</label>
                                <input type="text" class="form-control" name="username" required data-validation-required-message="Please enter your Username.">
                                <p class="help-block">Ex. oimtrust</p>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" required data-validation-required-message="Please enter your Password.">
                                <p class="help-block"></p>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="email" required data-validation-required-message="Please enter your Password.">
                                <p class="help-block">Ex. trustoim@gmail.com</p>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Nama Lengkap:</label>
                                <input type="text" class="form-control" name="fullname" required data-validation-required-message="Please enter your Fullname.">
                                <p class="help-block">Ex. Fathur Rohim</p>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Jenis Kelamin:</label>
                                <select name="gender" class="form-control">
                                    <option value="">Pilih Gender</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Nomor Telepon:</label>
                                <input type="number" class="form-control" name="phone" required data-validation-required-message="Please enter your Phone.">
                                <p class="help-block">Ex. 08133304****</p>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Alamat:</label>
                                <textarea name="address" rows="3" class="form-control" required data-validation-required-message="Please enter your Address.">                                   
                                </textarea>
                                <p class="help-block">Ex. Jl. Supriadi RT:03, RW:04</p>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <input type="hidden" name="id_role" value="2">
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <button type="submit" name="btn-signup" class="btn btn-info form-control">Register</button>
                                <p class="help-block">Already have an account? <a href="login.php">Sign in here</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            

            <!-- End Login Sidebar Widgets Column -->

        </div>