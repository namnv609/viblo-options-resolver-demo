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
            'port' => 25
        ))->setDefined(array('host', 'username', 'password'));

        $this->mailerOptions = $this->optionsResolver->resolve($options);
    }

    public function transportIsDefined()
    {
        return $this->optionsResolver->isDefined('transport');
    }

    public function definedOptions()
    {
        return $this->optionsResolver->getDefinedOptions();
    }
}

// $mailer = new Mailer(array(
//     'transport' => 'smpt'
// ));
// PHP Fatal error:  Uncaught exception 'Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException' with message 'The option "transport" does not exist. Defined options are: "host", "password", "port", "username".'

$mailer = new Mailer();
echo "Transport option are defined: " . ($mailer->transportIsDefined() ? "true" : "false") . PHP_EOL;
var_dump($mailer->definedOptions());
