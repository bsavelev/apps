<?php
/**
 * Copyright (c) 2013 Lukas Reschke <lukas@statuscode.ch>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

// Set the content type to Javascript
header("Content-type: text/javascript");

// Disallow caching
header("Cache-Control: no-cache, must-revalidate"); 
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 

$dir = isset($_GET['dir']) ? $_GET['dir'] : '';
$file = isset($_GET['file']) ? $_GET['file'] : '';

function endsWith($haystack, $needle)
{
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}

if (!endsWith($file,'.pdf')) {
    $url=OCP\Util::linkTo('files_pdfviewer', 'convert.php');
}


$array = array(
	"PDFJS.workerSrc" => OCP\Util::linkTo('files_pdfviewer', '3rdparty/pdfjs/pdf.js'),
	"window.dir" => $dir,
	"window.file" => $file,
	"window.url" => $url,
	);

// Echo it
foreach ($array as  $setting => $value) {
	echo($setting ."=".json_encode($value).";\n");
}