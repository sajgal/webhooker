<?php namespace Webhook;

class Hook
{
    private $rawPayload;
    private $githubSecretKey;
    private $branch = 'master';
    private $repository = 'origin';

    public function __construct($githubSecretKey)
    {
        $this->rawPayload = file_get_contents('php://input');
        $this->githubSecretKey = $githubSecretKey;
    }

    public function validateSignature()
    {
        if (!array_key_exists('HTTP_X_HUB_SIGNATURE', $_SERVER)) {
            throw new Exception('Missing X-Hub-Signature header.');
        }

        return 'sha1=' . hash_hmac('sha1', $this->rawPayload, $this->githubSecretKey, false) === $_SERVER['HTTP_X_HUB_SIGNATURE'];
    }

    public function getPayload()
    {
        return json_decode($this->rawPayload);
    }

    public function pull()
    {
        $branch = $this->getBranch();
        $repository = $this->getRepository();
        $cwd = getcwd();

        $commands = array();
        $commands[] = sprintf('cd %s', $cwd);
        $commands[] = sprintf('git pull %s %s', $repository, $branch);

        return shell_exec(implode(';', $commands));
    }

    /**
     * @param string $branch
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;
    }

    /**
     * @return string
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * @return string
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param string $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }
}