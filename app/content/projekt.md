Redovisningstext
----------------

###Krav 1, 2, 3:

Webbsidan är skyddad med inloggning på så sätt att man måste logga in för att ställa frågor, svara på frågor, kommentera och uppdatera profil (då måste man också vara inloggad som rätt användare). Annars är det öppet att läsa allt. Password_hash() och password_verify() används och när man loggat in så sätts ett antal session-variabler med information om den som är inloggad (id, namn, mail). På de ställen där man behöver kontrollera om användaren är inloggad så kollar man om dessa variabler är satta och dess värde. Här hade det nog varit bättre att skapa en tjänst som hanterar inloggningen, men det är mycket jag inte hunnit med.

Då man skapar en ny användare så kontrolleras om det redan finns en användare med den mail som man har angett (det är mailadressen som fungerar som unikt användarnamn). Om man uppdaterar en användare så kontrolleras, om man byter mailadress, att den inte redan är registrerad av någon annan.

Kontrollers och modeller har skapats för: användare, frågor, svar, kommentarer och taggar. Alla kommentarer, både på frågor och svar, samlas i en tabell. Har en kolumn i tabellen som anger vilken typ av objekt kommentaren hör till. Jag skapade också en modell för den tabell som mappar mellan frågor och taggar. Till slut blev det dock så att jag istället refererar direkt till denna tabell i modellerna för frågor och taggar, verkade mer praktiskt. Jag har använt en SQLite databas. Ganska många vyer har skapats, för att kunna få det snyggt.

För att skapa formulären så har CForm använts och har använt CDatabase som gränssnitt mot databasen. För övrigt så har jag så klart försökt att använda det som vi tagit fram under kursen: det egna temat, grundklass för modeller (som jag har byggt ut för att kunna hantera de mer komplexa frågorna man behöver kunna ställa) m.m.

Aktiva användare, på förstasidan, beräknas som de fem som har flest frågor+svar+kommentarer. Jag tar inte hänsyn till när de är skrivna, vilket skulle vara en förbättring (men databasfrågan blev ganska så komplex ändå). De populäraste taggarna är de fem som är kopplade till flest frågor (måste vara kopplad till någon fråga för att visas öht) och sedan visas de fem senast skapade frågorna, med den senaste överst. Man kan lätt ändra hur många användare, taggar och frågor som visas.

Jag har använt "dispatch"-funktionaliteten i stor utsträckning. T.ex. när man ska visa en fråga så dispatchas till kommentars-kontrollern för att hitta och visa kommentarer kopplade till frågan och Users-kontrollern för att visa användare, sedan till svars-kontrollern för att hitta och visa svar, som i sin tur dispatchar till kommentars-kontrollern osv. På så sätt är ansvaret för olika uppgifter samlat på ett fåtal ställen.

Har också till största delen använt mig av dem "automatiska"-routingen i AnaxMVC, dvs. controller/action/parametrar.

Jag hade tänkt skapa ett gränssnitt för att skapa taggar, men då skulle man antagligen behöva införa roller (ex. admin) så det blev istället så att man laddar databasen med de taggar man kan använda. När man skapar en fråga får man välja vilka taggar man vill koppla till frågan.

Texten i frågor, svar och kommentarer tolkas som Markdown.

User-kontroller och -modell ligger under Anax/src annars ligger det mesta som jag har byggt i denna uppgift under Anax/app-katalogen.

###Krav 4, 5, 6:

Hann tyvärr inte. Jag satsade på att få sidan buggfri och (ganska) användarvänlig istället.


###Allmänt om projektets genomförande:

I början funderade jag en del på hur man skulle lägga upp implementationen. Skulle man kanske göra det som en "modul" som krävde att man först laddade ner Anax-MVC? Jag bestämde till slut att det nog var bättre att paketera det som en komplett lösning, blir enklare för användare att installera och få att fungera. Man får ett paket som är testat att det funkar tillsammans. Kanske att man skulle kunna erbjuda både och, så kan användaren välja.

Det svåraste med kraven var databasfrågorna. Jag har inte så mycket erfarenhet av databaser, så det blev lite klurigt att få till frågorna med joins m.m. Till slut kände jag också att CDatabaseModel-klassen var lite av en stoppkloss och att det var bättre, i vissa fall, att köra "rå" SQL för att komma framåt. Skapade därför en metod i klassen för att kunna göra just det.

Sen har jag nog ännu inte en riktigt bra utvecklingsmiljö för PHP-utveckling, vilket gjort det svårt att debugga. Installerade ett stöd för Xdebug i min editor men ändå omständigt att debugga. AnaxMVCs komponentuppbyggnad gör ju att det blir många hopp mellan olika delar i ramverket, callstacken är ju alltid 10+ nivåer känns det som. Det gör det extra nödvändigt med en bra debugger, har gått mycket tid pga. av långsam felsökning.

Stötte på ett problem med att hela databasen låser sig (för skrivning) då jag har en sida med en dispatch till en kontroller och ett formulär på samma sida och sedan postar formuläret. Oklart varför, koden kommer till execute på PDOStatement-objektet i CDatabaseBasic och sedan hänger sig databasen. Kanske någon krock mellan olika processer eller något?! Fick arbeta runt detta problem för jag lyckades inte lösa det trots att jag la mycket tid på det.

Hade också ett problem med att dispatch->forward() inte returnerade något svar. Efter en tids felsökning så hittades problemet i forward().

###Tankar om kursen:

Kursen har nog varit en av de bästa jag har gått. Den var krävande, men när man känner att man lär sig saker som är aktuellt och relevant för branschen så blir man motiverad. Det har varit mycket nytt att lära, och detaljer kommer nog försvinna ganska snabbt om man inte använder det. Nu har man i alla fall testat dem och kommit över tröskeln, vilket gör det betydligt lättare att komma vidare med de tekniker som man tycker verkar bra, och lättare att ta upp igen om man skulle vilja längre fram. Tidsestimaten för de olika uppgifterna har jag nog tyckt varit lite optimistiska i de flesta fallen. Instruktionerna för alla uppgifter har varit mycket bra. Boken var också bra, de delar som jag läste. Jag skulle klart rekommendera kursen och ger den betyget 10.