<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Navigation steps definitions.
 *
 * @package    core
 * @category   test
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../behat/behat_base.php');

/**
 * Steps definitions to navigate through the navigation tree nodes.
 *
 * @package    core
 * @category   test
 * @copyright  2012 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_navigation extends behat_base {

    /**
     * Expands the selected node of the navigation tree that matches the text.
     * @Given /^I expand "(?P<nodetext_string>(?:[^"]|\\")*)" node$/
     *
     * @throws ElementNotFoundException Thrown by behat_base::find
     * @param string $nodetext
     */
    public function i_expand_node($nodetext) {

        // This step is useless with Javascript disabled as Moodle auto expands
        // all of tree's nodes; adding this because of scenarios that shares the
        // same steps with and without Javascript enabled.
        if (!$this->running_javascript()) {
            return false;
        }

        $xpath = "//ul[contains(concat(' ', normalize-space(@class), ' '), ' block_tree ')]" .
            "/child::li" .
            "/child::p[contains(concat(' ', normalize-space(@class), ' '), ' branch')]" .
            "/child::span[contains(concat(' ', normalize-space(.), ' '), '" . $nodetext . "')]" .
            "|" .
            "//ul[contains(concat(' ', normalize-space(@class), ' '), ' block_tree ')]" .
            "/descendant::li[not(contains(concat(' ', normalize-space(@class), ' '), ' collapsed'))]" .
            "/descendant::li" .
            "/child::p[contains(concat(' ', normalize-space(@class), ' '), ' branch')]" .
            "/child::span[contains(concat(' ', normalize-space(.), ' '), '" . $nodetext . "')]";

        $node = $this->find('xpath', $xpath);
        $node->click();
    }

}
