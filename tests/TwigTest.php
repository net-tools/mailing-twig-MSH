<?php 

namespace Nettools\Mailing\MailSenderHelpers\Tests;



use \Nettools\Mailing\Mailer;
use \Nettools\Mailing\MailSenderHelpers\Twig;
use \org\bovigo\vfs\vfsStream;
use \org\bovigo\vfs\vfsStreamDirectory;



class TwigTest extends \PHPUnit\Framework\TestCase
{
	protected $_vfs = NULL;
	protected $root;
	

	public function setUp() :void
	{
		$this->_vfs = vfsStream::setup('root');
		$this->root = vfsStream::url("root/");
	}
	
	
		
	public function testMSH()
	{
		$ml = new Mailer(new \Nettools\Mailing\MailSenders\Virtual());
		$msh = new Twig($ml, 'msh content #{{ name }}#', 'text/plain', 'unit-test@php.com', 'test subject', ['cache' => $this->root]);

		$mcontent = $msh->render(['name' => 'me !']);
		$ml->send($mcontent, 'recipient@here.com');
		
		$this->assertEquals(1, count($ml->getSent()));
		$this->assertEquals(true, is_int(strpos($ml->getSent()[0], 'msh content #me !#')));
	}
}


?>