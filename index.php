<?php

$dossier = 'temps';

echo "<html>";
	
echo "<head>";

	//Génère les informations générales de la page et lui inclut le fichier CSS avec les fonctions style de la page
		
	echo "<meta charset='utf-8'/>
	<link rel='stylesheet' href='style.css'/>
	<title>Editeur de contenue web</title>";
  
echo "</head>";
	
echo "<body>";

//Génère le formulaire éditable avec les boutons d'édition de contenue

?>

<form enctype="multipart/form-data" method="post">
		<input type='button' value='↩' onclick="editextcommande('undo');"/>
		<input type='button' value='↪' onclick="editextcommande('redo');"/>
		<input type='button' value='hr' onclick="editextcommande('insertHorizontalRule');"/>
		<input type='button' value='B' style="font-weight:bold;" onclick="editextcommande('bold');"/>
		<input type='button' value='I' style="font-style:italic;" onclick="editextcommande('italic');"/>
		<input type='button' value='U' style="text-decoration:underline;" onclick="editextcommande('underline');"/>
		<input type='button' value='S' style="text-decoration:line-through;" onclick="editextcommande('strikeThrough');"/>
		<select onclick="editextcommande('heading', this.value);"" size='1'>
			<option value="p">Par default
			<option value="h1">Titre 1
			<option value="h2">Titre 2
			<option value="h3">Titre 3
			</select>
		<input type='button' value='Aligner à gauche' onclick="editextcommande('justifyLeft');"/>
		<input type='button' value='Centrer' onclick="editextcommande('justifyCenter');"/>
		<input type='button' value='Aligner à droite' onclick="editextcommande('justifyRight');"/>
		<input type='button' value='•' onclick="editextcommande('insertUnorderedList');"/>
		<input type='button' value='x.' onclick="editextcommande('insertOrderedList');"/>
		<input type='button' value='x²' onclick="editextcommande('superscript');"/>
		<input type="button" value="Lien" onclick="editextcommande('createLink');" />
		<input type="file" name="file_img">
		<input type="submit" value="Charger l'image" name="up_image">
		<?php  

		if(isset($_POST['up_image']))			//Si l'utilisateur clique sur charger l'image, importer l'image dans le dossier temps
			{

			$extensions_img = array('.png', '.gif', '.jpg', '.jpeg');
			$extension_img = strrchr($_FILES['file_img']['name'], '.');

			if(!empty($_FILES['file_img']['name'])){

				if(in_array($extension_img, $extensions_img)){

				$filepath1 = $dossier ."/" . $_FILES["file_img"]["name"];

				move_uploaded_file($_FILES["file_img"]["tmp_name"], $filepath1);

			}else{

				echo "<p>Le fichier n'a pas une extension valide</p>";

				}
			}
			}
		?>
		<input type="file" name="file_video">
		<input type="submit" value="Charger la vidéo" name="up_video">
		<?php
		if(isset($_POST['up_video']))				//Si l'utilisateur clique sur charger la vidéo, importer la vidéo dans le dossier temps
			{
			$extensions_video = array('.mp4');
			$extension_video = strrchr($_FILES['file_video']['name'], '.');

			if(!empty($_FILES['file_video']['name'])){

				if(in_array($extension_video, $extensions_video)){

				$filepath2 = $dossier ."/" . $_FILES["file_video"]["name"];
		
				move_uploaded_file($_FILES["file_video"]["tmp_name"], $filepath2);
			
				}else{

				echo "<p>La vidéo n'a pas une extension valide, afin que l'extension soit valide verifiez que le fichier soit bien au format .mp4</p>";

				}
			}
			}
		?>
	</form>

<?php

	echo "<br/>";

	//Génère la zone de texte éditable
	
	echo "<div class='editor' contenteditable='true'>";
	
	$folder = $dossier ."/";

		if(is_dir($folder)){			//Si le dossier folder contient des images ou des vidéos, les intégrer dans la zone de texte éditable

			if($open = opendir($folder))
				{
				while(($file = readdir($open)) !=false)
				{
				if($file == '.' || $file == '..') continue;
				if (substr($file, -3) == "gif" || substr($file, -3) == "jpg" || substr($file, -3) == "png" || substr($file, -4) == "jpeg" || substr($file, -3) == "PNG" || substr($file, -3) == "GIF" || substr($file, -3) == "JPG")				//Si le fichier finit par un format tel que .jpg .png .jpeg .gif générer le code html dans correspondant au l'intégration d'une image
				{

				echo "<img src='". $dossier ."/".$file."' style='width:450px;'>";

				}elseif(substr($file, -3) == "mp4"){				//Sinon, si le fichier finit par le format .mp4 générer le code html correspondant à l'intégration d'une vidéo
					
					echo "<p></p><video controls style='width:450px;'><source src='". $dossier ."/".$file."' type='video/mp4'></video><p></p>";

				}
				}
				closedir($open);
			}

			}
	
	echo "</div>";

	//Récupère le script d'édition de texte du fichier script.js
		
	echo "<script src='script.js' ></script>";


echo "</body>";

echo "</html>";

?>