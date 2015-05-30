
<nav id="navigation">
    <ul>
        <li><a href="/lynn/index.php?action=home">Home</a></li>
        <li><a href="/lynn/index.php?action=gallery">Gallery</a></li>
        <li><a href="/lynn/index.php?action=contact">Contact</a></li>
        <li><a href="/lynn/index.php?action=about">About Me</a></li>
        <?php if($_SESSION['admin']==TRUE) { ?>
        <li><a href="/lynn/index.php?action=admin">Admin</a></li>
        <li><a href="/lynn/index.php?action=upload">Upload</a></li>
        <?php }  ?>
    </ul>
</nav>