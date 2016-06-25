<?php

namespace Page;

use Facebook\WebDriver\WebDriverBy;
use Facebook\Webdriver\WebDriverKeys;

class HomePage extends Page {

	private function queryTextBox(){
		return $this->driver->findElement(WebDriverBy::cssSelector('input[name="q"]'));
	}

    public function searchWords($query=null){
        $this->queryTextBox()->sendKeys($query);
        $this->queryTextBox()->sendKeys(WebDriverKeys::ENTER);
        return new SearchResultPage($this->driver);
    }

    public function getPagePath(){
		return '/';
	}

}
