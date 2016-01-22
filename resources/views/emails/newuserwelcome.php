<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Welcome, <?php echo $user['name'] ?>!</h1>
    <p>You have been added as a partner for <?php echo $user['parent_organization'] ?></p>
    <p>Please sign in <a href="http://allacccessrms.dev/auth/login">HERE</a> with your email address and temporary password:
        <?php echo $user['password'] ?></p>
</body>
</html>