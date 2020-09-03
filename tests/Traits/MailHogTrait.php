<?php

namespace Tests\Traits;

use GuzzleHttp\Client;
use Illuminate\Mail\Mailable;
use PHPUnit\Framework\Assert;

trait MailHogTrait
{
    private $PERIOD_MINUTES = 1;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $mailService;

    /**
     * Setup guzzle client
     */
    public function setupMailTest()
    {
        $this->mailService = (new Client(
            ['base_uri' => config('mailhog.url')]
        ));

        $this->clearEmails();
    }

    /**
     * Get all the emails
     *
     * @return array
     */
    public function getAllEmails()
    {
        return json_decode($this->mailService->get('/api/v1/messages')->getBody());
    }

    /**
     * Get last email sent
     *
     * @return array
     */
    public function getLastEmail()
    {
        $lastEmailId = $this->getAllEmails()[0]->ID;
        $body = json_decode($this->mailService->get('/api/v1/messages/'.$lastEmailId)->getBody());
        $this->sanitizeBody($body->Content->Body);

        return $body;
    }

    /**
     * Get last email sent
     *
     * @return array
     */
    public function getEmailSentTo($email, $subject)
    {
        $lettersCollection = $this->search('to', $email)
            ->filterFromDate(new \DateTime(sprintf('-%d minute', $this->PERIOD_MINUTES)))
            ->filterBySubject($subject);

        return $lettersCollection->getItems()[0]['Content']['Body'];
    }

    /**
     * Delete all emails
     *
     * @return mixed
     */
    public function clearEmails()
    {
        return $this->mailService->delete('/api/v1/messages');
    }

    public function assertNumberOfEmailsSent($numSent)
    {
        $this->assertTrue($numSent === count($this->getAllEmails()));
    }

    /**
     * Assert that email body contains the given string
     *
     * @param string $body
     * @param array  $response
     */
    public function assertEmailBodyContains($body, $response)
    {
        $emailBody = $response->Content->Body;
        // Get rid of strange equals character than can break your tests
        $emailBody = str_replace("=\r\n", "", $emailBody);

        $this->assertContains(
            $body,
            $emailBody
        );
    }

    /**
     * Assert that email subject equals the given string
     *
     * @param string $subject
     * @param array  $response
     */
    public function assertEmailSubjectIs($subject, $response)
    {
        $emailSubject = $response->Content->Headers->Subject;

        $this->assertTrue(
            in_array(
                $subject,
                $emailSubject
            )
        );
    }

    /**
     * Assert that the email was send to given recipient
     *
     * @param string $recipient
     * @param array  $response
     */
    public function assertEmailWasSentTo($recipient, $response)
    {
        $emailRecipient = $response->Content->Headers->To;

        $this->assertTrue(
            in_array(
                $recipient,
                $emailRecipient
            )
        );
    }

    /**
     * Assert that the email was send to given recipient
     *
     * @param string $recipient
     * @param array  $response
     */
    public function assertEmailsSentTo($email, $count)
    {
        $lettersCollection = $this->search('to', $email);
        Assert::assertTrue($lettersCollection->getCount() === $count);
    }

    /**
     * @param string $recipient (comma separated)
     * @param array $response
     */
    public function assetEmailWasCCTo($recipient, $response)
    {
        $emailCC = $response->Content->Headers->Cc;

        $this->assertTrue(
            in_array(
                $recipient,
                $emailCC
            )
        );
    }

    /**
     * @param string $email
     * @param string $subject
     *
     * @throws \Exception
     */
    public function assertEmailSentWithSubject($email, $subject)
    {
        $lettersCollection = $this->search('to', $email)
            ->filterFromDate(new \DateTime(sprintf('-%d minute', $this->PERIOD_MINUTES)))
            ->filterBySubject($subject);
        
        Assert::assertTrue(1 === $lettersCollection->getCount());
    }

    /**
     * @param string $email
     * @param string $subject
     * @param array $bodies
     *
     * @throws \Exception
     */
    public function assertEmailSentWithSubjectAndBody($email, $subject, $body)
    {
        $lettersCollection = $this->search('to', $email)
            ->filterFromDate(new \DateTime(sprintf('-%d minute', $this->PERIOD_MINUTES)))
            ->filterBySubject($subject);

        if (is_array($body)) {
            foreach ($body as $line) {
                $lettersCollection->filterByBody($line);
            }
        } else {
            $lettersCollection->filterByBody($body);
        }

        Assert::assertTrue($lettersCollection->getCount() > 0);
    }

    /**
    * @param string $email
    * @param Mailable $mailable
    *
    * @throws \Exception
    */
    public function assertMailableSentTo($email, Mailable $mailable)
    {
        $content = $mailable->render();

        $lettersCollection = $this->search('to', $email)
            ->filterFromDate(new \DateTime(sprintf('-%d minute', $this->PERIOD_MINUTES)))
            ->filterBySubject($mailable->subject)
            ->filterbyContent($content);

        Assert::assertTrue(1 === $lettersCollection->getCount());
    }

    /**
     * @param string $email
     * @param string $subject
     *
     * @throws \Exception
     */
    public function assertEmailNotSentWithSubjectAndBody($email, $subject, $body)
    {
        $lettersCollection = $this->search('to', $email)
            ->filterFromDate(new \DateTime(sprintf('-%d minute', $this->PERIOD_MINUTES)))
            ->filterBySubject($subject);

        if (is_array($body)) {
            foreach ($body as $line) {
                $lettersCollection->filterByBody($line);
            }
        } else {
            $lettersCollection->filterByBody($body);
        }

        Assert::assertTrue(0 === $lettersCollection->getCount());
    }

    /**
     * @param string $email
     * @param string $subject
     *
     * @throws \Exception
     */
    public function assertEmailNotSentWithSubject($email, $subject)
    {
        $lettersCollection = $this->search('to', $email)
            ->filterFromDate(new \DateTime(sprintf('-%d minute', $this->PERIOD_MINUTES)))
            ->filterBySubject($subject);

        Assert::assertTrue(0 === $lettersCollection->getCount());
    }

    /**
     * @param string $email
     * @param Mailable $mailable
     *
     * @throws \Exception
     */
    public function assertMailableNotSentTo($email, Mailable $mailable)
    {
        $content = $mailable->render();

        $lettersCollection = $this->search('to', $email)
            ->filterFromDate(new \DateTime(sprintf('-%d minute', $this->PERIOD_MINUTES)))
            ->filterBySubject($mailable->subject)
            ->filterbyContent($content);

        Assert::assertTrue(0 === $lettersCollection->getCount());
    }

    public function emailDebug()
    {
        $debug = [];

        foreach ($this->getAllEmails() as $email) {
            $debug[] = [
                'To' => $email->Content->Headers->To,
                'Subject' => $email->Content->Headers->Subject,
                'Date' => $email->Content->Headers->Date,
            ];
        }

        dd($debug);
    }

    /**
     * Searches for messages and return them as array
     *
     * @param string $kind  [from, to, containing]
     * @param string $query
     * @param int    $limit
     * @param int    $start
     *
     * @return MailHogLetterCollection
     */
    private function search($kind, $query, $limit = 50, $start = 0)
    {
        $options = [
            'query' => [
                'kind' => $kind,
                'query' => $query,
                'limit' => $limit,
                'start' => $start,
            ],
        ];

        $response = $this->mailService->get('/api/v2/search', $options);

        $data = json_decode($response->getBody()->getContents(), true);

        return new MailHogLetterCollection($data);
    }

    private function sanitizeBody(string &$body)
    {
        $body = str_replace("=\r\n", "", $body);
    }
}
