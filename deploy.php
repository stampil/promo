<?php
/**
 * GIT DEPLOYMENT SCRIPT *
 * Used for automatically deploying websites via github or bitbucket, more deets here: *
 * https://gist.github.com/1809044
 */

if (empty($_GET['secret_key']) || $_GET['secret_key'] !== '2c28d4bc-5884-484a-b6fa-a2f7dd318372') {
    die('Don\'t do that please, it\'s a shame...');
}

//chdir(dirname(__DIR__));

// The commands
$commands = array(
    'echo $PWD',
    'whoami',
    'git pull',
    '/usr/local/bin/compass compile 2>&1',
    'cp ./wp-content/themes/cuisinart/dev/js/* ./wp-content/themes/cuisinart/prod/js',
    'git status',
    'find . -type d -exec chmod 755 {} \; 2>&1',
);

// Run the commands for output
$output = '';
foreach ($commands AS $command) {
// Run it
    $tmp = shell_exec($command);
// Output
    $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
    $output .= htmlentities(trim($tmp)) . "\n";
}

// Make it pretty for manual user access (and why not?)
?>
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>GIT DEPLOYMENT SCRIPT</title>
    </head>
    <body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
        <pre>
. ____ . ____________________________
|/ \| | |
[| <span style="color: #FF0000;">&hearts; &hearts;</span> |] | Git Deployment Script v0.1 |
|___==___| / &copy; oodavid 2012 |
|____________________________|

            <?php echo $output; ?>
        </pre>
    </body>
</html>
