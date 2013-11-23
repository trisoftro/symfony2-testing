<?php

namespace Context;

use Behat\Behat\Event\SuiteEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';


/**
 * Feature context.
 */
class FeatureContext extends MinkContext //MinkContext if you want to test web
                  implements KernelAwareInterface
{
    private $kernel;
    private $parameters;
    private static $staticKernel;
    use PopupDictionary;

    /**
     * @BeforeSuite
     */
    public static function clearDatabase(SuiteEvent $event)
    {
        $container = self::$staticKernel->getContainer();
        $doctrine = $container->get('doctrine');
        $em = $doctrine->getManager();
        $connection = $em->getConnection();
        $platform = $connection->getDatabasePlatform();
        $connection->executeUpdate($platform->getTruncateTableSQL('blog_posts', true));
    }

    /**
     * @Given /^I wait for page to load$/
     */
    public function iWaitForPageToLoad()
    {
        $this->getSession()->wait(
            $this->getMainContext()->getTimeout(),
            "window.document.readyState == 'interactive'"
        );
    }

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        self::$staticKernel = $kernel;
        $this->kernel = $kernel;
    }

    /**
     * @Given /^I should see "([^"]*)" post$/
     */
    public function iShouldSeePost($number)
    {
        $page = $this->getSession()->getPage();
        $elements = $page->findAll('css', 'tbody tr');
        assertCount((int)$number, $elements);
    }

    /**
     * Depends on jQuery
     * @Given /^I trigger an? "([^"]*)"$/
     */
    public function iTriggerAnEventOn($event, $selector)
    {
        $this->getSession()->evaluateScript(sprintf('$("%s").trigger("%s")', $selector, $event));
    }

//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        $container = $this->kernel->getContainer();
//        $container->get('some_service')->doSomethingWith($argument);
//    }
//
}
