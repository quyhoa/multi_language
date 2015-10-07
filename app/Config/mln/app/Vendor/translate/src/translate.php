<?php
include_once "Stichoza\GoogleTranslate\TranslateClient.php";
use Stichoza\GoogleTranslate\TranslateClient;
$t  = new TranslateClient();
$resultOne = TranslateClient::translate('en', 'ka', 'Hello');

//$resultTwo = $t->setSource('en')->setTarget('ka')->translate('Hello');
