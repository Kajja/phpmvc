Kmom5: Bygg ut ramverket
------------------------

**Reflektera över svårigheter, problem, lösningar, erfarenheter, lärdomar, resultatet, etc.**

Den här uppgiften löpte på betydligt bättre än den tidigare. Kul att få ta det hela vägen: från egen modul till Git till Packagist och sedan hämta ner den via Composer.

Intressant också med mikroramverk, har funderat på att göra ett API, så de ska jag titta mer på framöver.

Jag hade lite problem när jag skapade en klass som ärvde från mos/cdatabase/CDatabaseBasic. Jag ville skapa en metod i min subklass som bara skulle skapa en tabell om den inte redan existerade. Provade en hel del olika sätt men inget funkade riktigt bra. Tillslut gjorde jag en liten "fuling". Jag använder mig av `createTable()` i mos/cdatabase/CDatabaseBasic, men istället för att skicka in bara tabellnamnet så skickar jag in som argument "IF NOT EXISTS tabellnamn". Inte så snyggt men det funkar.

**Var hittade du inspiration till ditt val av modul och var hittade du kodbasen som du använde?**
Jag blev inspirerad av det som skrevs i samband med uppgiften om loggning. Sen har jag precis gått en kurs som handlade om beslutsstöd, och där verkade det som att man kan få ut allt möjligt från loggar. Därför gjorde jag en modul som sparar undan information från HTTP-requests i en databas (varför ska Google ha all data?). Tänkte också att den kan vara användbar då man felsöker sin app. Med många redirects så kan det vara svårt att följa flödet och se vad det är som går fel. Modulen innehåller också stöd för att hämta den sparade informationen och visa den som en HTML-tabell. 

Jag använder mig av mos/cdatabase mot databasen. Skapade också två gränssnitt, en för databastjänster (IDatabase) och en för formatteringstjänster (IFormatter) som formaterar datan i databasen till ett lämplig format ex. HTML. I samband med att man skapar huvudobjektet (av typen RequestRecord), så skickar man med som argument, objekt som implementerar dessa. Tänkte att delarna i modulen ska vara löst kopplade och använde mig av "composition" (tror jag). Gör det lätt att förändra modulens beteende genom att skapa nya klasser som implementerar dessa gränssnitt.

**Hur gick det att utveckla modulen och integrera i ditt ramverk?**

Tycker att det gick bra, inga större problem på vägen.

**Hur gick det att publicera paketet på Packagist?**

Var lite oroligt att det skulle kunna bli problem här, men det gick i princip på första försöket.

**Hur gick det att skriva dokumentationen och testa att modulen fungerade tillsammans med Anax MVC?**

Jag skapde en ny version av Anax-MVC och uppdaterade composer.json filen. Här stötte jag dock på lite problem. I och med att min modul bygger på mos/cdatabase så fick jag problem när jag la till min modul som "required" i composer.json och sedan körde "composer install", den hittade inte mos/cdatabase. Problemet berodde på att jag använder mig av mos/cdatabase i dev-version (vilket kanske är onödigt). La till "minimum-stability": "dev" i composer.json filen och sedan fungerade det.

Dokumentationen för att integrera modulen i Anax-MVC finns här: <https://github.com/Kajja/requestrecorder/blob/master/Usage_with_Anax-MVC.md>

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.**

Nej, det gjorde jag inte. 