Kmom02: Kontroller och modeller
-------------------------------
*Reflektera över svårigheter, problem, lösningar, erfarenheter, lärdomar, resultatet, etc.*
Vad jag tycker att jag fick en bättre förståelse är hur ramverket hänger ihop. Det gäller som skrivs i uppgiften att följa trådarna från klass/fil till klass/fil och försöka förstå hur det hänger ihop.
Jag hade först lite problem med att installera Composer lokalt, fick "aktivera" tillägget "extension=php_openssl.dll" i php.ini och sedan fungerade det bra. Det tog en stund att sätta sig in i Phalcon-ramverket. I det ramverket verkar det ju som att deras Dispatcher är en central komponent, allt verkar hanteras av denna. Uppgiften gjorde att man fick möjlighet att fördjupa sin förståelse för Anax-MVC. Det är ju inte helt självklart t.ex. hur svaret till webbläsaren sätts ihop, att man göra render() på template-vyn och att det sedan i denna template-vy så görs render på de vyer som finns i contanern views utifrån vilken region man angett osv. Strukturen är ju lite dold. I Phalcon har man ju i sitt förslag på katalogstruktur en katalog för modellerna. Det kanske inte är så dumt, så får man en tydligare struktur. 

*Hur känns det att jobba med Composer?*
Jag tycker att strukturen i Composer är enkel och tydlig, i alla fall för de grundläggande funktionerna (djupare än så har jag inte gått). Var först inte helt på det klara med kopplingen mellan Composer och Packagist. Hade Packagist någon speciell koppling till Composer eller var det bara ett exempel på en av många Composer-repositories? Det visade sig ju att de är hårt kopplade, där Packagist är förinställd i Composer, även om man kan ange andra Composer-repositories i sin composer.json fil. Har inte tidigare satt mig in i hur pakethanterare fungerar, så det var väldigt lärorikt. Att en katalog blir ett paket om den innehåller en composer.json fil, kändes också "snyggt" så att man inte behöver någon speciell fil för att hantera paket.

*Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?*
PHPUnit. I Phalcon fanns det metoder som man kunde använda om man ville skapa ett REST-tjänst. Tänkte på framförallt, ..

Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?

Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?