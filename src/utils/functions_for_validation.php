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
        setSessionAttributeAndRedirect('lastname_invalid', '/tickets/register');
    } else if($firstname != "" && !preg_match("/^[A-Za-z]{1,100}$/", $firstname)){
        setSessionAttributeAndRedirect('firstname_invalid', '/tickets/register');
    }
}

function validateEmailAndPossiblyUsername($email, $username = null, $headerLocation = '/tickets/register'): void {
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        setSessionAttributeAndRedirect('email_invalid', $headerLocation);
    } else if($username != null && !preg_match("/^[A-Za-z0-9#_.]{3,20}$/", $username)){
        setSessionAttributeAndRedirect('username_invalid', $headerLocation);
    }
}

function validateNewEmail($newEmail, $confirmedNewEmail): void{
    if(!empty($newEmail)){
        if($newEmail !== $confirmedNewEmail){
            setSessionAttributeAndRedirect('newEmail_not_matching', '/tickets/profile');
        } else if($newEmail === $_SESSION['email']){
            setSessionAttributeAndRedirect('email_the_same', '/tickets/profile');
        } else validateEmailAndPossiblyUsername($newEmail, null, '/tickets/profile');
    }
}

function validateProfileUpdatePasswordFields($password, $user, $newPassword = null, $confirmedNewPassword = null): void{
    if(!empty($newPassword) && $newPassword !== $confirmedNewPassword){
        setSessionAttributeAndRedirect('newpassword_confirm_not_matching', '/tickets/profile');
    }
    if(!password_verify($password, $user->getPassword())){
        setSessionAttributeAndRedirect('invalid_credentials', '/tickets/profile');
    }
}
function checkCSRFtoken(): void{
    if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])){
        setSessionAttributeAndRedirect('csrf_attack', '/tickets/');
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
