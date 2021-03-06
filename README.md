
# Settly-Api
The Settly API is a `RESTFUL` implementation of the task given assignment. This app can be used
for getting resources and API routes. As well as integrating it with any front-end framework.
The goal of this application is to give a `RESTFUL` implementation, so that any front-end
framework will be able to integrate seemlessly with the use of the API endpoints.

## Getting Started with the Settly-Api

There is a `.env-example` file included to see the configurations for the application.

To start with the application run:

`composer update`

`php artisan migrate`

Sending of email with `Mailgun` is also configured.
Screenshot of the recieved email can be found at `public/sample-email`
## Application Structure

| File/Folder |  Description|
|--|--|
| app/classes| contains the apps classes that is used throughout the application.|
| app/models| contains the entity objects mapped to database tables. |
| app/services| contains the service layer, business logic, etc|
| app/values| contains static/constant values used in the application.|
| app/traits| contains traits that are used in the application.|
| app/console/commands| contains the CRON job functions.|
| app/http/requests| contains the 'Request' layer for handling form validations.|
| resources/views/emails| contains the template for sending emails.|


## Contact
You may wish to contact me at paolo.nunal24@gmail.com

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
