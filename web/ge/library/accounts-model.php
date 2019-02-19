<?php

function regVisitor($firstname, $lastname, $email, $password, $hash) {
    $db = dbConnect();
    $sql = 'INSERT INTO clients (client_hash, clientFirstName, clientLastName,
           clientEmail, clientPassword, created_at)
           VALUES (:client_hash, :firstname, :lastname, :email, :password, :created_at) RETURNING id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':client_hash', $hash, PDO::PARAM_STR);
    $stmt->bindValue(':created_at', date("Y-m-d H:i:s"), PDO::PARAM_STR);
    $stmt->execute();
    $user_id = $db->lastInsertId();
    $stmt->closeCursor();
        
    return ['success' => $user_id ? true : false, 'user_id' => $user_id];
}

function checkExistingEmail($email) {
    $db = dbConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchEmail)) {
        return 0;
    } else {
        return 1;
    }
}

function hashEmail($email) {
    if($email)
        return hash('md5', 'gm'.$email.'escape');
    else
        return [];
}

function verifyPassPhrase($passphrase){
    $db = dbConnect();
    $sql = 'SELECT reg_pass FROM registration WHERE reg_pass = :passphrase';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':passphrase', $passphrase, PDO::PARAM_STR);
    $stmt->execute();
    $matchPhrase = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchPhrase)) {
        return 0;
    } else {
        return 1;
    }
}

function getClient($email) {
    $db = dbConnect();
    $sql = 'SELECT id, clientFirstName, clientLastName, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}

function updateAccount($clientFirstname, $clientLastname, $email, $clientId) {
    $db = dbConnect();
    $sql = 'UPDATE clients SET clientFirstName = :clientFirstName, clientLastName = :clientLastName, clientEmail = :clientEmail, clientId = :clientId WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientFirstName', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastName', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $email, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function updatePassword($clientPassword, $clientId) {
    $db = dbConnect();
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function findEmail($email){
    $db = dbConnect();
    $sql = 'SELECT client_hash FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $client_hash = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    if($client_hash)
        return sendRecoveryEmail($client_hash['client_hash'], $email);
}
function validateEmailHash($email_hash){
    $db = dbConnect();
    $sql = 'SELECT client_hash FROM password_reset WHERE email_hash = :email_hash';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email_hash', $email_hash, PDO::PARAM_STR);
    $stmt->execute();
    $client_hash = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    if(is_array($client_hash)){
        return $client_hash;
    }else{
        return [];
    }
}

function getClientByHash($client_hash){
    $db = dbConnect();
    $sql = 'SELECT clientId FROM clients WHERE client_hash = :client_hash';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':client_hash', $client_hash, PDO::PARAM_STR);
    $stmt->execute();
    $client_id = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $client_id;
}

function checkEmail($email) {
    $sanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $valEmail = filter_var($sanEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($password, $verify_password = '') {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    $password_valid = preg_match($pattern, $password);
    if(!$verify_password && $password_valid)
        return ['success' => true];
    $verify_password_valid = preg_match($pattern, $verify_password);
    if($password_valid && $verify_password_valid){
        $passwords_match = $password == $verify_password;
        if($passwords_match)
            return ['success' => true];
        else
            return ['success' => false, 'message' => 'Passwords do not match. Please check your passwords and try again.'];
    }else{
        return ['success' => false, 'message' => 'Password does not meet the criteria. Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.'];
    }

}

