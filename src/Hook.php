<?php namespace Webhook;

use Nette\Neon\Neon;

class Hook
{
    private $rawPayload;
    private $githubSecretKey;
    private $branch = 'master';
    private $repository = 'origin';

    public function __construct()
    {
        $this->rawPayload = file_get_contents('php://input');
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isValidSignature()
    {
        if (!array_key_exists('HTTP_X_HUB_SIGNATURE', $_SERVER)) {
            throw new \Exception('Missing X-Hub-Signature header.');
        }

        if (empty($this->githubSecretKey)) {
            throw new \Exception('Git Hub Secret Key not set.');
        }

        return 'sha1=' . hash_hmac('sha1', $this->rawPayload, $this->githubSecretKey, false) === $_SERVER['HTTP_X_HUB_SIGNATURE'];
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return json_decode($this->rawPayload);
    }

    /**
     * @return string
     */
    public function pull()
    {
        $branch = $this->getBranch();
        $repository = $this->getRepository();
        $cwd = getcwd();

        $commands = array();
        $commands[] = sprintf('cd %s', $cwd);
        $commands[] = sprintf('git pull %s %s', $repository, $branch);

        $commandString = implode('; ', $commands);

        $result = shell_exec($commandString . " 2>&1");

        return $result;
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

    public function setConfigFile($configFile)
    {
        if(!file_exists($configFile)) {
            throw new \Exception('Config file does not exists.');
        }

        $config = (new Neon)->decode(file_get_contents($configFile));

        if(!isset($config['github']['secret']) || empty($config['github']['secret'])) {
            throw new \Exception('Config file does not contain github secret key.');
        }

        $this->githubSecretKey = $config['github']['secret'];
    }

    public function setGithubSecret($githubSecretKey)
    {
        $this->githubSecretKey = $githubSecretKey;
    }
}