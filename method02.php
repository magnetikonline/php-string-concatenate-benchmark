<?php
// $ time php -d memory_limit=512M method02.php

$startMemoryUsage = memory_get_usage();

$stringBuffer = [];
for ($loop = 0;$loop <= 1000000;$loop++) {
	$stringBuffer[] = fillRandomChars();
}

$stringBuffer = implode($stringBuffer);
displayMemoryUse($startMemoryUsage);


function fillRandomChars() {

	$randomCharacters = '';
	for ($i = 0;$i <= 20;$i++) $randomCharacters .= chr(mt_rand(65,90));

	return $randomCharacters;
}

function displayMemoryUse($startMemoryUsage) {

	echo('Memory use: ' . (memory_get_usage() - $startMemoryUsage) . " bytes\n");
}
