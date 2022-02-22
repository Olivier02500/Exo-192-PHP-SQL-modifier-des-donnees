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
$pass = '';
$db = 'bdd_cours';




try {
    $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pass);
    $maConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = 'Parker';
    $fname = 'Peter';
    $rue = 'jump street';
    $num = 80;
    $code = 1234;
    $ville = 'los santos';
    $pays = 'USA';
    $mail = 'spiderman@us.fr';

    $newuser = $maConnexion->prepare( "
    INSERT INTO user (nom ,prenom ,rue ,numero , code_postal ,ville ,pays ,mail)
    VALUES (:nom ,:prenom ,:rue ,:numero ,:codepostal ,:ville ,:pays ,:mail)
    ");

    $newuser ->bindParam(':nom' ,$name);
    $newuser ->bindParam(':prenom' ,$fname);
    $newuser ->bindParam(':rue' ,$rue);
    $newuser ->bindParam(':numero' ,$num, PDO::PARAM_INT);
    $newuser ->bindParam(':codepostal' ,$code, PDO::PARAM_INT);
    $newuser ->bindParam(':ville' ,$ville);
    $newuser ->bindParam(':pays' ,$pays);
    $newuser ->bindParam(':mail' ,$mail);

    $name = 'spiderMan';

    $newuser->execute();

    echo "l'Utilisateur a était ajouté !!";



}
catch (PDOException $exception) {
    echo $exception->getMessage();
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