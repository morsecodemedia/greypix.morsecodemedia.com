<div class="nav-button-holder">
    <div class="nav-button vis-m"><span></span><span></span><span></span></div>
</div>
<div class="nav-holder">
    <nav>
        <ul>
            <li><a href="/" <?php echo ($this->uri->segment(1, 0) === 0) ? 'class="act-link"' : ''; ?>>Home</a></li>
            <li><a href="/albums/" <?php echo ($this->uri->segment(1, 0) == "albums") ? 'class="act-link"' : ''; ?>>Albums</a></li>
            <!-- <li><a href="/videos/">Videos</a></li> -->
        </ul>
    </nav>
</div>
