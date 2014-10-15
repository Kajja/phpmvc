Kmom03: Bygg ett eget tema
-------------------------
**Reflektera över svårigheter, problem, lösningar, erfarenheter, lärdomar, resultatet, etc.**

Att jobba med CSS är inte min favorit. Det blir lätt så många oöverskådliga beroenden. Man kan ändra på ett ställe utan att det ger genomslag, för det är någon/några andra regler som styr. Sen tolkar olika browsers CSS lite olika eller kräver prefix. Detta gör att det lätt kan ta väldigt lång tid att få till en enkel sak, i alla fall för mig. Ska man ändra något så är det också ofta ett stort jobb, man förstör ofta något annat. Det är nog så att jag inte har ett så strukturerat sätt att arbeta med CSS, det underlättar säkert att jobba mer med klasser.

Hade problem med att få till navigeringslisten, att den skulle vara fix men samtidigt ha rätt storlek. Trots hjälp av ramverk så tog det lång tid.

Sen funderar jag på hur man ska få sin responsiva webbplats att fungera på små terminaler med hög upplösning? Verkar inte fungera så bra att utgå från pixels. När jag testkörde på olika små terminaler, i Google Dev Tools emulator, så blev det väldigt smått. Ska man använda em:s istället kanske?

**Vad tycker du om CSS-ramverk i allmänhet och vilka tidigare erfarenheter har du av dem?**

Tycker att de förenklar en hel del. Mitt förhållande till CSS är som sagt inte det bästa. Hade endast lite erfarenhet av dem sedan tidigare. En stor fördel med dem är att man får ett enhetligt utseende mellan olika browsers, tycker jag.

**Vad tycker du om LESS, lessphp och Semantic.gs?**

Väldigt praktiskt med LESS! Det ger möjligheter att skapa en tydlig och överskådlig struktur på sin styling, t.ex. genom att kunna samla all styling som rör en sak på ett ställe (med nästlad styling och variabler). Variabler gör det också lätt att anpassa stylingen. Men, man behöver också ha ett ordnat arbetssätt, t.ex. hur man ska gruppera stylingen i olika filer. Annars kan man få det ganska stökigt ändå. Något jag märkte då jag fick tidsbrist och inte hann tänka över i vilken fil stylingen passade bäst.

Lessphp fungerade bra, men det verkar inte som att den är riktigt uppdaterad till LESS 1.5.0.  Semantic.gs var också väldigt lättanvänt, och bra med lösningar som är beprövade och fungerar på många olika browsers och håller html:n fri från styling.

**Vad tycker du om gridbaserad layout, vertikalt och horisontellt?**

Det gör att webbplatsen får ett ordnat utseende, och det är lätt att jobba med när man ska bygga en responsiv webbplats, enkelt att ändra storlekar bl.a.. Så det kommer vara grunden framöver. 

**Har du några kommentarer om Font Awesome, Bootstrap, Normalize?**

Fanns en del praktiska ikoner i Font Awesome, men tycker kanske att det var lite väl mycket extra funktioner (alla less-filer), förutom själva teckensnittet. Det gjorde att det tog en liten stund att sätta sig in i. Ska kunna hantera "screen readers" också vilket ju är bra för tillgängligheten hos webbplatsen.

Att få ett enhetligt utseende mellan olika browsers kan ju vara frustrerande så Normalize förenklar ju det väldigt och jag kommer definitivt ha med det framöver. 

Tittade på Bootstrap och försökte följa hur de har byggt upp sin bootstrap.less fil. Skapade, som de verkar göra där, egna less-filer för mina komponenter/vyer t.ex. navbar.less, page.less, panel.less ... Tror det underlättar i långa loppet att veta vart man kan hitta sin styling och lätt att lägga till och ta bort. Men det blir många filer att hålla reda på! Tänkte använda en mixin från Bootstrap (jumbotron), men lät bli för den verkade ha så många beroenden. Såg också i Bootstraps tema (layout) att de använder sig av ”templatespråk” som Twig och Mustache, vet inte riktigt vad den stora vinsten är med det jämfört med att använda PHP (vissa verkar tycka att det ger tydligare templates med mindre logik i).

**Beskriv ditt tema, hur tänkte du när du gjorde det, gjorde du några utsvävningar?**

Jag tror inte att jag gjorde så många utsvävningar förutom att jag valde att inte ha någon sidebar. Mitt mål var att temat ska ha stöd för att kunna skapa en layout som liknar Pinterest , så därför införde jag det som jag kallar ”panel”-regioner. Läste också någonstans att den typen av layout är lätt att jobba med när man ska bygga en responsiv webbplats.

**Antog du utmaningen som extra uppgift?**

Nej, det gjorde jag inte. La många timmar på uppgiften, som det var, och hann inte göra något extra.