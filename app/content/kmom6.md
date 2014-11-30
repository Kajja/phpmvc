Det här var väldigt kul att lära sig, speciellt unit testing. Har flera gånger försökt komma igång med unit testing, men det är svårt att motivera sig ibland när tiden är knapp. Provade i ett projekt och såg nyttan ganska snabbt, man blev trygg med att det fungerade, men i nästa kodprojekt så blev det inget igen. Tror att det handlade om att jag inte var tillräckligt bra på det, så det kändes som en stoppklass. Efter den här uppgiften känner jag mig mycket mer insatt: har gjort mocks, testat mot databas, ... Ska försöka köra TDD framöver och se hur det är.

Tycker dock dokumentationen av PHPUnit är lite sisådär. Försökte hitta vilka tester man kan göra i mockobjekt->with(<test>), men hittade inget. Det verkar som att man måste in i PHPUnit-koden och titta.

Stötte på ganska många problem på vägen:
* $_SERVER var inte definierad, vilket ju var ganska naturligt eftersom testskripten inte körs i en webbservermiljö (där webbservern sätter upp diverse variabler). Definierade $_SERVER själv i det testcase där den behövdes.
* Code coverage täckte även in katalogen vendor/ i min modul. Fixade det genom att skapa en phpunit.xml fil där jag anger vilken katalog som är intressant att mäta coverage i, dvs. src/, och la den xml-filen i den katalog från vilken jag kör PHPUnit.
* Svårt att testa då man är beroende av Anax-MVC kod, modulen använder bl.a. $di->session och $di->request. Jag löste det så att jag skapade egna mock-klasser/interface som simulerade de delar i Anax-MVC som modulen beror av.

Lärde mig även att:
* man inte brukar testa private/protected metoder direkt (även om det går) utan göra det indirekt istället (http://stackoverflow.com/questions/249664/best-practices-to-test-protected-methods-with-phpunit)
* man kan skapa en in-memory databas i PDO (sqlite::memory:)
* det verkar finnas en inbyggd webbserver i PHP http://php.net/manual/en/features.commandline.webserver.php
* använda .bat filer i Windows vilket visade sig väldigt praktiskt.

**Var du bekant med några av dessa tekniker innan du började med kursmomentet?**
Kände till unit testing, code coverage och automated tests hyfsat bra. Continuous integration och code quality hade jag inte riktigt koll på.

**Hur gick det att göra testfall med PHPUnit?**
Det gick för det mesta bra. Det blev dock betydligt mer komplext än vad jag hade tänkt mig. Var tvungen att göra stubs/mocks och testa mot databas.

**Hur gick det att integrera med Travis?**
Det var inga problem, bara att ange sitt GitHub-repo. Lite småfix med .travis.yml filen.

**Hur gick det att integrera med Scrutinizer?**
Det gick också bra, tycker gränssnittet är bättre på Travis. En gång så tog Travis för lång tid på sig, så jag fick manuellt dra igång kontrollen hos Scrutinizer.

**Hur känns det att jobba med dessa verktyg, krångligt, bekvämt, tryggt? Kan du tänka dig att fortsätta använda dem?**
Tycker det känns tryggt, speciellt med Travis. Scrutinizer känns inte lika "stabil". Kan tänka mig att nyttan med Travis, blir stor när man har lite mer komplexa projekt.

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.**
Nej, nådde inte upp till 10 på kodkvaliten.

**Övrigt**
Det kan bli lite frustrerande när man behöver ha "fixture":n, på plats innan man kan köra sina tester. Framförallt när jag testade mot Anax märkte jag hur mycket jobb det blev. Gick på linjen att isolera testfallen och inte köra mot den riktiga koden som det man testar är beroende av. Dels så kan det vara lite svårt att få all den kod man är beroende på på plats, och dels blir det ju mer av integrationstestning (som ju iof också behöver göras). Vet av erfarenhet hur extremt viktigt det är att man testar på en miljö så nära driftsmiljön som möjligt. Förstår att det är bra att skicka med testfallen.

Att man har testfall som täcker in hela koden behöver ju inte betyda att den fungerar felfritt:) Testfallen kan ju vara mer eller mindre utvecklade, ex. man kanske bara testar mot en typ av databaser, har enkla varianter på indata till en metod man provar osv.

[Git](https://github.com/Kajja/requestrecorder)
[Travis](https://travis-ci.org/Kajja/requestrecorder)
[Scrutinizer](https://scrutinizer-ci.com/g/Kajja/requestrecorder/)