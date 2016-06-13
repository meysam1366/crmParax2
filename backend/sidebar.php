<!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <?php if ($_SESSION['Admin']) { ?>
                <li><a href="<?= BASE_DOMAIN; ?>/backend/dashboard.php"><i class="icon-bar-chart"></i><span
                            class="hidden-tablet"> مدیریت</span></a></li>
                <li><a href="<?= BASE_DOMAIN; ?>/backend/users.php"><i class="icon-envelope"></i><span
                            class="hidden-tablet"> مدیریت کارمندان</span></a></li>
                <li><a href="<?= BASE_DOMAIN; ?>/backend/domains/domains.php"><i class="icon-envelope"></i><span
                            class="hidden-tablet"> مدیریت دامنه ها</span></a></li>
                <li><a href="<?= BASE_DOMAIN; ?>/backend/projects/projects.php"><i class="icon-envelope"></i><span
                            class="hidden-tablet"> مدیریت پروژه ها</span></a></li>
                <li><a href="<?= BASE_DOMAIN; ?>/backend/customers/customers.php"><i class="icon-envelope"></i><span
                            class="hidden-tablet"> مدیریت مشتریان</span></a></li>
                <li><a href="<?= BASE_DOMAIN; ?>/backend/tickets/tickets.php"><i class="icon-envelope"></i><span
                            class="hidden-tablet"> مدیریت مشکلات پروژه</span></a></li>
                <li><a href="<?= BASE_DOMAIN; ?>/backend/comments/comments.php"><i class="icon-tasks"></i><span
                            class="hidden-tablet"> مدیریت پیام ها</span></a></li>
            <?php } ?>
            <li><a href="<?= BASE_DOMAIN ?>/backend/passGenerate.php"><i class="icon-lock"></i><span class="hidden-tablet"> تولید رمز</span></a></li>
            <li><a href="<?= BASE_DOMAIN ?>/backend/logout.php"><i class="icon-lock"></i><span class="hidden-tablet"> خروج</span></a></li>
        </ul>
    </div>
</div>
<!-- end: Main Menu -->

<noscript>
    <div class="alert alert-block span10">
        <h4 class="alert-heading">Warning!</h4>
        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to
            use this site.</p>
    </div>
</noscript>