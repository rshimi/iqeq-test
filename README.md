# Limited Vehicle Management Application

## Setting up the application

### Using Docker

#### Using Docker
You can do this either by using docker with the `compose.yaml` file
by running the following command in the projects root directory.
```
docker compose up -d
```
This will create a sql container that can be connected to on `127.0.0.1:56438` with the database `iqeq_test`

#### Using an exiting sql databse
If you don't want to use docker and you already have a database set up, simply change the
`DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` in the `.env` file to the desired names.


### Creating existing data for tests

Due to time restrictions in memory database is not available for this implementation. Before running the tests and fixtures
it is recomended to run the following command to create a `.env.test.local` file.

``
cp .env .env.test.local
``

This way you can alter the `DATABASE_URL` in this file to database for the feature tests to use.

When done run the following commands to create the test database to be used.:

``
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:migrations:migrate
``

Fixtures have been provided to create data for this application, these can be created by using the following command
in the projects root directory to generate data.
```
php bin\console --env=test doctrine:fixtures:load
```

### Running Unit and Integration Tests
There are unit and integration tests provided for this application to run these use the following command
```
php bin\phpunit
```

### Populating the database
The database can be 
### Starting the application
Running the following command to start the application, this should be accessible from `127.0.0.1:8000`
```
symfony server:start
```

### Using the application.

### Creating existing data
Fixtures have been provided to create data for this application, these can be created by using the following command
in the projects root directory to generate data.
```
php bin\console doctrine:fixtures:load
```

The following routes are available.

#### Route list

| Route                            | Request type | Needs authentication | Description                                                                                | 
|----------------------------------|--------------|----------------------|--------------------------------------------------------------------------------------------
| /login                           | POST         | no                   | Logs the user in                                                                           | 
| /manufacturer/type/{type}        | GET          | no                   | Lists manufacturers that have a relation to the vehicle information with the assigned type | 
| /vehicle/information             | GET          | no                   | Lists all vehicle information                                                              | 
| /vehicle/information/{vehicleId} | GET          | no                   | Gets the vehicle information with the id                                                   | 
| /vehicle/information/{vehicleId} | PUT          | yes                  | Updates the vehicle information with data in the payload                                   | 

##### Routes and Tables that should be present
Normally more routes should be available offering basic CRUD functionality but these weren't requested.
These would be simple operations like adding Create and Update functionality for the manufacturers and creation of vehicle information.

Regarding tables, the approach taken was an assumption that other pieces of information such as engines for example
would be stored on other tables like `vehicle_engines` as a related entity so the database would be less cluttered and easily found,
but as the request was to limit this to 10 parameters this table wasn't included but the manufacturers was added to show how this could be achieved
