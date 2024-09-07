<?php

class EmailService {

    private $tokenService;

    public function __construct() {
        $this->tokenService = new TokenService();
    }

    public function sendEmailVerificationToken($user_id, $user_email, $token) {

        // Prepare the email template
        $emailTemplate = file_get_contents(__DIR__ . '/../Views/emails/verifyEmail.html');
        $emailTemplate = str_replace("{user_id}", $user_id, $emailTemplate);
        $emailTemplate = str_replace("{token}", $token, $emailTemplate);

    

        // Send the email to the user.

        $resend = Resend::client($_ENV["RESEND_API_KEY"]);
    
        try {
            $resend->emails->send([
                'from' => 'server@yourpet.callumc.net',
                'to' => $user_email,
                'subject' => 'YourPet - Verify Your Email Address',
                'html' => $emailTemplate,
            ]);
            return json_encode(["status" => "success", "message" => "Email sent successfully"]);

        } catch (Exception $e) {
            $error = $e->getMessage();
            return json_encode(["status" => "error", "message" => "Error sending email"]);
        }

    }

    public function resendEmailToken() {
        $user_id = $_SESSION["user_data"]["id"];

        $hasToken = $this->tokenService->checkToken($user_id);
        
        // If token is valid, no need to generate a new token, but we do need to resend the email.
        if ($hasToken == "TV") {
            $token = $this->tokenService->get_token($user_id);
            $sendResponse = $this->sendEmailVerificationToken($user_id, $_SESSION["user_data"]["email"], $token);
            return "success";
        }

        
        $generatedToken = $this->tokenService->generateToken();
        $saveTknResponse = $this->tokenService->saveToken($user_id, $generatedToken);
        
        $saveTknResponseObj = json_decode($saveTknResponse);
        var_dump($saveTknResponseObj);

  

        if ($saveTknResponseObj->status == "success") {
            $sendResponse = $this->sendEmailVerificationToken($user_id, $_SESSION["user_data"]["email"], $generatedToken);
            return "success";
        } else {
            return "error";
        }

    } 



    

}