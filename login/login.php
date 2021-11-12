<?php
require('../auth.php');

if (!empty($_POST['_token'])) {
    $host = "{" . $_POST['host'] . ":" . $_POST['port'] . "/"
        . $_POST['mode'] . "/" . $_POST['encryption'] . "}INBOX";
    echo $host;
    if (!function_exists('imap_open')) {
        echo "IMAP is not configured.";
        exit();
    } else {
        /* Connecting Gmail server with IMAP */
        $conn = imap_open($host, $_POST['email'], $_POST['password']) or die('Cannot connect to Gmail: ' . imap_last_error());

        // $MC = imap_check($conn);

        /* Search Emails having the specified keyword in the email subject */
        $mails = imap_search($conn, "ALL");
        $subjects = array();
        $messages = array();
        $messageExcerpts = array();
        $partialMessages = array();
        $dates = array();
        $result = array();
        if (!empty($mails)) {
            rsort($mails);
            $i = 0;
            foreach ($mails as $mail) {
                if ($i > 20) {
                    break;
                }
                $overview = imap_fetch_overview($conn, $mail, 0);
                $date = date("d F, Y", strtotime($overview[0]->date));

                $message = imap_body($conn, $mail, 0);

                $result[$i] = array(
                    'subject' => $overview[0]->subject,
                    'from' => $overview[0]->from,
                    'to' => $overview[0]->to,
                    'date' => $date,
                    'message' => $message
                );
                $i++;
            } // End foreach
        } // end if
        imap_close($conn);
    }
    echo json_encode($message)."<br/>";
    echo $result[0]['message'];
}
