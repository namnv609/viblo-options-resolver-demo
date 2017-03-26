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
        ));

        $this->mailerOptions = $optionsResolver->resolve($options);
    }
}

$mailer = new Mailer(array(
    'usernme' => 'lorem'
));
