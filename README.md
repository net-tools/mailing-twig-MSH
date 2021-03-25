# net-tools/mailing-twig-msh

## Composer library to send emails through a `MailSenderHelperIntf` implementation with Twig support

This package is a complement to net-tools/mailing, whose MailSenderHelpers folder contains main classes.

Here, we create the email content through a Twig-formatted string, making it possible to update the mail template with specific values, such as customer name, etc.



## Setup instructions

To install net-tools/mailing-twig-msh package, just require it through composer : `require net-tools/mailing-twig-msh:^1.0.0`.


## How to use ?

We create the `MailSenderHelpers\Twig` object the same way as we do with MailSenderHelpers of nettools/mailing repository :


```php

$mailer = Mailer::getDefault();

// first, we create a helper object, with minimum parameters (mailer object, body content, sender, recipient subject, optional parameters)
$msh = new MailSenderHelpers\Twig($mailer, 'raw mail for {{customer}} as text', 'text/plain', 'from@me.com', 'subject of email', $params);

// prepare the mail : checking required parameters set, building text/html and text/plain parts (from respectively text/plain or text/html body content) 
$mailContent = $msh->render(['customer' => 'John Doe']);

// send the email rendered
$msh->send($mailContent, 'recipient@here.com');

```

The optional `$params` last argument may contains :
- a `cache` parameter ; if set, points to the path of Twig cache directory



## API Reference

To read the entire API reference, please refer to the PHPDoc here :
https://nettools.ovh/net-tools/phpdoc/output/net-tools/build/classes/Nettools-Mailing-MailSenderHelpers-Twig.html



## PHPUnit

To test with PHPUnit, point the -c configuration option to the /phpunit.xml configuration file.

