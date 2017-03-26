<?php

require __DIR__ . "/vendor/autoload.php";

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;

class Mailer
{
    private $mailerOptions;

    public function __construct(array $options = array())
    {
        $optionsResolver = new OptionsResolver;

        $optionsResolver->setDefaults(array(
            'host'     => 'smtp.example.org',
            'username' => 'user',
            'password' => 'pa$$word',
            'port'     => 25,
        ))->setNormalizer('host', function(Options $options, $hostValue) {
            if (!preg_match('/^https?\:\/\//', $hostValue)) {
                $hostValue = "http://" . $hostValue;
            }

            return $hostValue;
        });

        $this->mailerOptions = $optionsResolver->resolve($options);
    }

    public function getMailerOptions()
    {
        return $this->mailerOptions;
    }
}

$mailer = new Mailer(array(
    'host' => 'https://gmail.com',
));
var_dump($mailer->getMailerOptions());
