<?php
	/*/
		$filepath = str_replace(".png", ".svg", $filepath);

		// Get Image Dimensions
		$path_parts = pathinfo(parse_url($carrier['src'])['path']);
		$dirname = $path_parts['dirname'];
		$filename = $path_parts['filename'];
		$filepath = substr("$dirname/$filename.png", 1);

		If PNG doesn't exist, then try alternate filename
		if (! file_exists($filepath)) {
			$filepath = str_replace(".png", "-w500.png", $filepath);
		}

		if (! file_exists($filepath)) {

		} else {

		}
	/*/

	$target_area = 50000; // this might need to be an average of all logos?
	$filepath = $_GET["filepath"];
	$filepath = str_replace(".svgz", ".svg", $filepath);
	$path_parts = pathinfo($filepath);

	switch ($path_parts['extension']) {
		case 'svg':
			// If SVG image exists then grab viewbox from first 150 characters
			$fp = fopen($filepath, 'r');
			$data = fread($fp, 150);
			fclose($fp);

			preg_match('/(?<=viewBox=")[^"]+/', $data, $matches);
			list($x, $y, $width, $height) = explode(" ", $matches[0]);
		break;
		case 'png':
			// Otherwise, get the dimensions from the PNG image's EXIF info
			$im = new imagick($filepath);
			$properties = $im->getImageProperties('*', FALSE);
			list($width, $height) = explode(",", $im->getImageProperty("png:IHDR.width,height"));
		break;
	}

	$newwidth = 500;
	$newheight = ($newwidth * $height) / $width;
	$newarea = $newwidth * $newheight;

	$m = sqrt($target_area / $newarea);

	$stats = [
		'original' => $width . 'x' . $height . '=' . round($width * $height, 2),
		'standardized' => round($newwidth, 2) . 'x' . round($newheight, 2) . '=' . round($newarea, 2),
		'multiplier' => round($m, 8),
		'percentage' => round($m * 100, 8) . '%'
	];

	header('Content-Type: application/json');
	echo json_encode($stats, JSON_PRETTY_PRINT);
?>
