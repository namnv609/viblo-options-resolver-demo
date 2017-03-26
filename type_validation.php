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

        $this->optionsResolver->setDefaults(array(
            'host'     => 'smtp.example.org',
            'username' => 'user',
            'password' => 'pa$$word',
            'port'     => 25,
        ))->setAllowedTypes('port', 'int');

        $this->mailerOptions = $this->optionsResolver->resolve($options);
    }
}

$mailer = new Mailer(array(
    'port' => '25'
));

// PHP Fatal error:  Uncaught exception 'Symfony\Component\OptionsResolver\Exception\InvalidOptionsException' with message 'The option "port" with value "25" is expected to be of type "int", but is of type "string".'
