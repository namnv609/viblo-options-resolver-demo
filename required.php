<?php

require __DIR__ . "/vendor/autoload.php";

use Symfony\Component\OptionsResolver\OptionsResolver;

class Mailer
{
    private $mailerOptions;
    private $optionsResolver;

    public function __construct(array $options = array())
    {
        $this->optionsResolver = new OptionsResolver;

        $this->optionsResolver
            ->setRequired(array('host', 'port'))
            ->setDefaults(array(
                'username' => 'user',
                'password' => 'pa$$word',
            ));

        $this->mailerOptions = $this->optionsResolver->resolve($options);
    }

    public function getRequiredOptions()
    {
        return $this->optionsResolver->getRequiredOptions();
    }

    public function hostIsRequired()
    {
        return $this->optionsResolver->isRequired('host');
    }

    public function isMissingHost()
    {
        return $this->optionsResolver->isMissing('host');
    }

    public function getMissingOptions()
    {
        return $this->optionsResolver->getMissingOptions();
    }
}

// $mailer = new Mailer();
// PHP Fatal error:  Uncaught exception 'Symfony\Component\OptionsResolver\Exception\MissingOptionsException' with message 'The required options "host", "port" are missing.

$mailer = new Mailer(array(
    'host' => 'gmail.com',
    'port' => '587'
));

var_dump($mailer->getRequiredOptions());
var_dump("Host is required: " . $mailer->hostIsRequired() . PHP_EOL);
var_dump("Port is missing: " . $mailer->isMissingHost() . PHP_EOL);
var_dump($mailer->getMissingOptions());
