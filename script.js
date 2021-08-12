function editextcommande(nom, argument) {
	if (typeof argument === 'undefined') {
  argument = '';
	}
	switch (nom) {
  case "createLink":
  argument = prompt("Quelle est l'adresse du lien ?");
  break;
  }
	document.execCommand(nom, false, argument);
  }