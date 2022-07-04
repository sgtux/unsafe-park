<?php

if( !@mysql_connect( $_DVWA[ 'db_server' ], $_DVWA[ 'db_user' ], $_DVWA[ 'db_password' ] ) ) {
	dvwaMessagePush( "Could not connect to the database.<br/>Please check the config file." );
	dvwaPageReload();
}

$drop_db = "DROP DATABASE IF EXISTS {$_DVWA[ 'db_database' ]};";
if( !@mysql_query( $drop_db ) ) {
	dvwaMessagePush( "Could not drop existing database<br />SQL: ".mysql_error() );
	dvwaPageReload();
}

$create_db = "CREATE DATABASE {$_DVWA[ 'db_database' ]};";
if( !@mysql_query( $create_db ) ) {
	dvwaMessagePush( "Could not create database<br />SQL: ".mysql_error() );
	dvwaPageReload();
}
dvwaMessagePush( "Database has been created." );

if( !@mysql_select_db( $_DVWA[ 'db_database' ] ) ) {
	dvwaMessagePush( 'Could not connect to database.' );
	dvwaPageReload();
}

$create_tb = "CREATE TABLE users (user_id int(6),first_name varchar(15),last_name varchar(15), user varchar(15), password varchar(32),avatar varchar(70), last_login TIMESTAMP, failed_login INT(3), PRIMARY KEY (user_id));";
if( !mysql_query( $create_tb ) ) {
	dvwaMessagePush( "Table could not be created<br />SQL: ".mysql_error() );
	dvwaPageReload();
}
dvwaMessagePush( "'users' table was created." );

$baseUrl  = 'http://'.$_SERVER[ 'SERVER_NAME' ].$_SERVER[ 'PHP_SELF' ];
$stripPos = strpos( $baseUrl, 'setup.php' );
$baseUrl  = substr( $baseUrl, 0, $stripPos ).'hackable/users/';

$insert = "INSERT INTO users VALUES
	('1','admin','admin','admin',MD5('password'),'{$baseUrl}admin.jpg', NOW(), '0'),
	('2','Vitima','Vitima','vitima',MD5('vitima'),'{$baseUrl}gordonb.jpg', NOW(), '0'),
	('3','Atacante','Atacante','atacante',MD5('atacante'),'{$baseUrl}1337.jpg', NOW(), '0');";
if( !mysql_query( $insert ) ) {
	dvwaMessagePush( "Data could not be inserted into 'users' table<br />SQL: ".mysql_error() );
	dvwaPageReload();
}
dvwaMessagePush( "Data inserted into 'users' table." );

$create_tb_guestbook = "CREATE TABLE guestbook (comment_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, comment varchar(300), name varchar(100), PRIMARY KEY (comment_id));";
if( !mysql_query( $create_tb_guestbook ) ) {
	dvwaMessagePush( "Table could not be created<br />SQL: ".mysql_error() );
	dvwaPageReload();
}
dvwaMessagePush( "'guestbook' table was created." );

$insert = "INSERT INTO guestbook VALUES ('1','This is a test comment.','test');";
if( !mysql_query( $insert ) ) {
	dvwaMessagePush( "Data could not be inserted into 'guestbook' table<br />SQL: ".mysql_error() );
	dvwaPageReload();
}
dvwaMessagePush( "Data inserted into 'guestbook' table." );

dvwaMessagePush( "<em>Setup successful</em>!" );
if( !dvwaIsLoggedIn())
	dvwaMessagePush( "Please <a href='login.php'>login</a>.<script>setTimeout(function(){window.location.href='login.php'},5000);</script>" );
dvwaPageReload();

?>
