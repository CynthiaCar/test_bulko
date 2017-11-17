<?php
// DESTINATAIRE(S)
$destinataire = 'cynthia.carbonnier@yahoo.fr ; cynthia@etvoilaprod.com';

// COPIE OU NON AU VISITEUR
$copie = 'non'; 

// MESSAGES
$message_envoye = "Votre message nous est bien parvenu !";
$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

// FONCTION DE NETTOYAGE ET ENREGISTREMENT
function Rec($text)
{
	$text = htmlspecialchars(trim($text), ENT_QUOTES);
	if (1 === get_magic_quotes_gpc())
	{
		$text = stripslashes($text);
	}
	$text = nl2br($text);
	return $text;
};

//VERIFICATION SYNTAXE DU MAIL
function IsEmail($email)
{
	$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
	return (($value === 0) || ($value === false)) ? false : true;
}

// RECUPERATION DES CHAMPS
$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
$tel     = (isset($_POST['tel']))     ? Rec($_POST['tel'])     : '';
$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

//VERIFICATION VARIABLES ET EMAIL
$email = (IsEmail($email)) ? $email : ''; 

if (($nom != '') && ($tel != '')  && ($email != '') && ($message != ''))
{

// GENERATION ET ENVOI DU MAIL
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'From:'.$nom.' <'.$email.'>' . "\r\n" .
	'Reply-To:'.$email. "\r\n" .
	'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
	'Content-Disposition: inline'. "\r\n" .
	'Content-Transfer-Encoding: 7bit'." \r\n" .
	'X-Mailer:PHP/'.phpversion();
	
// SI VISITEUR EST EN COPIE
	if ($copie == 'oui')
	{
		$cible = $destinataire.';'.$email;
	}
	else
	{
		$cible = $destinataire;
	};
	
// REMPLACEMENT CARACTERES SPECIAUX
	$message = str_replace("&#039;","'",$message);
	$message = str_replace("&#8217;","'",$message);
	$message = str_replace("&quot;",'"',$message);
	$message = str_replace('<br>','',$message);
	$message = str_replace('<br />','',$message);
	$message = str_replace("&lt;","<",$message);
	$message = str_replace("&gt;",">",$message);
	$message = str_replace("&amp;","&",$message);
	
// ENVOI MAIL
	$num_emails = 0;
	$tmp = explode(';', $cible);
	foreach($tmp as $email_destinataire)
	{
		if (mail($email_destinataire, 'message depuis le formulaire', $message, $headers))
			$num_emails++;
	}
	if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1)))
	{
		echo '<p>'.$message_envoye.'</p>';
	}
	else
	{
		echo '<p>'.$message_non_envoye.'</p>';
	};
}
else
{
// EN CAS D'ERREUR
	echo '<p>'.$message_formulaire_invalide.' <a href="societe_contact.php">Retour au formulaire</a></p>'."\n";
};

// RETOUR AU FORMULAIRE
header('Location: contact.php');
exit();

?>