<?php

namespace Learner\Services\Newsletter;

use Newsletter as News;

class Newsletter
{
    /**
     * Add a email to list
     *
     * @param  string $email
     *
     * @return mixed
     */
    public function subscribe($email)
    {
        return News::subscribe($email);
    }

    /**
     * Add a email from list
     *
     * @param  string $email
     *
     * @return mixed
     */
    public function unsubscribe($email)
    {
        return News::unsubscribe($email);
    }

    /**
     * Send a newsletter.
     *
     * @param  string $subject
     * @param  string $contents
     *
     * @return associative_array with a single entry:
     *     - complete bool whether the call worked. reallistically this will always be true as errors will be thrown otherwise.
     */
    public function send($subject, $contents)
    {
        $compaign = News::createCampaign($subject, $contents);

        return News::getApi()->campaigns->send($compaign['id']);
    }
}
