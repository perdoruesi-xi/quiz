<?php  	
$name = $_FILES['file']['name'];

$extension = strtolower(substr($name,strpos($name, '.') + 1));
$type = $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$max_size = 2097152;//2MB
$tmp_name = $_FILES['file']['tmp_name'];
$error = $_FILES['file']['error'];

if(isset($name))
{
	if(!empty($name))
	{
		if(($extension=='jpg' || $extension=='jpeg' ||$extension=='png')&& ($type=='image/jpg' || $type=='image/jpeg')|| $type='image/png'))
		{
			if($size<=$max_size)
			{
				$location='foto/';
				if(move_uploaded_file($tmp_name, $location.$name))
					echo 'Uploaded';
				else
					echo 'Ka ndodhur nje gabim!';
			}
			else
				'Foto nuk mund te jete me e madhe se 2MB';
		}
		else
			echo 'Ju lutemi zgjedhni nje file JPG, JPEG ose PNG!';
	}
	else
	{
		echo 'Please choose a file!';
	}
}
?>
