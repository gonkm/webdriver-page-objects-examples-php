<?php

require_once __DIR__ . '/../vendor/autoload.php';

// spl_autoload_register(function ($class) {
//     include 'page/' . $class . '.php';
// });

// require_once 'page/Page.php';
// require_once 'page/HomePage.php';
// require_once 'page/SearchResultPage.php';

use Facebook\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Select;
use Facebook\WebDriver\Remote;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;

use HomePage;
use SearchResultPage;

class SampleTest extends PHPUnit_Framework_TestCase
{

  protected $driver;

  protected function setUp() {
    $this->driver = RemoteWebDriver::create(
      'http://localhost:4444/wd/hub',
      // '127.0.0.1:8910',
      array(
        WebDriverCapabilityType::BROWSER_NAME
          // => WebDriverBrowserType::FIREFOX,
          => WebDriverBrowserType::CHROME,
        // => 'phantomjs',
        // 'phantomjs.page.settings.userAgent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36',

      )
    );

  }
  
  protected function tearDown() {
    if ($this->driver) {
      $this->driver->quit();
    }
  }   

    /**
     * @dataProvider additionProvider
     */
    public function testSearch($query,$expected)
    {

        $this->driver->get('https://github.com');
        $homePage = new HomePage($this->driver);
        $searchresultPage = $homePage->searchWords($query);
        $this->assertEquals($expected,$this->driver->getTitle());
        $this->driver->takeScreenshot('image-'.$query.'.png');

    }  

    public function additionProvider()
    {
        return [
            'string1'  => ['php-webdriver','Search · php-webdriver · GitHub'],
            'string2' => ['webdriver','Search · webdriver · GitHub'],
            'null' => ['','Code Search · GitHub'],
        ];
    } 

}