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
        $emails = imap_search($conn, 'FROM "*@gmail.com"');
        /* if emails are returned, cycle through each... */

        $result = array();

        if ($emails) {
            /* begin output var */
            $output = '';
            /* put the newest emails on top */
            rsort($emails);
            /* for every email... */
            $i = 0;
            foreach ($emails as $email_number) {
                /* get information specific to this email */
                $overview = imap_fetch_overview($conn, $email_number, 0);
                $message = imap_fetchbody($conn, $email_number, 2);
                /* output the email header information */
                $output .= '<div class="toggler ' . ($overview[0]->seen ? 'read' : 'unread') . '">';
                $output .= '<span class="subject">' . $overview[0]->subject . '</span> ';
                $output .= '<span class="from">' . $overview[0]->from . '</span>';
                $output .= '<span class="date">on ' . $overview[0]->date . '</span>';
                $output .= '</div>';

                $result[$i] = array(
                    'seen' => ($overview[0]->seen ? 'read' : 'unread'),
                    'subject' => $overview[0]->subject,
                    'from' => $overview[0]->from,
                    'date' => $overview[0]->date,
                    'message' => $message,
                );

                /* output the email body */
                $output .= '<div class="body">' . $message . '</div>';
                if (++$i == 20) {
                    break;
                }
            }
            
        }
        imap_close($conn);
    }
    // echo json_encode($message)."<br/>";
    header("Location: /",);
}
