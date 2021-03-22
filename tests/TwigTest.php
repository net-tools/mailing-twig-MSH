<?php 

namespace Nettools\Mailing\MailSenderHelpers\Tests;



use \Nettools\Mailing\Mailer;
use \Nettools\Mailing\MailSenderHelpers\Twig;



class TwigTest extends \PHPUnit\Framework\TestCase
{
	public function testMSH()
	{
    	$ms = new \Nettools\Mailing\MailSenders\Virtual();
		$ml = new Mailer($ms);
		$msh = new Twig($ml, 'msh content #{{ name }}#', 'text/plain', 'unit-test@php.com', 'test subject');

		$mcontent = $msh->render(['name' => 'me !']);
		$msh->send($mcontent, 'recipient@here.com');
		
		$this->assertEquals(1, count($ms->getSent()));
		$this->assertEquals(true, is_int(strpos($ms->getSent()[0], 'msh content #me !#')));
	}
}


?>