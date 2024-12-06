<?php
// Ensure that the IMAP extension is enabled in your PHP setup
// You can install it by running: sudo apt-get install php-imap
// Then enable it by adding extension=imap to your php.ini file and restarting your server.

// Email server credentials
$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';  // Adjust for your email server
$username = 'wayne.luke@gmail.com';                // Your email address
$password = 'arrv vxyv rwig kilv';                 // Your email password

// Connect to the email server
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to email server: ' . imap_last_error());

// Get the number of emails in the inbox
$emails = imap_search($inbox, 'ALL');

// Initialize an empty array to store unique email addresses
$emailAddresses = [];

// If there are emails, proceed
if ($emails) {
    // Sort emails in reverse order so the latest email appears first
    rsort($emails);

    // Loop through each email
    foreach ($emails as $email_number) {
        // Fetch the email's headers
        $overview = imap_fetch_overview($inbox, $email_number, 0);

        // Extract the "from" field
        $from = $overview[0]->from;

        // Use regex to extract email address from the "from" field
        if (preg_match('/<(.+)>/', $from, $matches)) {
            $email = $matches[1];

            // Add to the list if the email is not already present
            if (!in_array($email, $emailAddresses)) {
                $emailAddresses[] = $email;
            }
        }
    }

    // Display the extracted email addresses
    echo "Extracted email addresses:\n";
    foreach ($emailAddresses as $email) {
        echo $email . "\n";
    }
} else {
    echo "No emails found.\n";
}

// Close the connection to the inbox
imap_close($inbox);
?>