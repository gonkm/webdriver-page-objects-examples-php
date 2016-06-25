<?php

// namespace Page;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use RuntimeException;

class Page{

    /** @var RemoteWebDriver */
    protected $driver;

    public function __construct(RemoteWebDriver $driver){
        $this->driver = $driver;
        $this->verify($driver);
    }

    public function verify($driver){
        $url = parse_url($this->driver->getCurrentURL(), PHP_URL_PATH);
    	if ($url !== $this->getPagePath()) {
        	throw new RuntimeException('page遷移不正');    		
    	}
    }

    public function getPagePath(){
		throw new RuntimeException('getpath不正'); 
	}

}

