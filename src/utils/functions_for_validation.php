<?php
function checkIfFieldsAreEmpty(): bool {
    $args = func_get_args();

    foreach ($args as $arg){
        if(empty($arg)){
            return true;
        }
    }
    return false;
}

function validateName($lastname, $firstname): void {
    if($lastname != "" && !preg_match("/^[A-Za-z]{1,100}$/", $lastname)){
        setSessionAttributeAndRedirect('lastname_invalid', '/register');
    } else if($firstname != "" && !preg_match("/^[A-Za-z]{1,100}$/", $firstname)){
        setSessionAttributeAndRedirect('firstname_invalid', '/register');
    }
}

function validateEmailAndPossiblyUsername($email, $username = null, $headerLocation = '/register'): void {
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        setSessionAttributeAndRedirect('email_invalid', $headerLocation);
    } else if($username != null && !preg_match("/^[A-Za-z0-9#_.]{3,20}$/", $username)){
        setSessionAttributeAndRedirect('username_invalid', $headerLocation);
    }
}

function validateNewEmail($newEmail, $confirmedNewEmail, $entityManager): void{
    if(!empty($newEmail)){
        if($newEmail !== $confirmedNewEmail){
            setSessionAttributeAndRedirect('newEmail_not_matching', '/profile');
        } else if($newEmail === $_SESSION['email']){
            setSessionAttributeAndRedirect('email_the_same', '/profile');
        } else if($entityManager->getRepository(User::class)->findOneBy(['email' => $newEmail]) != null){
            setSessionAttributeAndRedirect('not_available', '/profile');
        } else validateEmailAndPossiblyUsername($newEmail, null, '/profile');
    }
}

function validateProfileUpdatePasswordFields($password, $user, $newPassword = null, $confirmedNewPassword = null): void{
    if(!empty($newPassword) && $newPassword !== $confirmedNewPassword){
        setSessionAttributeAndRedirect('newpassword_confirm_not_matching', '/profile');
    }
    if(!password_verify($password, $user->getPassword())){
        setSessionAttributeAndRedirect('invalid_credentials', '/profile');
    }
}
function checkCSRFtoken(): void{
    if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])){
        setSessionAttributeAndRedirect('csrf_attack', '/');
    }
}

function setSessionAttributeAndRedirect($attribute, $headerLocation, $message = null): void {
    $_SESSION[$attribute] = $message ?: true;
    header('Location: ' . $headerLocation);
    exit;
}

function validateDate($date, $format = 'Y-m-d'): bool{
    $d = DateTime::createFromFormat($format, $date);
    $currentDate = new DateTime();
    $currentDate->setTime(0, 0, 0);

    return $d && $d->format($format) == $date && $d > $currentDate;
}

function validateTime($time, $format = 'H:i'): bool{
    $t = DateTime::createFromFormat($format, $time);
    return $t && $t->format($format) == $time;
}
