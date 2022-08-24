<?php
	$filepath = $_GET["filepath"];
	//$filepath = str_replace(".png", ".svg", $filepath);
	
	// // Get Image Dimensions
	// $path_parts = pathinfo(parse_url($carrier['src'])['path']);
	// $dirname = $path_parts['dirname'];
	// $filename = $path_parts['filename'];
	// $filepath = substr("$dirname/$filename.png", 1);
	
	if (! file_exists($filepath)) {
		$filepath = str_replace(".png", "-w500.png", $filepath);
	}
	
	// If PNG doesn't exist, then try alternate filename
	// if (! file_exists($filepath)) {
	// 	$filepath = str_replace(".png", "-w500.png", $filepath);
	// }
	
	
	exit();
	
	// If alternate PNG still doesn't exist, then grab viewbox from SVG
	if (! file_exists($filepath)) {
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
	} else {
		// Create the object
		$im = new imagick($filepath);
		
		// Get the EXIF information
		$properties = $im->getImageProperties('*', FALSE);
		
		$dimensions = explode(",", $im->getImageProperty("png:IHDR.width,height"));
		
		$ratio = [
			intval($dimensions[0]),
			intval($dimensions[1])
		];
	}
	
	header('Content-Type: application/json');
	echo json_encode($ratio, JSON_PRETTY_PRINT);
?>
