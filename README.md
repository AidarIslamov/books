### Paths:
`/` frontend

`/admin` admin side(backend) - not used, but may if need ))


### Notifications (subscriptions)
configurations in file: ```common/config/params.php``` ['sms_service']
method for hand testing by book id (console command): ```php yii test/sms-test 22``` where 22 - is book.id



## STATISTIC
url ``http://books/site/report``

\frontend\controllers\SiteController::actionReport
(https://github.com/AidarIslamov/books/blob/1be439b038c23996926b187376fcb506bceaa798/frontend/controllers/SiteController.php#L99)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
