Testing
----------------------------------------------------------


In composer json:
```json
    "autoload": {
        "psr-0": { "": "src/", "Context\\": "features/" }
    },
```


Before starting to work with a session:
----------------------
java -jar selenium-server-standalone-2.37.0.jar -browserSessionReuse


Behat
----------------------
@BeforeScenario, @BeforeSuite to prepare the testing environment


bin/behat features/blogpost.feature:7

