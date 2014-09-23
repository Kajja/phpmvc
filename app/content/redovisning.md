Kmom02: Kontroller och modeller
-------------------------------
**Reflektera över svårigheter, problem, lösningar, erfarenheter, lärdomar, resultatet, etc.**

Det gäller som skrivs i uppgiften att följa trådarna från klass/fil till klass/fil och försöka förstå hur det hänger ihop. Jag hade först lite problem med att installera Composer lokalt, fick "aktivera" tillägget "extension=php_openssl.dll" i php.ini och sedan fungerade det bra. Det tog en stund att sätta sig in i Phalcon-ramverket. I det ramverket verkar det ju som att deras Dispatcher är en central komponent, allt verkar hanteras av denna. Uppgiften gjorde att man fick möjlighet att fördjupa sin förståelse för Anax-MVC. Det är ju inte helt självklart t.ex. hur svaret till webbläsaren sätts ihop, att man göra render() på template-vyn och att det sedan i denna template-vy så görs render på de vyer som finns i contanern views utifrån vilken region man angett osv. Strukturen är ju lite dold. I Phalcon har man ju i sitt förslag på katalogstruktur en katalog för modellerna. Det kanske inte är så dumt, så får man en tydligare struktur. Det verkar ju som att Phalcon ramverket använder en dispatcher lite annorlunda än Anax-MVC, där det mesta verkar hanteras av dispatchern i Phalcon-fallet. Att man i Phalcon kan definiera mönster som man matchar mot de sökvägar/routes man får i http-requesten verkar ju också väldigt praktiskt. Vad jag tycker att jag fick en bättre förståelse är hur ramverket hänger ihop. 

**Hur känns det att jobba med Composer?**

Strukturen i Composer tyckte jag var tydlig och enkel att använda, i alla fall för den grundläggande funktionaliteten (djupare än så har jag inte gått). Var först inte helt på det klara med kopplingen mellan Composer och Packagist. Hade Packagist någon speciell koppling till Composer eller var det bara ett exempel på en av många Composer-repositories? Det visade sig ju att de är hårt kopplade, där Packagist är förinställd i Composer, även om man kan ange andra Composer-repositories i sin composer.json fil. Har inte tidigare satt mig in i hur pakethanterare fungerar, så det var väldigt lärorikt. Att en katalog blir ett paket om den innehåller en composer.json fil kändes också "snyggt", så att man inte behöver någon ytterliggare definitionsfil för att skapa ett paket.

**Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?**

PHPUnit. I Phalcon fanns det metoder som man kunde använda om man ville skapa ett REST-tjänst. Tänkte på framförallt, ..

**Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?**

Tror jag fick ihop det. Jag är inte helt säker på att jag ännu helt förstår nyttan med att ha kontrollers som tjänster. Det kanske är praktiskt om man börjar arbeta enligt "hierarkisk MVC" då man kan plocka från olika kontrollers för att hantera en http-request (fast det känns också som att detta kan resultera i en del svåröverskådliga beroenden).

**Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?**
Ändrade tiden i tmp
Flyttade Kommentar in under div-comments
Lite tveksamt när man förutsätter att filerna heter på ett visst sätt.
Gjorde om CommentInSession till en tjänst "comments". Får då CommentController lite lösare kopplad till den modell som implementerar modellen, dvs. har möjligthet att ändra implementeringen utan att CommentController påverkas. Får även bort duplicering av kod för skapande av CommentInSession-objekt och namnet inte kopplat mot Session heller.
Ev. skapa interface för koppling som modellerna ska implementera.
Lite svårt att hålla koll på när man kan använda $di->tjänst, $this->di->tjänst eller $this->tjänst, dvs. i vilket sammanhang/scope befinner man sig t.ex. i när man skriver php-kod i en template fil?


Kmom01: PHP-baserade och MVC-inspirerande ramverk
-------------------------------------------------
Det var en intressant uppgift då den gav en ganska djup inblick i hur MVC-ramverk kan vara uppbyggda. Jag läste på lite om MVC generellt, innan kursen började, men tyckte att artikeln [PHP-baserade och MVC-inspirerade ramverk, vad betyder det?](http://dbwebb.se/kunskap/php-baserade-och-mvc-inspirerade-ramverk-vad-betyder-det) gav mig mer MVC-"kött på benen". Jag fick en förståelse för att det inte finns ett sätt att skapa ett MVC-ramverk, t.ex. att kontroller och modell kan var olika "tjocka" i olika ramverk.

Vad man också fick var en känsla för hur effektiv man antagligen kan vara då man har lärt sig ett ramverk, hur snabbt man kan få upp en proffsig webbapplikation. Ramverket ger också en bra struktur för egna tillägg som man vill återanvända i andra webbapplikationer. Syftet med MVC är också att man ska få en flexibel struktur så att man enkelt kan hantera framtida förändringar, detta lär man nog märka/förstå längre fram i kursen.

Att sätta sig in i Anax-MVC tog en liten stund. Vid en första anblick så kändes det lite rörigt tyckte jag. Efter ett tag gjorde jag några översiktsbilder och en sammanfattning över de olika klasserna i ramverket och deras metoder. Detta gjorde det mycket tydligare vilka möjligheter som finns i ramverket, och är förhoppningsvis något som jag kan få användning av i resten av kursen. Teman läggs ju på *ramverksnivå* vilket jag tyckte vara lite förvirrande. Detta är ju grundvyn i en applikation som kanske även skulle kunna ligga på *appnivå*?! Vad jag fortfarande tycker är lite svårt att ha koll på är vilka sökvägar som de olika metoderna förutsätter, dvs. vilken *grundkatalog* man kan förutsätta när man t.ex. ska ange länk till en vy, bild eller annat innehåll.

Eftersom jag inte hade jobbat med Git och GitHub tidigare så tog det också en liten stund att sätta sig in i dessa. Jag la upp min site på GitHub och hämtade sedan ner den därifrån till skolans server.

Utvecklingen har skett på en Windows 8 dator, texteditor har varit Sublime Text 2, XAMPP har jag använt lokalt (med PHP 5.4.7) och sidan har jag granskat i Google DevTools. PuTTY användes för att koppla upp mot BTH.

Jag har ganska så begränsad erfarenhet av ramverk. Det är framförallt jQuery, jQuery UI och jQuery Mobile (om man nu kan kalla de för ramverk) som jag har jobbat med tidigare. Jag hade, som jag nämnde ovan, läst på lite om MVC innan kursen började (i bok om designmönster), så jag hade ett hum om vad det innebar. Min kunskap om objektsorienterade konstruktioner kommer främst från Java, och PHP visade sig ju ha stora likheter med Java här. Traits var dock inte något som jag hade sett innan och inte heller "overloading" med __get och __set. Begreppet Dependency injection hade jag inte heller stött på tidigare.

Uppgiften gav lite av en "rivstart" på kursen. Mycket att ta in, men det är kul när man känner att man lär sig mycket nytt.
