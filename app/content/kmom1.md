Kmom01: PHP-baserade och MVC-inspirerande ramverk
-------------------------------------------------
Det var en intressant uppgift då den gav en ganska djup inblick i hur MVC-ramverk kan vara uppbyggda. Jag läste på lite om MVC generellt, innan kursen började, men tyckte att artikeln [PHP-baserade och MVC-inspirerade ramverk, vad betyder det?](http://dbwebb.se/kunskap/php-baserade-och-mvc-inspirerade-ramverk-vad-betyder-det) gav mig mer MVC-"kött på benen". Jag fick en förståelse för att det inte finns ett sätt att skapa ett MVC-ramverk, t.ex. att kontroller och modell kan var olika "tjocka" i olika ramverk.

Vad man också fick var en känsla för hur effektiv man antagligen kan vara då man har lärt sig ett ramverk, hur snabbt man kan få upp en proffsig webbapplikation. Ramverket ger också en bra struktur för egna tillägg som man vill återanvända i andra webbapplikationer. Syftet med MVC är också att man ska få en flexibel struktur så att man enkelt kan hantera framtida förändringar, detta lär man nog märka/förstå längre fram i kursen.

Att sätta sig in i Anax-MVC tog en liten stund. Vid en första anblick så kändes det lite rörigt tyckte jag. Efter ett tag gjorde jag några översiktsbilder och en sammanfattning över de olika klasserna i ramverket och deras metoder. Detta gjorde det mycket tydligare vilka möjligheter som finns i ramverket, och är förhoppningsvis något som jag kan få användning av i resten av kursen. Teman läggs ju på *ramverksnivå* vilket jag tyckte vara lite förvirrande. Detta är ju grundvyn i en applikation som kanske även skulle kunna ligga på *appnivå*?! Vad jag fortfarande tycker är lite svårt att ha koll på är vilka sökvägar som de olika metoderna förutsätter, dvs. vilken *grundkatalog* man kan förutsätta när man t.ex. ska ange länk till en vy, bild eller annat innehåll.

Eftersom jag inte hade jobbat med Git och GitHub tidigare så tog det också en liten stund att sätta sig in i dessa. Jag la upp min site på GitHub och hämtade sedan ner den därifrån till skolans server.

Utvecklingen har skett på en Windows 8 dator, texteditor har varit Sublime Text 2, XAMPP har jag använt lokalt (med PHP 5.4.7) och sidan har jag granskat i Google DevTools. PuTTY användes för att koppla upp mot BTH.

Jag har ganska så begränsad erfarenhet av ramverk. Det är framförallt jQuery, jQuery UI och jQuery Mobile (om man nu kan kalla de för ramverk) som jag har jobbat med tidigare. Jag hade, som jag nämnde ovan, läst på lite om MVC innan kursen började (i bok om designmönster), så jag hade ett hum om vad det innebar. Min kunskap om objektsorienterade konstruktioner kommer främst från Java, och PHP visade sig ju ha stora likheter med Java här. Traits var dock inte något som jag hade sett innan och inte heller "overloading" med __get och __set. Begreppet Dependency injection hade jag inte heller stött på tidigare.

Uppgiften gav lite av en "rivstart" på kursen. Mycket att ta in, men det är kul när man känner att man lär sig mycket nytt.
