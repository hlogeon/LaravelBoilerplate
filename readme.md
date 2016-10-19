# Laravel DDD boilerplate

## Requirements:

* PHP >= 7.0

## Architecture notes

1. Code of application is inside `app/` folder.
2. Configuration files are in `config/` folder. Environment-specific configuration(such as database connections, email providers etc) should be set in `.env` file. Example of `.env` file can be find in the root of the project `.env.example`
3. This boilerplate is using 3-layer DDD architecture and the layers are
 * Application(mixed with Interfaces layer) - The application layer is responsible for driving the workflow of the application, matching the use cases at hand. These operatios are interface-independent and can be both synchronous or message-driven. This layer is well suited for spanning transactions, high-level logging and security.The application layer is thin in terms of domain logic - it merely coordinates the domain layer objects to perform the actual work.
 * Infrastructure(called Core in our case) - In simple terms, the infrastructure consists of everything that exists independently of our application: external libraries, database engine, application server, messaging backend and so on. Also, we consider code and configuration files that glues the other layers to the infrastructure as part of the infrastructure layer. Doctrine configuration and mapping files and implementations of the repository interfaces are part of the infrastructure layer.
 * Domain - The domain layer is the heart of the software, and this is where the interesting stuff happens. There is one package per aggregate, and to each aggregate belongs entities, value objects, domain events, a repository interface and sometimes factories. The structure and naming of aggregates, classes and methods in the domain layer should follow the ubiquitous language, and you should be able to explain to a domain expert how this part of the software works by drawing a few simple diagrams and using the actual class and method names of the source code.

## Common replacements

You can replace packages from this boilerplate as you want. Common changes are:

1. Replace Doctrine ODM with [Doctrine ORM](https://github.com/laravel-doctrine/orm/)
2. Add [Laravel Passport](https://laravel.com/docs/5.3/passport) for Auth
3. Use MySQL instead of MongoDB
4. Add migrations support (just create `database/migrations` folder) and use migrations as described in [Laravel Documentation](https://laravel.com/docs/5.3/migrations)

## Example workflow

1. Create a new Application(e.g User) and describe API. Spend some time here to make API clear, easy to understand
2. Add dummy test cases for your API(should fail)
3. Create your Domain and Implement business logic. Use ubiquitis language(`$user->register()` instead of `$user->create()` etc)
8. Refactor
4. Write Unit tests for your domain
5. Add DTO objects to your Application layer
6. Replace dummy API test with real ones
7. Make your application API pass all the tests
8. Refactor
9. Repeat
