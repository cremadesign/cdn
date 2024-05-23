<?php
	$target_area = $_GET['area'] ?? 50000; // this might need to be an average of all logos?
	$newwidth = $_GET['width'] ?? 500;

	$payload = file_get_contents('php://input');
	$images = json_decode($payload, true);

	foreach ($images as &$image) {
		$path_parts = pathinfo(parse_url($image)['path']);
		$dirname = $path_parts['dirname'];
		$filename = $path_parts['filename'];
		$extension = str_replace("svgz", "svg", $path_parts['extension']);
		$filepath = ltrim("$dirname/$filename.$extension", '/');

		switch ($extension) {
			case 'svg':
				// If SVG image exists then grab viewbox from first 150 characters
				$fp = fopen($filepath, 'r');
				$data = fread($fp, 200);
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

		$newheight = ($newwidth * $height) / $width;
		$newarea = $newwidth * $newheight;
		$m = sqrt($target_area / $newarea);

		$image = [
			'src' => $image,
			'stats' => [
				'original' => $width . 'x' . $height . '=' . round($width * $height, 2),
				'standardized' => round($newwidth, 2) . 'x' . round($newheight, 2) . '=' . round($newarea, 2),
				'multiplier' => round($m, 8),
				'percentage' => round($m * 100, 8) . '%'
			]
		];
	}

	header('Content-Type: application/json');
	echo json_encode($images, JSON_PRETTY_PRINT);
?>
