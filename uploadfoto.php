<?php 
function uploadfoto($File){    
	$uploadOk = 1;
	$hasil = array();
	$message = '';
 
	//File properties:
	$FileName = $File['Name'];
	$TmpLocation = $File['Tmp_name'];
	$FileSize = $File['Size'];

	//Figure out what kind of file this is:
	$FileExt = explode('.', $FileName);
	$FileExt = strtolower(end($FileExt));

	//Allowed files:
	$Allowed = array('jpg', 'png', 'gif', 'jpeg');  

	// Check file size
	if ($FileSize > 300000) {
		$message .= "Sorry, your file is too large, max 300KB. ";
		$uploadOk = 0;
	}

	// Allow certain file formats
	if(!in_array($FileExt, $Allowed)){
		$message .= "Sorry, only jpg, jpeg, png & gif files are allowed. ";
		$uploadOk = 0; 
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$message .= "Sorry, your file was not uploaded. ";
		$hasil['status'] = false; 
		// if everything is ok, try to upload file
	}else{
		//Create new filename:
        $NewName = date("YmdHis"). '.' . $FileExt;
        $UploadDestination = "img/". $NewName; 

		if (move_uploaded_file($TmpLocation, $UploadDestination)) {
			//echo "The file has been uploaded.";
			$message .= $NewName;
			$hasil['status'] = true; 
		}else{
			$message .= "Sorry, there was an error uploading your file. ";
			$hasil['status'] = false; 
		}
	}
	
	$hasil['message'] = $message; 
	return $hasil;
}
?>