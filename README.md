# Cinema Guide API

A simple RESTful JSON API for accessing cinema, movie and session information.
Built & tested with:
 - Laravel
 - Composer
 - MySQL
 - Git
 - Docker (Laradock)
 - Apache2
 - Postman
 - phpMyAdmin

### Unaddressed Considerations
 - Error handling
   - A lot left to be done here, I have only changed some of the error messages to return JSON rather than HTML, everything else is standard laravel.
   - Some methods do not provide especially useful feedback.
     For example logout will only ever return `{"data": "User logged out."}`
 - More than one level of authorisation would be helpful in restricting access to the administrative functions.

# API Documentation

## Authentication
An authentication token is required to access the features of this api. These methods provide a way to register, login and logout.
The authentication token you recieve from logging in will need to be present as an Authorization header in all other requests made to this API.
Example header: `Authorization: Bearer y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ`.

#### Register (POST)
Creates a new user and automatically logs them in, providing an authentication token in the response.
##### Sample Request: (/api/register)
Headers: 
`Accept: application/json`
`Content-Type: application/json`
Body:
```JSON
{ "name": "Brendan",
  "email": "brendan@gmail.com",
  "password": "password",
  "password_confirmation": "password" }
```
##### Sample Success (201 Created)
```JSON
{ "data": {
    "name": "Brendan",
    "email": "brendan@gmail.com",
    "updated_at": "2018-02-08 18:46:20",
    "created_at": "2018-02-08 18:46:20",
    "id": 2,
    "api_token": "y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ" }}
```
##### Sample Error (422 Unprocessable Entity)
```JSON
{ "message": "The given data was invalid.",
    "errors": {
        "name": [
            "The name field is required."
        ],
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required." ]}}
```

#### Login (POST)
Logs a user in by creating and returning an authentication token.
##### Sample Request (/api/login)
Headers: 
`Accept: application/json`
`Content-Type: application/json`
Body:
```JSON
{ "email": "brendan@gmail.com",
  "password": "password" }
```
##### Sample Success (200 OK)
```JSON
{ "data": {
    "id": 1,
    "name": "Brendan Kelly",
    "email": "brendan@pion.com.au",
    "created_at": "2018-02-08 15:59:23",
    "updated_at": "2018-02-08 19:01:54",
    "api_token": "y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ" }}
```
##### Sample Error (422 Unprocessable Entity)
```JSON
{  "message": "The given data was invalid.",
   "errors": {
        "email": [
            "These credentials do not match our records." ]}}
```

#### Logout (POST)
Logs out a user by invalidating their current auth token.
##### Sample Request (/api/logout)
Headers: 
`Accept: application/json`
`Content-Type: application/json`
Body:
```JSON
{ "api_token":"y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ" }
```
##### Sample Success (200 OK)
```JSON
{ "data":"User logged out." }
```

## Cinemas

#### Cinemas (GET)
Gets a paginated list of all cinemas.
##### Sample Request (/api/cinemas)
Headers: 
 `Authorization: Bearer y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ`
##### Sample Success (200 OK)
```JSON
{  "data": [
    { "id": 1,
      "name": "Ward Ltd",
      "address": "472 Wintheiser Stravenue\nEast Grayson, WV 33325-6123",
      "url": "https://www.connelly.com/nobis-sapiente-ea-libero-aut",
      "phone": "378.480.0984 x5944",
      "latitude": "80.428054",
      "longitude": "55.863457",
      "google_maps_link": "http://www.google.com/maps/place/80.428054,55.863457"
    },
    ...
    { "id": 15,
      "name": "Schmeler Inc",
      "address": "5157 Ansel Gardens\nLake Jackelineside, ND 10663",
      "url": "http://sauer.biz/cum-autem-quaerat-rerum-est-natus-ex-sunt-possimus.html",
      "phone": "387.227.7904 x034",
      "latitude": "-87.213329",
      "longitude": "-81.090282",
      "google_maps_link": "http://www.google.com/maps/place/-87.213329,-81.090282"
    }
  ],
  "links": {
    "first": "http://localhost/api/cinemas?page=1",
    "last": "http://localhost/api/cinemas?page=6",
    "prev": null,
    "next": "http://localhost/api/cinemas?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 6,
    "path": "http://localhost/api/cinemas",
    "per_page": 15,
    "to": 15,
    "total": 80 }}
```
#### Cinema/{name} (GET)
Gets details for a single cinema.
##### Sample Request (/api/cinema/Crona Group)
Headers: 
 `Authorization: Bearer y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ`
##### Sample Success (200 OK)
```JSON
{ "data": {
  "id": 4,
  "name": "Crona Group",
  "address": "32813 Aurelie Manor\nSmithamton, OR 66463",
  "url": "https://www.murphy.org/atque-assumenda-sed-voluptas-voluptas-atque-facere",
  "phone": "+17356049974",
  "latitude": "35.096155",
  "longitude": "178.192304",
  "google_maps_link": "http://www.google.com/maps/place/35.096155,178.192304" }}
```
#### Cinema/{name}/movies (GET)
Gets all movies and session times for a specific cinema.
##### Sample Request (/api/cinema/Bogisich PLC/movies)
Headers: 
 `Authorization: Bearer y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ`
##### Sample Success (200 OK)
```JSON
{ "data": {
  "id": 12,
  "name": "Bogisich PLC",
  "address": "920 Prohaska Ridges Apt. 838\nErnserborough, WA 92021",
  "url": "https://smith.com/qui-qui-est-consequatur-qui-inventore-ab.html",
  "phone": "(315) 364-1435 x103",
  "latitude": "49.168026",
  "longitude": "165.799213",
  "google_maps_link": "http://www.google.com/maps/place/49.168026,165.799213",
  "movies": [
    { "id": 5,
      "title": "Synchronised actuating contingency",
      "description": "Mock Turtle, 'but if they do, why then they're a kind of rule, 'and vinegar that makes you forget.",
      "poster": "http://greenfelder.com/",
      "trailer": "http://www.langosh.net/autem-voluptas-sint-sit-maxime-ex-est-repellendus-itaque",
      "sessions": [
        { "id": 801,
          "date": "2018-01-11",
          "time": "02:51:27",
          "cinema_name": "Bogisich PLC",
          "movie_title": "Synchronised actuating contingency"
        }
      ]
    },
    ...
    { "id": 35,
      "title": "Sharable mobile budgetarymanagement",
      "description": "Dormouse,' the Queen till she had never forgotten that, if you could manage it?) 'And what are.",
      "poster": "http://ankunding.net/aliquid-quidem-eum-et-voluptatum-id-architecto-perferendis-et.html",
      "trailer": "http://ward.com/accusamus-quam-perferendis-in-fugiat-sed-natus",
      "sessions": [
        { "id": 77,
          "date": "2018-01-18",
          "time": "12:55:10",
          "cinema_name": "Bogisich PLC",
          "movie_title": "Sharable mobile budgetarymanagement" }]}]}}
```
#### Cinema/{name}/movies/{date} (GET)
Gets all movies and sessions at a cinema on a specific date.
Allows the use of partial dates e.g. "2018-02" will retrieve all movies and sessions for February 2018.
##### Sample Request (/api/cinema/Bogisich PLC/movies/2018-01-11)
Headers: 
 `Authorization: Bearer y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ`
##### Sample Success (200 OK)
```JSON
{ "data": {
  "id": 12,
  "name": "Bogisich PLC",
  "address": "920 Prohaska Ridges Apt. 838\nErnserborough, WA 92021",
  "url": "https://smith.com/qui-qui-est-consequatur-qui-inventore-ab.html",
  "phone": "(315) 364-1435 x103",
  "latitude": "49.168026",
  "longitude": "165.799213",
  "google_maps_link": "http://www.google.com/maps/place/49.168026,165.799213",
  "movies": [
    { "id": 5,
      "title": "Synchronised actuating contingency",
      "description": "Mock Turtle, 'but if they do, why then they're a kind of rule, 'and vinegar that makes you forget.",
      "poster": "http://greenfelder.com/",
      "trailer": "http://www.langosh.net/autem-voluptas-sint-sit-maxime-ex-est-repellendus-itaque",
      "sessions": [
        { "id": 801,
          "date": "2018-01-11",
          "time": "02:51:27",
          "cinema_name": "Bogisich PLC",
          "movie_title": "Synchronised actuating contingency" }]}]}}
```

## Movies

#### Movies (GET)
Gets a paginated list of all movies.
##### Sample Request (/api/movies)
Headers: 
 `Authorization: Bearer y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ`
##### Sample Success (200 OK)
```JSON
{ "data": [
    { "id": 1,
      "title": "Mock Turtle sighed.",
      "description": "Miss, this here ought to be treated with respect. 'Cheshire Puss,' she began, in a natural way. 'I.",
      "poster": "http://www.kuvalis.info/velit-provident-cumque-error-fuga-hic-ducimus-natus-id.html",
      "trailer": "https://www.mitchell.org/consequuntur-quasi-dolore-occaecati-animi-et-dolorem"
    },
    ...
    { "id": 15,
      "title": "The Mouse only.",
      "description": "King triumphantly, pointing to the jury. They were just beginning to see if he were trying which.",
      "poster": "https://beatty.com/et-earum-possimus-iusto-aliquam-magni-provident-repellendus.html",
      "trailer": "http://skiles.com/non-non-nihil-voluptas-quod-voluptatem-libero.html"
    }
  ],
  "links": {
    "first": "http://localhost/api/movies?page=1",
    "last": "http://localhost/api/movies?page=3",
    "prev": null,
    "next": "http://localhost/api/movies?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 3,
    "path": "http://localhost/api/movies",
    "per_page": 15,
    "to": 15,
    "total": 40 }}
```
#### Movie/{title} (GET)
Gets info on a movie.
##### Sample Request (/api/movie/Ergonomic even-keeled solution)
Headers: 
 `Authorization: Bearer y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ`
##### Sample Success (200 OK)
```JSON
{ "data": {
  "id": 6,
  "title": "Ergonomic even-keeled solution",
  "description": "Alice felt dreadfully puzzled. The Hatter's remark seemed to follow, except a little timidly, for.",
  "poster": "http://crooks.org/",
  "trailer": "http://www.homenick.info/" }}
```

## Sessions
#### Sessions (GET)
Gets a paginated list of all sessions.
##### Sample Request (/api/sessions)
Headers: 
 `Authorization: Bearer y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ`
##### Sample Success (200 OK)
```JSON
{ "data": [
    { "id": 1,
      "date": "2018-01-14",
      "time": "15:30:04",
      "cinema_name": "Boehm LLC",
      "movie_title": "CHORUS. (In which."
    },
    ...
    { "id": 15,
      "date": "2018-01-13",
      "time": "02:08:07",
      "cinema_name": "Hilll Ltd",
      "movie_title": "I said \"What."
    }
  ],
  "links": {
    "first": "http://localhost/api/sessions?page=1",
    "last": "http://localhost/api/sessions?page=67",
    "prev": null,
    "next": "http://localhost/api/sessions?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 67,
    "path": "http://localhost/api/sessions",
    "per_page": 15,
    "to": 15,
    "total": 1000 }}
```
#### Session/{id} (GET)
Gets info on a single session.
##### Sample Request (/api/session/7)
Headers: 
 `Authorization: Bearer y9eRCNxNxB2RAMOCLGeTnH4efzaOAJlNyS3CyhEwoLbLwZ4txwmRoA1MqkOJ`
##### Sample Success (200 OK)
```JSON
{ "data": {
  "id": 7,
  "date": "2018-01-30",
  "time": "11:26:47",
  "cinema_name": "Cummings, Roberts and Leannon",
  "movie_title": "Organized local instructionset" }}
```
## Generic Errors
##### Resource not found (404 Not Found)
```JSON
{ "error": "Resource not found" }
```
##### User is not authorised (401 Unauthorized)
```JSON
{ "error": "Unauthenticated" }
```
