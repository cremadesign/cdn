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

	$filepath = $_GET["filepath"];
	$path_parts = pathinfo($filepath);

	switch ($path_parts['extension']) {
		case 'svg':
			// If SVG image exists then grab viewbox from first 100 characters
			$filepath = str_replace(".png", ".svg", $filepath);

			$fp = fopen($filepath, 'r');
			$data = fread($fp, 100);

			preg_match('/(?<=viewBox=")[^"]+/', $data, $matches);
			$viewbox = explode(" ", $matches[0]);

			fclose($fp);

			$ratio = [
				1,
				2
			];
		break;
		case 'png':
			// Otherwise, get the dimensions from the PNG image's EXIF info

			$im = new imagick($filepath);

			// Get the EXIF information
			$properties = $im->getImageProperties('*', FALSE);

			$dimensions = explode(",", $im->getImageProperty("png:IHDR.width,height"));

			$ratio = [
				intval($dimensions[0]),
				intval($dimensions[1])
			];
		break;
	}

	header('Content-Type: application/json');
	echo json_encode($ratio, JSON_PRETTY_PRINT);
?>
