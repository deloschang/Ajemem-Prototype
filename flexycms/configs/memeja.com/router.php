<?php
$possible_urls = array(
		"/([a-zA-Z0-9_]*)/" 	=> "/page-user-choice-$1",
		"/(.*).html/" 		=> "/static/$1"
);
