Testing
----------------------------------------------------------
Don't forget in your composer json:
```json
    "autoload": {
        "psr-0": { "": "src/", "Context\\": "features/" }
    }
```


Before starting to assert your features with Selenium2
----------------------------
Download here: http://selenium.googlecode.com/files/selenium-java-2.37.0.zip

Run it like this in a separate terminal:
```
java -jar selenium-server-standalone-2.37.0.jar -browserSessionReuse
```

- Don't forget you need to put before the Scenario @javascript

Behat
----------------------
@BeforeScenario, @BeforeSuite to prepare the testing environment

Note: BeforeSuite is run statically which means, if you use the Symfony2 Kernel, you have to set the kernel statically in the class.

Run a specific scenario:
```
bin/behat features/blogpost.feature:7
```

