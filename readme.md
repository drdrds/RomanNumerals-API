# Roman Numerals API Task
This development task is based on the Roman Numeral code kata which may have already been
completed during this recruitment process. This task requires you to build a JSON API and
so any HTML, CSS or JavaScript that is submitted will not be reviewed.
 
## Brief
Our client (Numeral McNumberFace) requires a simple API which will convert an integer to its roman numeral counterpart. After our discussions with the client, we have discovered that the solution will contain 3 API endpoints, and will only support integers ranging from 1 to 3999. The client wishes to keep track of conversions so they can determine which is the most frequently converted integer, and the last time this was converted.
 
### Endpoints
 1. Accepts an integer, converts it to a roman numeral, stores it in the database and returns the response.
 /api/convert/{integer}
 2. Lists all of the recently converted integers.
 /api/recent - shows all conversion made in the last 60 minutes (the default).
 /api/recent?minutes=10  - shows all conversiona made in the last 10minutes.
 
 3. Lists the top 10 converted integers.
 /api/top10
 
## What we are looking for
 - Use of MVC components (View in this instance can be, for example, a fractal transformer).
 - Use of either Fractal or Dingo.
 - Use of Eloquent, Requests and Routes.
 - A class which implements the supplied interface.
 - The supplied PHPUnit test passing.
 - Clean, well-commented code.
 