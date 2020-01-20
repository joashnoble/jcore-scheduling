<!--Header-->
<header id="topnav" class="navbar navbar-black navbar-fixed-top" role="banner">

    <div class="logo-area">
                <span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
                    <a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
                        <span class="icon-bg">
                            <i class="ti ti-menu"></i>
                        </span>
                    </a>
                </span>


        <!-- <a class="navbar-brand" href="#">HRIS</a> -->



    </div><!-- logo-area -->

    <ul class="nav navbar-nav toolbar pull-right">

        <li class="toolbar-icon-bg right_processpayroll_process">
            <a href="#" id="btn_process_payroll" title="Process Payroll"><span class="icon-bg"><i class="fa fa-check-circle"></i></span></i></a>
        </li>


        <li class="dropdown toolbar-icon-bg">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
                <img class="img-circle" src="<?php echo $this->session->main_directory.'/'.$this->session->user_photo; ?>" alt="" />
            </a>
            <ul class="dropdown-menu userinfo arrow">
                <li><a href="login/transaction/logout"><i class="ti ti-shift-right"></i><span>Sign Out</span></a></li>
            </ul>
        </li>

    </ul>

</header><!--Header-->
