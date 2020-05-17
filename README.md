<p align="center"><img src="https://www.rocmn.nl/themes/custom/rocmn/logo.svg?v=1570171176" width="400"></p>

# Planningstool Ouderavond
De afdeling ICT is een onderdeel van het MID college. Het MID College is één van de 12 Colleges van ROCMN. Op deze afdeling zitten ongeveer 350 studenten. 3-4 keer per jaar organiseert de afdeling een oudergespreksavond om ouders in de gelegenheid te stellen in gesprek te gaan met de studentcoach over de voortgang van de student.

De hoofzaak van de tool is dat ouders een uitnodiging krijgen met instructies. Vervolgens moeten zij
op een webpagina een tijdstip kunnen kiezen voor het gesprek. Dit tijdstip moet achteraf gewijzigd
kunnen worden door de ouders en docenten. Vervolgens moeten er diverse overzicht uitgedraaid
kunnen worden zodat studentcoaches weten wie er wanneer verwacht wordt en in welk lokaal ze
zitten.

## Aan de slag
<ul>
    <li>Installeer <a href="https://www.php.net/downloads">PHP</a>;</li>
    <li>Clone de repo naar je lokale machine;</li>
    <li>In de "_config" folder, verander het bestand "config.example.php" naar "config.php";</li>
    <li>Vul de juiste gegevens in.</li>
</ul>

## Hoe het werkt
<ol>
    <li>Het begint allemaal bij "index.php" in de root folder. Hier wordt het bestand "bootstrap.php" ingeladen.</li>
    <li>"Bootstrap.php" laad alle benodigde bestanden in, zoals de database connectie, de routing, en eventuele hulp functies.</li>
    <li>De folder "routes" in de root folder van het project bevat het bestand waar je routes kan registreren. Door deze te registreren geef je aan welke pagina wordt ingeladen als de gebruiker naar een bepaalde route navigeerd.</li>
    <li>In de folder "pages" kan je pagina's plaatsen die worden geladen als de gebruiker naar de desbetreffende route navigeerd. Deze bestanden kunnen alle logica bevatten om de gewenste data naar de gebruiker te sturen.</li>
</ol>

## Endpoints
<b>Host:</b> https://o8d-api.bradleyoosterveen.nl

<b>Routes:</b>

*   <b>/signin</b>
    <br/>
    Request: POST
    <br/>
    Body: email, password

*   <b>/signout</b>
    <br/>
    Request: GET
    <br/>
    Header: token

*   <b>/calendar/insert</b>
    <br/>
    Request: POST
    <br/>
    Header: token
    Body: student_id, date, time, room

*   <b>/calendar/delete</b>
    <br/>
    Request: POST
    <br/>
    Header: token
    Body: id

*   <b>/calendar/edit</b>
    <br/>
    Request: POST
    <br/>
    Header: token
    Body: student_id, date, time, room
    
*   <b>/admin/createnewuser</b>
    <br/>
    Request: POST
    <br/>
    Header: token
    Body: email, password, firstname, insertion, lastname, role
    
Laatste update: 17/05/2020 Om 16:08

## Auteurs
* **Thomas van de Visch** - *Developer* - [Standaard-boos](https://github.com/Standaard-boos)
* **Floris Verdoorn** - *Developer* - [flowwdelapro](https://github.com/flowwdelapro)
* **Gerben Schipper** - *Developer* - [Gschipper](https://github.com/Gschipper)
* **Julian Pasker** - *Developer* - [Juliandroid98](https://github.com/Juliandroid98)
* **Bradley Oosterveen** - *Developer* - [Dakpaneel](https://github.com/Dakpaneel)