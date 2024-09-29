<?php
namespace App\Services;
use App\Models\TokenModel;
use App\Models\AccountModel;
use DateTime;

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
    public function generateToken() {
        $token = bin2hex(random_bytes(15));

        // Return the generated token so it can be used in the email.
        return $token;
    }

    /**
     * 
     * Checks if the user has a valid token in the database.
     * Returns one of the following:
     * NT - No token exists
     * TE - Token has expired
     * TV - Token is valid
     * 
     * @param int $user_id
     */
    public function checkToken($user_id) {
        $token = $this->tokenModel->checkActiveToken($user_id);
        
        // If no token exists, return false
        if (!$token) {
            return "NT";
        }
            
        $now = new DateTime();
        $expires_at = new DateTime($token['expires_at']);
        // If token has expired, return false
        if ($expires_at < $now) {
            echo ($expires_at < $now);
            return "TE";
        }

        return "TV";
    }

    public function saveToken($user_id, $token) {

        $tokenMade = date('Y-m-d H:i:s');
        $tokenExpires = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        // Check if the user already has a token that is active.
        $hasToken = $this->checkToken($user_id);


        // Result could be sent back as JSON to the controller?
        if ($hasToken == "NT") {
            $saveSuccess = $this->tokenModel->insertToken($user_id, $token, $tokenMade, $tokenExpires);
        } else {
            $saveSuccess = $this->tokenModel->updateToken($user_id, $token, $tokenMade, $tokenExpires);
        }

        if ($saveSuccess) {
            // http_response_code(200);
            return json_encode(["status" => "success", "message" => "Token saved successfully"]);
            // return true;
        } else {
        //     http_response_code(500);
            return json_encode(["status" => "error", "message" => "Error saving token."]);
            // return false;
        }
    }


    public function get_token($user_id) {
        return $this->tokenModel->getToken($user_id);
    }


    /**
     * Verifys the users email using the token they have provided in the URL.
     * 
     * @param string $user_id, $providedToken
     */
    public function isValidToken($user_id, $providedToken) {
        
        if (!$providedToken || !$user_id) {
            return "err_no_token_provided";
        }
        
        $verificationToken = $this->get_token($user_id);
        if (!$verificationToken) {
            return "err_no_token";
        }

        // Check if the token has expired
        $tokenStatus = $this->checkToken($user_id);
        if (!$tokenStatus == "TV") {
            return "err_token_expired";
        }


        // die($providedToken .  " ||| " . $verificationToken);
        if ($providedToken != $verificationToken) {
            return "err_invalid_token";
        }

        return "valid_token";
    }


    /**
     * Sends an email to the user with a token to verify their email address. !SHOULD BE MOVED TO OWN SERVICE
     * 
     * @param int $user_id
     * @param string $user_email
     * @param string $token
     */
    // public function sendEmailVerificationToken($user_id, $user_email, $token) {

    //     // Set the last time the email was sent.
    //     // This is used to prevent spamming of emails.
    //     $last_email = $_SESSION["last_verification_email"] ?? null;
        
    //     // Check if the last email was sent with at least 90 seconds between the next email.
    //     // TODO: Move to own function and pass in the seconds as a parameter.
    //     $seconds = 5;
    //     if($last_email && $last_email > time() - $seconds) {
    //         $timeRemaining = $seconds - (time() - $last_email);
    //         return json_encode(["status" => "error", "message" => "Please wait $timeRemaining seconds before sending another email."]);
    //     }

    //     $_SESSION["last_verification_email"] = time();

    //     // Prepare the email template
    //     $emailTemplate = file_get_contents(__DIR__ . '/../Views/emails/verifyEmail.html');
    //     $emailTemplate = str_replace("{user_id}", $user_id, $emailTemplate);
    //     $emailTemplate = str_replace("{token}", $token, $emailTemplate);

    //     // Send the email to the user.

    //     $resend = Resend::client($_ENV["RESEND_API_KEY"]);
    //     try {
    //         $resend->emails->send([
    //             'from' => 'server@yourpet.callumc.net',
    //             'to' => $user_email,
    //             'subject' => 'YourPet - Verify Your Email Address',
    //             'html' => $emailTemplate,
    //         ]);
    //         return json_encode(["status" => "success", "message" => "Email sent successfully"]);

    //     } catch (Exception $e) {
    //         $error = $e->getMessage();
    //         echo $error;
    //         return json_encode(["status" => "error", "message" => "Error sending email"]);
    //     }
    // }



}