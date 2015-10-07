<?php
require_once "vendor/autoload.php";
use Stichoza\GoogleTranslate\TranslateClient;

class Translate{
	private $clients=null;
	public function Translate()
	{
		$this->clients = new TranslateClient();
	}
	public function tranlated($fromLanguage,$toLanguage,$text){
		$result = $this->clients->setSource($fromLanguage)->setTarget($toLanguage)->translate($text);

        return $result;
	}
}

