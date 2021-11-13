<nav>
    <div class="search">
        <input type="text" id="search" placeholder="Search...">
        <button class="btn-search"><i class="fas fa-search"></i></button>
    </div>

    <div class="personal">
        <span class="bell"><i class="fas fa-bell"></i></span>
        <span class="setting"><i class="fas fa-cog"></i></span>
        <span><strong><?php echo ucfirst($_SESSION['user']['first_name']) . ' ' .  ucfirst($_SESSION['user']['last_name']) ?></strong></span>
    </div>
</nav>