Kmom02: Kontroller och modeller
-------------------------------
**Reflektera över svårigheter, problem, lösningar, erfarenheter, lärdomar, resultatet, etc.**

Det blev en hel del detektivarbete i denna uppgift, dvs. följa trådarna från klass/fil till klass/fil och försöka förstå hur det hela hänger ihop, vilket ju också var syftet. Det är ju inte helt självklart t.ex. hur svaret till webbläsaren sätts ihop, att man göra render() på template-vyn och att det sedan i denna template-vy görs render på de vyer som finns i containern "views". Det som jag lärde mig, och använde mycket för att lösa kommentarsuppgiften, var den "default"-routing som är inbyggt i ramverket dvs. att en route tolkas som /controller/action/params, väldigt praktiskt. Vad som också vore praktiskt är om man kunde definiera mönster som routes ska matcha mot, pss. som finns i Phalcon. 

Det tog en stund att sätta sig in i Phalcon-ramverket. Det verkar som att deras Dispatcher är en central komponent, allt verkar hanteras av denna, vilket skiljer sig lite från Anax-MVC (som jag förstått det). 

Hade lite problem med hur man ska kunna hantera flera kommentarstrådar på olika sidor. Min idé var att lägga till en sträng till nyckeln, som används när man lagrar/hämtar saker ur session, som anger på vilken sida man befinner sig. Valde att använda strängen från `CUrl::create('')`, för jag tolkade det som att man skulle kunna ha olika kommentarstrådar per skript (vet inte om jag tolkade kravet rätt?).

Tycker ännu inte att det är helt självklart när man kan använda `$di->tjänst`, `$this->di->tjänst` eller `$this->tjänst`, dvs. i vilket sammanhang/scope befinner man sig.

Jag hade lite problem med att installera Composer lokalt, fick "aktivera" tillägget `extension=php_openssl.dll` i `php.ini` och sen funkade det. 

Sen funderade jag lite på hur autoloaders fungerar, tycker det känns lite tveksamt när man förutsätter att filerna heter på ett visst sätt för att hitta klasser. Skulle man inte kunna göra på något annat sätt?

Funderande också på "hierarkisk MVC", där man kan plocka från olika kontrollers. Kan inte det resultera i en del svåröverskådliga beroenden?

**Hur känns det att jobba med Composer?**

Tycker att strukturen i Composer är tydlig och enkel att använda, i alla fall för den grundläggande funktionaliteten (djupare än så har jag inte gått). Var först inte helt på det klara med kopplingen mellan Composer och Packagist. Hade Packagist någon speciell koppling till Composer eller var det bara ett exempel på en av många Composer-repositories? Det visade sig ju att de är hårt kopplade, där Packagist är förinställd i Composer, även om man kan ange andra Composer-repositories i sin composer.json fil. Har inte tidigare satt mig in i hur pakethanterare fungerar, så det var väldigt lärorikt. Att en katalog blir ett paket om den innehåller en `composer.json` fil kändes också "snyggt", så att man inte behöver någon ytterliggare definitionsfil för att skapa ett paket.

**Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?**

Finns väldigt många paket och lite svårt att få en överblick, några som kanske är intressanta:

+ hybridauth/hybridauth: Autentisering via Google, Facebook, ...
+ egeloen/google-map: Google maps interface

**Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?**

Tror jag fick ihop flödet. Det finns nog en del fördelar med att ha det så; man bestämmer på ett ställe vilken kontrollerklass som ska användas, kan byta ut kontroller i runtime, ... 

**Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?**

+ Gjorde om `CommentsInSession` till en tjänst "comments". `CommentController` blir då löst kopplad till den modell som man vill använda, dvs. man har möjlighet att byta modell, till kanske `CommentsInDB`, utan att `CommentController` påverkas.
+ Man skulle kunna skapa ett interface som `CommentsInSession` och andra modeller ska implementera, så att man i `CommentController` har något stabilt att programmera mot.
+ I `CommentsInSession`: Skapade en variabel $key som håller "nyckeln" vid lagring/hämtning av data i sessionen, förut användes 'comment' som nyckel överallt, nu finns det ett ställe där man kan sätta detta värde.
+ Det finns lite JavaScript i `form.tpl.php`, funderade på om man kunde flytta ut den men kom inte riktigt på hur.


Kmom01: PHP-baserade och MVC-inspirerande ramverk
-------------------------------------------------
Det var en intressant uppgift då den gav en ganska djup inblick i hur MVC-ramverk kan vara uppbyggda. Jag läste på lite om MVC generellt, innan kursen började, men tyckte att artikeln [PHP-baserade och MVC-inspirerade ramverk, vad betyder det?](http://dbwebb.se/kunskap/php-baserade-och-mvc-inspirerade-ramverk-vad-betyder-det) gav mig mer MVC-"kött på benen". Jag fick en förståelse för att det inte finns ett sätt att skapa ett MVC-ramverk, t.ex. att kontroller och modell kan var olika "tjocka" i olika ramverk.

Vad man också fick var en känsla för hur effektiv man antagligen kan vara då man har lärt sig ett ramverk, hur snabbt man kan få upp en proffsig webbapplikation. Ramverket ger också en bra struktur för egna tillägg som man vill återanvända i andra webbapplikationer. Syftet med MVC är också att man ska få en flexibel struktur så att man enkelt kan hantera framtida förändringar, detta lär man nog märka/förstå längre fram i kursen.

Att sätta sig in i Anax-MVC tog en liten stund. Vid en första anblick så kändes det lite rörigt tyckte jag. Efter ett tag gjorde jag några översiktsbilder och en sammanfattning över de olika klasserna i ramverket och deras metoder. Detta gjorde det mycket tydligare vilka möjligheter som finns i ramverket, och är förhoppningsvis något som jag kan få användning av i resten av kursen. Teman läggs ju på *ramverksnivå* vilket jag tyckte vara lite förvirrande. Detta är ju grundvyn i en applikation som kanske även skulle kunna ligga på *appnivå*?! Vad jag fortfarande tycker är lite svårt att ha koll på är vilka sökvägar som de olika metoderna förutsätter, dvs. vilken *grundkatalog* man kan förutsätta när man t.ex. ska ange länk till en vy, bild eller annat innehåll.

Eftersom jag inte hade jobbat med Git och GitHub tidigare så tog det också en liten stund att sätta sig in i dessa. Jag la upp min site på GitHub och hämtade sedan ner den därifrån till skolans server.

Utvecklingen har skett på en Windows 8 dator, texteditor har varit Sublime Text 2, XAMPP har jag använt lokalt (med PHP 5.4.7) och sidan har jag granskat i Google DevTools. PuTTY användes för att koppla upp mot BTH.

Jag har ganska så begränsad erfarenhet av ramverk. Det är framförallt jQuery, jQuery UI och jQuery Mobile (om man nu kan kalla de för ramverk) som jag har jobbat med tidigare. Jag hade, som jag nämnde ovan, läst på lite om MVC innan kursen började (i bok om designmönster), så jag hade ett hum om vad det innebar. Min kunskap om objektsorienterade konstruktioner kommer främst från Java, och PHP visade sig ju ha stora likheter med Java här. Traits var dock inte något som jag hade sett innan och inte heller "overloading" med __get och __set. Begreppet Dependency injection hade jag inte heller stött på tidigare.

Uppgiften gav lite av en "rivstart" på kursen. Mycket att ta in, men det är kul när man känner att man lär sig mycket nytt.
