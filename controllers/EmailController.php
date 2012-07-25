<?php

class EmailController { 

    public function validate($email) {
        // This regex courtesy of Arluison Guillaume
        // http://www.mi-ange.net/blog/msg.php?id=79&lng=en
        // Found via http://fightingforalostcause.net/misc/2006/compare-email-regex.php
        $regex = "/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i"; 
        return preg_match($regex, $email);
    }

    public function savePage() {
        global $app, $siteName, $siteUrl;

        $args = func_get_args();

        $in = array();
        if (count($args) == 5) {
            list($email, $school, $campus, $term, $ids) = $args;
        } else {
            list($email, $school, $term, $ids) = $args;
            $campus = null;
        }

        if (!$this->validate($email)) {
            echo "false";
            return;
        }

        $in['school'] = $school;
        $in['campus'] = $campus;
        $in['term'] = $term;
        $in['ids'] = htmlspecialchars($ids);

        if (!$school || $school == 'isbn') {
            $route = 'isbn_results'; 
        } else if ($campus) {
            $route = 'multicampus_results';
        } else {
            $route = 'singlecampus_results';
        }

        $url = $app->request()->getUrl() . $app->urlFor($route, $in) . '?saved';

        $numItems = count(explode(SECTION_DELIMITER, $ids));

        $numWithRegularNoun = function ($num, $noun) {
            return ($num > 1 ? cardinal($num) . ' ': '') . $noun . ($num > 1 ? 's' : '');
        };

        if ($school == 'isbn') {
            $yourX = "your " . $numWithRegularNoun($numItems, 'book');
        } else if ($school = SchoolQuery::create()->findOneBySlug($school)) {
            $schoolName = $school->getName();
            $yourX = "all your books for your " . $numWithRegularNoun($numItems, 'course') . " at $schoolName";
        } else {
            echo "false";
            return;
        }

        $date = date('l, F j');

        $subject = "Your Textbooks at $siteUrl";
        $body = <<<END
Hey there,

Here's a link to $yourX:

$url

Use that link at any time to come back to $siteName and find the lowest prices for your textbooks.

Have a great semester! We'll see you soon.
--
You're receiving this email because on $date, someone visited $siteUrl and requested an email reminder with a link to their textbooks. If you feel you received this message in error, let us know by replying to this message. We'll make sure it doesn't happen again.
END;

        try {
            $this->sendMail($email, $subject, $body);

            echo "true";
        } catch (Exception $e) {
            echo "false";
            throw $e;
        }

    }

    public function sendPage() {
        global $app, $siteName, $siteUrl;

        $args = func_get_args();

        if (count($args) == 6) {
            list($fromEmail, $toEmail, $school, $campus, $term, $id) = $args;
        } else {
            $campus = null;
            list($fromEmail, $toEmail, $school, $term, $id) = $args;
        }

        if (!($this->validate($fromEmail) && $this->validate($toEmail))) {
            echo "false";
            return;
        }

        $s = SectionQuery::create()
            ->filterBySlug($id)
            ->filterByTermSlug($term);

        if ($campus) {
            $s->filterByCampusSlug($campus);
        }
        $s = $s->filterBySchoolSlug($school)
            ->findOne();

        $courseName = $s->getName();
        $subject = "Textbooks for $courseName";

        $in['ids'] = $id;
        $in['school'] = $school;
        $in['campus'] = $campus;
        $in['term'] = $term;
        
        if (!$school || $school == 'isbn') {
            $route = 'isbn_results'; 
        } else if ($campus) {
            $route = 'multicampus_results';
        } else {
            $route = 'singlecampus_results';
        }
   
        $url = $app->request()->getUrl() . $app->urlFor($route, $in) . '?saved';

        $date = date('l, F j');

        $body = <<<END
$fromEmail has sent you a link to view all of the textbooks for $courseName on $siteName:

$url

$siteName is a free, student-run service that finds college students' textbooks at the cheapest prices. You tell us your courses and we'll find your books at the lowest prices. It's that easy.
--
You're receiving this email because on $date, someone visited $siteUrl and told us you'd like a link to this course's books. If you feel you received this message in error, let us know by replying to this message. We'll make sure it doesn't happen again.
END;

        try {
            $this->sendMail($toEmail, $subject, $body, $fromEmail, $fromEmail);

            echo "true";
        } catch (Exception $e) {
            echo "false";
            throw $e;
        }

    }

    function contactUs($input) {
        echo "true";
    }

    /** Sends an email using the GetchaBooks automatiler account
     * TODO: optionally set the sender name/email (for single course tell a friend) */
    function sendMail($to, $subject, $body, $fromAddress=false, $fromName=false) {
        global $gbMailer, $mailerFrom, $siteName;

        $gbMailer->From = $fromAddress ?: $mailerFrom;
        $gbMailer->FromName = $fromName ?: $siteName;

        $gbMailer->AddAddress($to);
        $gbMailer->Subject = $subject;
        $gbMailer->Body = $body;
        $gbMailer->Send();
    }
}
