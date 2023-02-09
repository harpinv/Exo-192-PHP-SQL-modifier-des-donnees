<?php
/**
 * 1. Le dossier SQL contient l'export de ma table user.
 * 2. Trouvez comment importer cette table dans une des bases de données que vous avez créées, si vous le souhaitez vous pouvez en créer une nouvelle pour cet exercice.
 * 3. Assurez vous que les données soient bien présentes dans la table.
 * 4. Créez votre objet de connexion à la base de données comme nous l'avons vu
 * 5. Insérez un nouvel utilisateur dans la base de données user
 * 6. Modifiez cet utilisateur directement après avoir envoyé les données ( on imagine que vous vous êtes trompé )
 */

// TODO Votre code ici.
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'bdd_cours';

function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = addslashes($data);
    return $data;
}

try {

    $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $password);
    $maConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nom = sanitize('Matte');
    $prenom = sanitize('Marmotte');
    $rue = sanitize('Rue du tiffon');
    $numero = sanitize('4');
    $code_postal = sanitize('59610');
    $ville = sanitize('Fourmies');
    $pays = sanitize('France');
    $mail = sanitize('m.marmotte@gmail.com');


    $user = $maConnexion->prepare("
         INSERT INTO utilisateur (nom, prenom, rue, numero, code_postal, ville, pays, mail)
         VALUES (:Matte, :Marmotte, :Rue du tiffon, :4, :59610, :Fourmies, :France, :m.marmotte@gmail.com)
    ");

    $user->bindParam(':Matte', $nom);
    $user->bindParam(':Marmotte', $prenom);
    $user->bindParam(':Rue du tiffon', $rue);
    $user->bindParam(':4', $numero);
    $user->bindParam(':59610', $code_postal,PDO::PARAM_INT);
    $user->bindParam(':Fourmies', $vlle);
    $user->bindParam(':France', $pays);
    $user->bindParam(':m.marmotte@gmail.com', $mail);

    $result = $maConnexion->exec($user);
    echo $result;

    $user = $maConnexion->prepare("
         UPDATE user SET nom = :marc WHERE id = :4
    ");

    $user->bindParam(':4', $id);
    $user->bindParam(':Marc', $nom);

    $result = $maConnexion->exec($user);
    echo $result;
}
catch (PDOException $exception) {
    echo "Erreur de connexion: " . $exception->getMessage();
}



/**
 * Théorie
 * --------
 * Pour obtenir l'ID du dernier élément inséré en base de données, vous pouvez utiliser la méthode: $bdd->lastInsertId()
 *
 * $result = $bdd->execute();
 * if($result) {
 *     $id = $bdd->lastInsertId();
 * }
 */