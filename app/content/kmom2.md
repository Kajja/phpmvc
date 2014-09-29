Kmom02: Kontroller och modeller
-------------------------------
**Reflektera över svårigheter, problem, lösningar, erfarenheter, lärdomar, resultatet, etc.**

Det blev en hel del detektivarbete i denna uppgift, dvs. följa trådarna från klass/fil till klass/fil och försöka förstå hur det hela hänger ihop, vilket ju också var syftet. Det är ju inte helt självklart t.ex. hur svaret till webbläsaren sätts ihop, att man göra render() på template-vyn och att det sedan i denna template-vy görs render på de vyer som finns i containern "views". Det som jag lärde mig, och använde mycket för att lösa kommentarsuppgiften, var den "default"-routing som är inbyggt i ramverket dvs. att en route tolkas som /controller/action/params, väldigt praktiskt. Vore också praktiskt om man kunde definiera mönster som routes ska matcha mot, pss. som finns i Phalcon.

Hade lite problem med hur man ska kunna hantera olika kommentarstrådar på olika sidor. Min idé var att lägga till en sträng till den nyckel, som används när man lagrar/hämtar kommentarer ur sessionen, som anger på vilken sida man befinner sig. Jag löste det tillslut genom att i varje route, som har en kommentarstråd, sätta en sessionsvariabel 'context' till den aktuella url:en. Denna 'context'-variabel används sedan för att hålla reda på vilken kommentarstråd man jobbar med.

Tycker ännu inte att det är helt självklart när man kan använda `$di->tjänst`, `$this->di->tjänst` eller `$this->tjänst`.

Jag hade lite problem med att installera Composer lokalt, fick "aktivera" tillägget `extension=php_openssl.dll` i `php.ini` och sen funkade det. 

Funderande lite på "hierarkisk MVC", där man kan plocka från olika kontrollers. Kan inte det resultera i en del svåröverskådliga beroenden?

**Hur känns det att jobba med Composer?**

Tycker att Composer är tydlig och enkel att använda, i alla fall för den grundläggande funktionaliteten (djupare än så har jag inte gått). Var först inte helt på det klara med kopplingen mellan Composer och Packagist. Det visade sig ju att de är hårt kopplade, där Packagist är förinställd i Composer, även om man kan ange andra Composer-repositories i sin composer.json fil. Har inte tidigare satt mig in i hur pakethanterare fungerar, så det var väldigt lärorikt. Att en katalog blir ett paket om den innehåller en `composer.json` fil kändes också "snyggt", så att man inte behöver någon ytterliggare definitionsfil för att skapa ett paket.

**Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?**

Finns väldigt många paket och lite svårt att få en överblick, några som kanske är intressanta:

+ hybridauth/hybridauth: Autentisering via Google, Facebook, ...
+ egeloen/google-map: Google maps interface

**Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?**

Tror jag fick ihop flödet. Det finns nog en del fördelar med att ha det så; man bestämmer på ett ställe vilken kontrollerklass som ska användas, kan byta ut kontroller i runtime, ... 

**Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?**

+ Gjorde om `CommentsInSession` till en tjänst "comments". `CommentController` blir då löst kopplad till den modell som man vill använda, dvs. man har möjlighet att byta modell, till kanske `CommentsInDB`, utan att `CommentController`-klassen påverkas.
+ Man skulle kunna skapa ett interface som `CommentsInSession` och andra modeller ska implementera, så att man i `CommentController` har något stabilt att programmera mot.
+ Det finns lite JavaScript i `form.tpl.php`, funderade på om man kunde flytta ut den men kom inte riktigt på hur.