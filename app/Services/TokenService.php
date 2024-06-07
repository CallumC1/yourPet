<?php

class TokenService {

    private $tokenModel;
    private $accountModel;

    public function __construct() {
        $this->tokenModel = new TokenModel();
        $this->accountModel = new AccountModel();
    }

    /**
     * Generates a token for the user to verify their email
     * Creates a new token if the user does not have one, otherwise updates the existing token.
     * 
     * Eventually this will send an email to the user with a link to verify their email.
     * And the token will be deleted once the email is verified or after a certain amount of time.
     * 
     * @param int $user_id
     * 
     * @return string $token
     */
    public function generateToken($user_id) {
        $token = bin2hex(random_bytes(15));

        // Return the generated token so it can be used in the email.
        return $token;
    }

    public function saveToken($user_id, $token) {
        $hasToken = $tokenModel->checkActiveToken($user_id);

        if ($hasToken) {
            $saveSuccess = $this->tokenModel->updateToken($user_id, $token);
        } else {
            $saveSuccess = $this->tokenModel->insertToken($user_id, $token);
        }

        // If the token was not inserted, return an error
        if (!$saveSuccess) {
            return false;
        }

        return true;
    }



    /**
     * Verifys the users email using the token they have provided in the URL.
     * 
     * @param string $user_id, $providedToken
     */
    public function verifyToken($user_id, $providedToken) {
        
        if (!$providedToken || !$user_id) {
            echo "No token provided or user id is not found";
            exit();
        }
        
        $verificationToken = $this->tokenModel->getToken($user_id);
        if (!$verificationToken) {
            echo "Token not found";
            exit();
        }

        if ($providedToken != $verificationToken) {
            echo "Token does not match";
            exit();
        }

        $userVerified = $this->accountModel->verifyUserEmail($user_id);
        if (!$userVerified) {
            echo "Error verifying user, please contact our support team.";
            return false;
        }

        return true;
    }


    /**
     * Sends an email to the user with a token to verify their email address. !SHOULD BE MOVED TO OWN SERVICE
     * 
     * @param int $user_id
     * @param string $user_email
     * @param string $token
     */
    public function sendEmailVerificationToken($user_id, $user_email, $token) {

        // Prepare the email template
        $emailTemplate = file_get_contents(__DIR__ . '/../Views/emails/verifyEmail.html');
        $emailTemplate = str_replace("{user_id}", $user_id, $emailTemplate);
        $emailTemplate = str_replace("{token}", $token, $emailTemplate);

        // Send the email to the user.
        $resend = Resend::client('token');
        $resend->emails->send([
            'from' => 'server@yourpet.callumc.net',
            'to' => $user_email,
            'subject' => 'YourPet - Verify Your Email Address',
            'html' => $emailTemplate,
        ]);

        // Check if the email was sent successfully
        if ($resend->success) {
            return true;
        } else {
            return false;
        }
    }





}