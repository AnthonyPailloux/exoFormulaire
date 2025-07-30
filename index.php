<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset\css\style.css">
    <title>ExoFormulaire</title>
</head>

<body>
    <h1>MY FIRST PHP</h1>
    <form action="" method="POST">

        <ul class="formContainer">
            <h2>Mon Formulaire</h2>
            <li>
                <!-- Le label est lié au champ texte grâce à for="pseudo" (même valeur que l'id) -->
                <label for="pseudo">Pseudo : </label>
                <!-- id : identifiant unique pour lier le label -->
                <!-- name : nom de la donnée envoyée au serveur -->
                <!-- Input texte pour saisir le pseudo -->
                <!-- placeholder : texte d’aide affiché dans le champ -->
                <input id="pseudo" name="pseudo" type="text" placeholder="Entrer votre nom prénom">
            </li>
            <li>
                <label for="sujet">Sujet : </label>
                <input id="sujet" name="sujet" type="text" placeholder="Sujet de votre message">
            </li>
            <li>
                <label for="message">Message : </label>
                <input id="message" name="message" type="text" placeholder="Saisir votre message">
            </li>
            <div>
                <!-- type : définit le bouton comme un bouton d’envoi -->
                <!-- value : texte affiché sur le bouton -->
                <input type="submit" value="Envoyer">
            </div>
        </ul>
    </form>
    <?php
    // ========================================================================================
    // ===================1 vérifier que la request à bien été soumise=========================
    // =============================2 Récupérer les données====================================
    // =============================3 vérifier les données=====================================
    // ==============================4 Nettoie les données=====================================
    // ============================5 Renvoyer quelque chose====================================
    // ========================================================================================


    // ================================================================
    // =========1 vérifier que la request à bien été soumise===========
    // ================================================================


    // Vérifie si le formulaire a été soumis avec la méthode POST
    // $ : indique une variable en PHP
    // $_SERVER : superglobale contenant des infos sur le serveur et la requête
    // "REQUEST_METHOD" : clé majuscule (convention PHP) → donne la méthode utilisée (GET ou POST)
    // == "POST" : teste si la méthode utilisée est POST (formulaire envoyé)


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ===================================================================
        // ======================2 Récupérer les données======================
        // ===================================================================


        // Récupère le pseudo envoyé en POST, ou une chaîne vide si non défini
        $pseudo = $_POST["pseudo"] ?? '';

        // Récupère le sujet envoyé en POST, ou une chaîne vide si non défini
        $sujet = $_POST["sujet"] ?? '';

        // Récupère le message envoyé en POST, ou une chaîne vide si non défini
        $message = $_POST["message"] ?? '';

        // var_dump($pseudo, $sujet, $message);


        // =======================================================================
        // =======================3 vérifier les données==========================
        // =======================================================================

        // Initialise un tableau vide pour stocker les messages d’erreur
        $errors = [];
        // Vérifie si le pseudo est vide
        if(empty($pseudo)){
        // Ajoute un message d’erreur au tableau
            $errors[] = "Votre pseudo n'est pas renseigner";
        }
        // Vérifie si le sujet est vide
        if(empty($sujet)){
         // Ajoute un message d’erreur au tableau
            $errors[] = "Votre sujet n'est pas renseigner";
        }
        if(empty($message)){
        // Ajoute un message d’erreur au tableau
            $errors[] = "Votre message n'est pas renseigner";
        }
        // Affiche le contenu du tableau d’erreurs (pour déboguer)
        // var_dump($errors);

        // =======================================================================
        // ========================4 Nettoie les données==========================
        // =======================================================================


        if (empty($errors)) {
            $pseudo = htmlspecialchars(trim($pseudo));
            $sujet = htmlspecialchars(trim($sujet));
            $message = htmlspecialchars(trim($message));

            // var_dump("Hello World", $pseudo, $sujet, $message);
        }

        // ==========================================================================
        // =======================5 renvoyer quelque chose===========================
        // ==========================================================================


        // Si aucune erreur n’a été trouvée (le tableau $errors est vide)
        if(empty($errors)) {
            ?>
            
            <!-- Message de confirmation si tout est OK -->
            <div>
                Bonjour <?= $pseudo ?>, nous avons bien pris en compte votre message !
            </div>

            <?php
        }else{
            // Sinon, on parcourt toutes les erreurs pour les afficher une par une
            foreach($errors as $error) {
                ?>
                <!-- Affiche chaque message d’erreur dans un <div> séparé -->
                <div>
                    <span><?= $error ?></span>
                </div>
                
                <?php
            }
        }
    }


    ?>
</body>

</html>