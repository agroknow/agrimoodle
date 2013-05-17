@core @core_backup
Feature: Backup Moodle courses
  In order to save and store course contents
  As an admin
  I need to create backups of courses

  Background:
    Given the following "courses" exists:
      | fullname | shortname | category |
      | Course 1 | C1 | 0 |
    And I log in as "admin"

  @javascript
  Scenario: Backup a course providing options
    When I backup "Course 1" course using this options:
    Then I should see "Restore"
    And I click on "Restore" "link" in the ".backup-files-table" "css_element"
    And I should see "URL of backup"
    And I should see "Anonymize user information"

  @javascript
  Scenario: Backup a course with default options
    When I backup "Course 1" course using this options:
      | Filename | test_backup.mbz |
      | Include calendar events | 0 |
      | Include course logs | 1 |
      | setting_section_section_5_userinfo | 0 |
      | setting_section_section_5_included | 0 |
    Then I should see "Restore"
    And I click on "Restore" "link" in the ".backup-files-table" "css_element"
    And I should not see "Section 3"
    And I press "Continue"
    And I click on "Continue" "button" in the ".bcs-current-course" "css_element"
    And I click on "//div[contains(concat(' ', @class, ' '), ' fitem ')][contains(., 'Include calendar events')]/descendant::img" "xpath_element"
    And I click on "setting_root_logs" "checkbox" in the "//div[contains(@class, 'fitem')][contains(., 'Include course logs')]" "xpath_element"
    And I press "Cancel"
    And I click on "Cancel" "button" in the ".confirmation-dialogue" "css_element"
