<?php
namespace Validator;

class UrlValidatorTest extends \PHPUnit_Framework_TestCase {
	
    /**
     * @var \Collabim\Validator\UrlValidator
     */
    protected $urlValidator;

    protected function setUp() {
        $this->urlValidator = new \Collabim\Validator\UrlValidator;
    }

	public function testIsValid_emptyUrl() {
		$this->assertFalse($this->urlValidator->isValid(''));
	}

	public function testIsValid_https() {
		$this->assertTrue($this->urlValidator->isValid('https://example.com'));
	}

	public function testIsValid_ipAddress() {
		$this->assertTrue($this->urlValidator->isValid('https://46.249.44.4/'));
		$this->assertTrue($this->urlValidator->isValid('http://46.249.44.4/'));
	}

	public function testIsValid_withSlashAfterDomain() {
		$this->assertTrue($this->urlValidator->isValid('https://www.example.com/'));
		$this->assertTrue($this->urlValidator->isValid('http://example.com/'));
	}

	public function testIsValid_underscoreInHost() {
		$this->assertTrue($this->urlValidator->isValid('https://a_b.example.com'));
	}

    public function testIsValid_domainDefinedOnly() {
		$this->assertTrue($this->urlValidator->isValid('http://example.com'));
		$this->assertTrue($this->urlValidator->isValid('http://www.example.com'));

		$this->assertFalse($this->urlValidator->isValid('http:\\\\example..com/'));
		$this->assertFalse($this->urlValidator->isValid('http://www..example.com\\'));
	}

	public function testIsValid_multipleSubdomains() {
		$this->assertTrue($this->urlValidator->isValid('http://cs.en.example.org'));
		$this->assertTrue($this->urlValidator->isValid('http://de.cs.en.example.org'));
		$this->assertTrue($this->urlValidator->isValid('http://e-audit-spol-s-r-o-.katalog-ucetnich.cz/'));
	}

	public function testIsValid_withPath() {
		$this->assertTrue($this->urlValidator->isValid('http://en.example.org/wiki/Portal:Biography'));
		$this->assertTrue($this->urlValidator->isValid('http://example.com/page.html'));
	}

	public function testIsValid_withQueryString() {
		$this->assertTrue($this->urlValidator->isValid('http://example.com/page.html?var=1'));
		$this->assertTrue($this->urlValidator->isValid('http://example.com/page.html?var=1&var2=2'));
		$this->assertTrue($this->urlValidator->isValid('http://example.com/page.html?var=1&var2=2&var3=3'));
		$this->assertTrue($this->urlValidator->isValid('http://example.com/page.html?var=1+2'));
		$this->assertTrue($this->urlValidator->isValid('http://example.com/page.html?var=1'));
	}

	public function testIsValid_withHash() {
		$this->assertTrue($this->urlValidator->isValid('http://example.com/#anchor'));
	}
	
	public function testIsValid_withDiacritics() {
		$this->assertTrue($this->urlValidator->isValid('http://www.resinex.ru/продукты/?sort=producer&dir=ASC&polymer_type=TPE-E&producer=Arkema'));
		$this->assertTrue($this->urlValidator->isValid('http://www.e-florista.cz/search.php?tag=Aranžovací+hmota'));
		$this->assertTrue($this->urlValidator->isValid('http://www.heidelbergcement.com/NR/rdonlyres/62A75EBF-5588-4611-98FD-00E2B136767B/0/Ceník2012Nabídkaslužeb.pdf'));
		$this->assertTrue($this->urlValidator->isValid('http://www.magazin-legalizace.cz/cs/articles/detail/204-marihuana-myty-a-fakta?author=Hana+Gabrielová'));
		$this->assertTrue($this->urlValidator->isValid('http://www.babypartner.cz/lässig/tasky-na-kocarek/"'));	
	}

	public function testIsValid_withPort() {
		$this->assertTrue($this->urlValidator->isValid('http://search.seznam.cz:80/?q=letenky&mod=f&count=20&blindFriendly=1'));
	}

}
