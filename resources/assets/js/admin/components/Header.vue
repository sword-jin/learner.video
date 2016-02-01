<template>
<header class="header">
    <a v-link="{name: 'dashboard'}" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        Learner
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                        <span>{{ username }} <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                        <li class="dropdown-header text-center">账户</li>

                        <li class="divider"></li>

                        <li>
                            <a href="/">
                                <i class="fa fa-cog fa-home pull-right"></i>
                                返回前台
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/auth/logout"><i class="fa fa-ban fa-fw pull-right"></i> 退出</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
</template>

<script>
module.exports = {
    data() {
        return {

        }
    },
    props: ['username']
}
</script>
