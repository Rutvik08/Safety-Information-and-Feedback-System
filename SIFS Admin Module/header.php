
<nav  class="navbar nav-tabs navbar-dark navbar-expand-lg  bg-dark">
           
            <a class="navbar-brand" href="#">
        <img src="logo.png">
    </a>
			<ul class="navbar-nav mr-auto">
    <?php
        // Define each name associated with an URL
        $urls = array(
            'Safety Feedback List' => 'view_feedback.php',
            'Logout' => 'logout.php'
       
        );

        foreach ($urls as $name => $url) {
            print '<li '.(($currentPage === $name) ? ' class="nav-item active" ': ' class="nav-item" ').
                '><a href="'.$url.'" class="nav-link">'.$name.'</a></li>';
        }
    ?>
</ul>

</nav >