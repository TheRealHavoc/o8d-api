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
    Beschrijving: Voor het inloggen van gebruikers.
    <br/>
    Request: POST
    <br/>
    Body: email, password

*   <b>/signout</b>
    <br/>
    Beschrijving: Voor het uitloggen van gebruikers.
    <br/>
    Request: GET
    <br/>
    Auth: token

*   <b>/calendar/insert (WILL BE REPLACED)</b>
    <br/>
    Beschrijving: Toevoegen van een calender item.
    <br/>
    Request: POST
    <br/>
    Auth: token
    <br/>
    Body: student_id, date, time, room

*   <b>/calendar/delete (WILL BE REPLACED)</b>
    <br/>
    Beschrijving: Verwijderen van een calender item.
    <br/>
    Request: POST
    <br/>
    Auth: token
    <br/>
    Body: id

*   <b>/calendar/edit (WILL BE REPLACED)</b>
    <br/>
    Beschrijving: Bewerken van een calender item.
    <br/>
    Request: POST
    <br/>
    Auth: token
    <br/>
    Body: student_id, date, time, room
    
*   <b>/meeting/index</b>
    <br/>
    Beschrijving: Tonen van ouderavonden.
    <br/>
    Request: GET
    <br/>
    Header: token
    
*   <b>/meeting/add</b>
    <br/>
    Beschrijving: Registreren van een ouderavond.
    <br/>
    Request: POST
    <br/>
    Auth: token
    <br/>
    Body: date (yyyy-mm-dd), startTime (hh:mm:ss), endTime (hh:mm:ss), coach (userId), room
    
*   <b>/meeting/addwithusers</b>
    <br/>
    Beschrijving: Registreren van een ouderavond en linken van gebruikers aan ouderavond.
    <br/>
    Request: POST
    <br/>
    Auth: token
    <br/>
    Body: date (yyyy-mm-dd), startTime (hh:mm:ss), endTime (hh:mm:ss), coach (userId), room, users (json array met user id's: "[4,6,8,9]")
    
*   <b>/meeting/cancel</b>
    <br/>
    Beschrijving: Het annuleren van een ouderavond.
    <br/>
    Request: POST
    <br/>
    Auth: token
    <br/>
    Body: id
    
*   <b>/block/add</b>
    <br/>
    Beschrijving: Voor het toevoegen van een gebruiker aan een gesprek binnen een ouderavond.
    <br/>
    Request: POST
    <br/>
    Auth: token
    <br/>
    Body: meetingID, startTime (hh:mm:ss), endTime (hh:mm:ss)
    
*   <b>/block/setUnavailable</b>
    <br/>
    Beschrijving: Onbeschikbaar zetten van een gebruiker van een ouderavond.
    <br/>
    Request: POST
    <br/>
    Auth: token
    <br/>
    Body: id (meetingID)
    
*   <b>/admin/createnewuser</b>
    <br/>
    Beschrijving: Aanmaken van een nieuwe gebruiker.
    <br/>
    Request: POST
    <br/>
    Auth: token
    <br/>
    Body: email, password, firstname, insertion, lastname, role
    
*   <b>/admin/createnewstudent</b>
    <br/>
    Beschrijving: Aanmaken van een nieuw student.
    <br/>
    Request: POST
    <br/>
    Auth: token
    <br/>
    Body: firstname, insertion, lastname, studentNr, class, coach, parent
    
Laatste update: 18/05/2020 Om 22:36

## Auteurs
* **Thomas van de Visch** - *Developer* - [Standaard-boos](https://github.com/Standaard-boos)
* **Floris Verdoorn** - *Developer* - [flowwdelapro](https://github.com/flowwdelapro)
* **Gerben Schipper** - *Developer* - [Gschipper](https://github.com/Gschipper)
* **Julian Pasker** - *Developer* - [Juliandroid98](https://github.com/Juliandroid98)
* **Bradley Oosterveen** - *Developer* - [Dakpaneel](https://github.com/Dakpaneel)
