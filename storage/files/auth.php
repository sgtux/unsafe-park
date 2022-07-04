<?php

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    
    header('WWW-Authenticate: Basic realm="My Website"');
    header('HTTP/1.0 401 Unauthorized');
    
    echo '<p>Access denied. You did not enter a password.</p>';
    exit;
}

if ($_SERVER['PHP_AUTH_PW'] == '$ecret') {
    echo '<p>Access granted. You know the password!</p>';
} else {
    echo '<p>Access denied! You do not know the password.</p>';
}