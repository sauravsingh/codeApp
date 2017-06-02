<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="<?php echo base_url('home');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url('recharge');?>"><i class="fa fa-shopping-cart fa-fw"></i> Recharge</a>
                </li>
                <?php if($_SESSION['userType'] == 1){?>
                <li>
                    <a href="<?php echo base_url('configuration');?>"><i class="fa fa-wrench fa-fw"></i> Configure</a>
                </li>
                <?php }?>
                <li>
                    <a href="#"><i class="fa fa-money fa-fw"></i> Wallet<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if($_SESSION['userType'] == 1){?>
                            <li>
                                <a href="<?php echo base_url('wallet/requestedAmount');?>">Requested Amount</a>
                            </li>
                            <!-- <li>
                                <a href="<?php //echo base_url('wallet/approvedAmount');?>">Approved</a>
                            </li> -->
                        <?php }
                        else{?>
                            <li>
                                <a href="<?php echo base_url('wallet/requestBalance');?>">Request Amount</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('wallet/passbook');?>">Passbook</a>
                            </li>
                        <?php }?>
                        
                    </ul>
                </li>
                <?php if($_SESSION['userType'] == 1){?>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('users/addUser');?>">Add User</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('users/usersList');?>">Users List</a>
                        </li>
                    </ul>
                </li>
                 <?php }?>
            </ul>
        </div>
    </div>
</nav>