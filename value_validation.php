<?php

require __DIR__ . "/vendor/autoload.php";

use Symfony\Component\OptionsResolver\OptionsResolver;

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
            'transport' => 'sendmail'
        ))
        ->setAllowedValues('transport', array('smtp', 'mail', 'sendmail'))
        ->setAllowedValues('host', function($hostValue) {
            return preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $hostValue);
        });

        $this->mailerOptions = $optionsResolver->resolve($options);
    }
}

// $mailer = new Mailer(array(
//     'transport' => 'send-mail',
// ));

// PHP Fatal error:  Uncaught exception 'Symfony\Component\OptionsResolver\Exception\InvalidOptionsException' with message 'The option "transport" with value "send-mail" is invalid. Accepted values are: "smtp", "mail", "sendmail".'

$mailer = new Mailer(array(
    'host' => '12.34',
));
