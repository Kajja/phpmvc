Kmom04: Databasdrivna modeller
------------------------------

Det var en mastig uppgift, men har lärt mig mycket. Det var intressant att komma igång lite mer med modeller, så att man ser hela "MVC-bilden". Kändes också väldigt viktigt att förstå hur man lägger till moduler till ett ramverk, känns som att det är centralt, så som det funkar på "riktigt". Skapade en klass som ärver av CDIFactoryDefault där tjänsterna läggs till. Tänkte lite på principen att kod ska vara "open for extension, closed for modification".

Stötte på många småproblem på vägen bl.a. var jag tvungen att uppgradera till php 5.5 för att få password_hash att fungera. De största problemen hade jag dock då jag skulle ersätta formulären för kommentarer med CForm-formulär. Flödet blev helt annorlunda i och med att formulären "självpostar" sig till samma sida. Då funkar det ju inte att i callback-metoderna till knapparna göra redirect till en annan url, då tappar man ju all POST-data:-). Fick istället "dispatcha" till kommentars-kontrollern i callback funktionerna.

Märkte lite problem med att inte ha definierat ett interface som både CommentInSession och Comment/CDatabaseModel följer. Ex. find() ger ett objekt från CDataBaseModel och en array från CommentsInSession. Fick då göra en liten "adapter"-metod i Comment-klassen så att find() returnerar en array.

Behöver lägga till en hel del felhantering för att det ska bli en stabil lösning, men hann inte med.

**Vad tycker du om formulärhantering som visas i kursmomentet?**

Det blir ju ett lite annorlunda flöde som jag skrev ovan, men det är ju praktiskt att man t.ex. kan anpassa utseenden på formulär dynamiskt om man skulle vilja. Att använda sig av den inbyggda valideringen känns också som att det kan spara mycket tid. Jag har annars inte så ont av att skapa formulär i HTML.

**Vad tycker du om databashanteringen som visas, föredrar du kanske traditionell SQL?**

Jag har inte jobbat så mycket med relationsdatabaser så jag tycker det var skönt att slippa använda SQL direkt, bra också att man kan slippa bry sig om vilken databashanterare man använder. Det blir ju dock många "abstraktionslager" mot databasen (modell->basmodell->CDatabaseBasic->PDO->...), gäller att få en förståelse för syftet med de olika lagren, så att man använder dem rätt tror jag.

**Gjorde du några vägval, eller extra saker, när du utvecklade basklassen för modeller?**

Först valde jag att samla allt utom setProperties och getProperties i basklassen. Tänkte att "properties" kan vara lite mer specifikt kopplat till den modell som man jobbar med. Men då jag flyttade kommentarerna till databasen så flyttade jag också dessa metoder till basklassen, de fungerade ju bra som de var även för kommentarer. Behöver man göra något specifikt för en modell så går ju metoderna att överskugga i subklassen. La till en metod deleteWhere, en lite mer flexibel delete-metod.

**Beskriv vilka vägval du gjorde och hur du valde att implementera kommentarer i databasen.**

Jag la upp det på samma sätt som för användarhanteringen dvs. skapade en klass Comment som ärver av basklassen. I Comment-klassen finns bara ett fåtal metoder. Det blev också en tabell för alla kommentarer, det kändes som att det skulle krävas en del förändringar i basklassen annars. En kolumn i tabellen talar om vilken sida en viss kommentar hör till. Kommentarerna får id:n som är unika för hela siten. Om man istället skulle vilja att varje sida har en egen id-serie så skulle man t.ex. kunna införa en kolumn page_id i tabellen eller numrera dem utifrån när de skapades.

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.**

Nej, det hanns inte med.