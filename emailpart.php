<?php
// Simple mail handler for contact form

// Set your email
$to = "bartfaipeti@gmail.com";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = isset($_POST["name"]) ? trim($_POST["name"]) : "";
    $email   = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $package = isset($_POST["package"]) ? trim($_POST["package"]) : "";
    $subject = isset($_POST["subject"]) ? trim($_POST["subject"]) : "New inquiry from website";
    $message = isset($_POST["message"]) ? trim($_POST["message"]) : "";

    if ($name === "" || $email === "" || $message === "") {
        die("Missing required fields.");
    }

    $packageText = "";
    switch ($package) {
        case "basic":
            $packageText = "Alap csomag / Basic Package – 160.000 Ft / hó";
            break;
        case "medium":
            $packageText = "Közepes csomag / Medium Package – 250.000 Ft / hó";
            break;
        case "pro":
            $packageText = "Pro csomag / Pro Package – 350.000 Ft / hó";
            break;
        case "custom":
        default:
            $packageText = "Egyedi igény / Custom request";
            break;
    }

    $body = "New message from your social media website:\n\n"
          . "Name / Név: " . $name . "\n"
          . "Email: " . $email . "\n"
          . "Selected package / Választott csomag: " . $packageText . "\n"
          . "Subject / Tárgy: " . $subject . "\n\n"
          . "Message / Üzenet:\n" . $message . "\n";

    $headers = "From: " . $name . " <" . $email . ">\r\n" .
               "Reply-To: " . $email . "\r\n" .
               "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, "Új megkeresés a weboldalról: " . $subject, $body, $headers)) {
        echo "Köszönöm az üzeneted! Hamarosan jelentkezem. / Thank you for your message! I will get back to you soon.";
    } else {
        echo "Hiba történt az üzenet küldése közben. / There was an error sending your message.";
    }
} else {
    echo "Invalid request.";
}
?>