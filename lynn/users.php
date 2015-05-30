<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home | LynnPagelPhotography.com</title>
        <link href="/css/screen.css" type="text/css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div id="container">
            <header>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/login.php'; ?>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
            </header>
            <main>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/navigation.php'; ?>
                 
                <h1>Current Users</h1>
                <?php
                if (isset($message)) {
                    echo '<p class="notice">' . $message . '</p>';
                }
                ?>
                <div id="userstable">
                    <table>
                        <thead><tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Email Address</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                
                            </tr></thead>
                        <tbody>

                            <?php
                            foreach ($users as $user) {
                                $userdata = '<tr>';
                                $userdata .= '<td>' . $user['LastName'] . '</td>';
                                $userdata .= '<td>' . $user['FirstName'] . '</td>';
                                $userdata .= '<td>' . $user['Email'] . '</td>';
                                $userdata .= '<td>' . $user['Admin'] . '</td>';
                                $userdata .= '<td><a href="/lynn?action=update&amp;eduser=' . $user['UserID'] . '">Edit</a></td>';
                                $userdata .= '<td><a href="/lynn?action=delete&amp;eduser=' . $user['UserID'] . '&amp;firstname=' . $user['FirstName'] . '">Delete</a></td>';

                                $userdata .= '</tr>';
                                echo $userdata;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </footer>
    </body>
</html>
