<?php

class EmailService {

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
            echo $error;
            return json_encode(["status" => "error", "message" => "Error sending email"]);
        }

    }



    

}