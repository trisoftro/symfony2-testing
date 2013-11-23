Feature: edit an article
  In order to keep my blog updated
  As a blog admin
  I need to add new articles

  @javascript
  Scenario: adding and removing an article
    Given I am on "/blogpost"
    And I follow "Create a new entry"
    Then I fill in the following:
      | Title    | testTitle   |
      | Content  | testContent |
    And I press "Create"
    Then I am on "/blogpost"
    And I should see "testTitle"
    And I should see "testContent"
    And I should see "1" post
    Then I press "Delete"
    Then I confirm the popup
    And I should not see "testTitle"


  @javascript
  Scenario Outline: adding and deleting multiple articles
    Given I am on "/blogpost"
    And I follow "Create a new entry"
    And I fill in "Title" with "<title>"
    And I fill in "Content" with "<content>"
    And I press "Create"
    Examples:
      | title     | content |
      | t1        | c1      |
      | t2        | c2      |
      | t3        | c3      |
      | t4        | c4      |
      | t5        | c5      |