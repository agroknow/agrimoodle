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
 * agm_zebra theme English language strings
 *
 * Based on Zebra theme, modified for Agri-Moodle --tkout
 *
 * @package    theme_agm_zebra
 * @copyright  2012 Agro-Know Technologies
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'agriMoodle theme (based on Zebra)';
$string['choosereadme'] = '<div class="clearfix">
	<h1>agriMoodle Zebra</h1>
        <hr>
	<div style="float:right;margin-left:4px;">
		<img src="agm_zebra/pix/screenshot.jpg" />
	</div>
	<div>
	    <p><span class="warning">Warning:</span>agriMoodle Zebra 2.0+ relies heavily on CSS3 and is <u>NOT recommended</u> for IE6 or below, but then, neither is Moodle 2.0+.</p>
	    <br />
		<h2>About</h2>
		<p><span class="warning">Notice:</span>agriMoodle Zebra is a theme for agriMoodle, adapted by Agro-Know Technologies (tkout), heavily based on the Zebra theme.</p><br/>
		<p>agriMoodle Zebra uses CSS3 <code>@media</code> queries to dynamically reflow the page layout based on screen width.  This custom 2-1-3 (middle, left, right) page layout can display 1, 2, or 3 columns depending on screen width.  It is also compatible with <code>.side-pre-only</code>, <code>.side-post-only</code>, and <code>.content-only</code> body classes in all 3 layouts.</p>
        <br />
        <p>agriMoodle Zebra also provides extensive customization via its settings page, including colors, logos, reflow settings, mobile settings, and a custom CSS field.</p>
		<h2>Parents</h2>
		<p>This theme is built upon Base and integrates the pagelayout and dock from Rebase.</p>
		<h2>Credits</h2>
         <p>agriMoodle Zebra is based off of the original Zebra 2.0 by Danny Wahl.</p>
		<p>Zebra 2.0 is based off of the original Aardvark 1.2 (1.9) by Shaun Daubney @ Newbury-College, Zebra 1.4 (1.9) by Danny Wahl @ iyWare, Aardvark_makeover (2.0) by Mary Evans @ Visible-Expressions, and whatever themes those themes are based off of.</p>
		<h2>License</h2>
		<p>This, and all other themes included in the Moodle core, are licensed under the <a href="http://www.gnu.org/licenses/gpl.html">GNU General Public License</a>.</p>
		<br />
		<p>The underlying page layout, designed independently of Moodle 2.0 by me (Danny Wahl) @ iyWare, and capable of being used standalone, is also licensed under the GNU General Public License.</p>
		<h2>Theme Discussion Forum:</h2>
		<p><a href="http://moodle.org/mod/forum/discuss.php?d=199367">http://moodle.org/mod/forum/discuss.php?d=199367</a></p>
		<h2>Theme Plugin URL:</h2>
                <p><a href="http://moodle.org/plugins/view.php?plugin=theme_agm_zebra">http://moodle.org/plugins/view.php?plugin=theme_agm_zebra</a></p>
                <h2>Theme Credits</h2>
		<p><a href="http://www.agroknow.gr">Agro-Know Technolgoies</a>, Tasos Koutoumanos</p>
                <h2>Don\'t forget to customize your settings!</h2>
                <a href="../admin/settings.php?section=themesettingagmzebra">agriMoodle Zebra Theme Settings</a>
	</div>
</div>
';

$string['region-side-post'] = 'Right';
$string['region-side-pre'] = 'Left';

$string['notes'] = 'Theme notes';
$string['notesdesc'] = '<p>To apply any settings simply press "Save Changes" at the bottom of this page.</p><p>If you do not have Theme Designer Mode enabled you may need to visit the <a href="purgecaches.php">Purge All Caches</a> admin page to force the refresh.</p>';

$string['headerinfo'] = 'Header settings';
$string['headerinfodesc'] = '<p>Change the settings for the header region.</p>';

$string['logourl'] = 'Logo URL';
$string['logourldesc'] = '<p>Input the URL to your logo.</p><p>This can be used in one of three protocol types:<ul><li><p>Moodle Output (relative to theme):</p><p><code>logo/companylogo</code></p></li><li><p>Full path:</p><p><code>http://domain.com/theme/image.php?theme=agm_zebra&image=logo&rev=1&component=theme</code><br /><code>http://domain.com/path/to/image.jpg</code></p></li><li><p>Relative Path:</p><p><code>/path/to/file/companylogo.png</code></p></li></ul></p>';
$string['logourlheight'] = 'Logo image height';
$string['logourlheightdesc'] = '<p>Minimum height for header to provide space for logo image.</p><p>If you do not have a logo you should still leave this at the default to provide space for the profile block.</p>';
$string['backgroundurl'] = 'Background URL';
$string['backgroundurldesc'] = '<p>Input the URL to your body background image.</p><p>This can be used in Moodle Output format (relative to theme), full path, or relative path.</p>';

$string['headeralt'] = 'Alternate text';
$string['headeraltdesc'] = '<p>Text to use instead of the Site Name.</p><p>Hint: Use a space (<code>&amp;nbsp;</code>) to display nothing.</p>';

$string['homeicon'] = 'Show home icon';
$string['homeicondesc'] = '<p>Show the home icon at the beginning of the custom menu.</p>';
$string['callink'] = 'Calendar link';
$string['callinkdesc'] = '<p>Show the date with a link to the calendar at the end of the custom menu.</p>';
$string['dateformat'] = 'Date format';
$string['dateformatdesc'] = '<p>Note: This requires <a href="#admin-callink"><code>callink</code></a> to be enabled.</p><p>Set a format for displaying the date in the custom menu.  For more information on the date() function please see the php.net docs <a href="http://php.net/manual/en/function.date.php" title="PHP: date - Manual">here</a>.</p>';

$string['userpic'] = 'Show user picture';
$string['userpicdesc'] = '<p>Show the user\'s profile picture in the header</p>';

$string['colorsinfo'] = 'General colors settings';
$string['colorsinfodesc'] = '<p>Change the settings for the colors of the page.</p><p>You can use any valid color type like <code>red</code>, <code>#FF0000</code>, <code>rgb(0, 255, 255)</code>, or <code>rgba(0, 255, 255, 1.0)</code>.</p>';

$string['bodybgcolor'] = 'Body background color';
$string['bodybgcolordesc'] = '<p>Main background color of the page.</p><p>This is applied to the <code>&lt;body&gt;</code> tag.</p>';
$string['linkcolor'] = 'Links color';
$string['linkcolordesc'] = '<p>Links and menu color.</p><p>This is applied to all links (in and out of page content) except the custommenu and the custommenu background with the exception of the "date".</p>';
$string['hovercolor'] = 'Hover color';
$string['hovercolordesc'] = '<p>Hovering color.</p><p>This is applied to all links (in and out of the page content) and the custommenu.</p>';
$string['fontcolor'] = 'Font color';
$string['fontcolordesc'] = '<p>Primary font and label color.</p><p>This is applied to all labels and fonts that do not have a specific class that overrides the color like <code>.warning</code> or <code>.notifysuccess</code>.  This is also applied to the background color of the "date" on the custommenu.</p>';
$string['contentbgcolor'] = 'Page background color';
$string['contentbgcolordesc'] = '<p>Content background color.</p><p>This is applied to different elements depending on the current view (please see pagelayout.css for more details) but generally this is the content of the page.  This is also applied to the custommenu links color.</p>';
$string['columnbgcolor'] = 'Columns background color';
$string['columnbgcolordesc'] = '<p>Column(s) background color.</p><p>This is applied to different elements depending on the current view (please see pagelayout.css for more details) but generally this is the region-pre and region-post (a.k.a. block areas).</p>';
$string['headerbgcolor'] = 'Header background color';
$string['headerbgcolordesc'] = '<p>Header background color.</p>';
$string['footerbgcolor'] = 'Footer background color';
$string['footerbgcolordesc'] = '<p>Footer background color.</p><p>Using <code>transparent</code> will cause the footer to display the value of <code>contentbgcolor</code> not <code>bodybgcolor</code>.  This should be set to the same value as <code>bodybgcolor</code> for a transparent effect.</p>';

$string['moodlecolorsinfo'] = 'Moodle colors settings';
$string['moodlecolorsinfodesc'] = '<p>Change specific colors that are defined in the Moodle core and are outside of the general colors defined above.  These include things like <code>.notifysuccess</code> and calendar event type colors.  These probably do not need to be adjusted unless you have a specific conflict with the general color settings above.</p>';

$string['calcourse'] = 'Calendar course events';
$string['calcoursedesc'] = '<p>Sets the color used to represent course events in the calendar.</p>';
$string['calglobal'] = 'Calendar global events';
$string['calglobaldesc'] = '<p>Sets the color used to represent global events in the calendar.</p>';
$string['calgroup'] = 'Calendar group events';
$string['calgroupdesc'] = '<p>Sets the color used to represent group events in the calendar.</p>';
$string['caluser'] = 'Calendar user events';
$string['caluserdesc'] = '<p>Sets the color used to represent user events in the calendar.</p>';
$string['calweekend'] = 'Calendar weekend color';
$string['calweekenddesc'] = '<p>Sets the font color used for weekends on the calendar.</p>';
$string['okfontcolor'] = 'OK/Good font color';
$string['okfontcolordesc'] = '<p>Sets the font color used for things that worked like saving settings, etc...  Specific examples are <code>.green</code> and <code>.notifysuccess</code>.</p>';
$string['warningfontcolor'] = 'Warning font color';
$string['warningfontcolordesc'] = '<p>Sets the font color used for things that generate a warning.  Generally this is <code>.statuswarning</code>.</p>';
$string['seriousfontcolor'] = 'Serious font color';
$string['seriousfontcolordesc'] = '<p>Sets the font color used for things that generate a serious notice.  Generally this is <code>.statusserious</code>.</p>';
$string['criticalfontcolor'] = 'Critical font color';
$string['criticalfontcolordesc'] = '<p>Sets the font color used for things that generate a critical notice.  Generally this is <code>.statuscritical</code>, <code>.red</code>, and <code>.notifyproblem</code>.</p>';

$string['schemeinfo'] = 'Color scheme settings';
$string['schemeinfodesc'] = '<p>Change the settings for the color scheme of the page.</p>';

$string['colorscheme'] = 'Color scheme';
$string['colorschemedesc'] = '<p>Gradients and highlights.</p><p>Note: Safari 4 does not accept a fixed height gradient so it will always display as "none".</p>';
$string['menucolorscheme'] = 'Menu color scheme';
$string['menucolorschemedesc'] = '<p>Gradient of menu.</p>';

$string['schemenone'] = 'None';
$string['schemedark'] = 'Dark';
$string['schemelight'] = 'Light';

$string['columninfo'] = 'Layout Settings';
$string['columninfodesc'] = '<p>Change the settings for the layout of the page.  To test your settings simply resize your browser window or rotate the orientation of your phone/tablet.</p><figure style="float: left;"><img src="../theme/image.php?theme=agm_zebra&image=core/one_column&component=theme"/><figcaption><ul><li>top: <code>region-main</code></li><li>middle: <code>region-pre</code></li><li>bottom: <code>region-post</code></li></ul></figcaption></figure><figure style="float: left;"><img src="../theme/image.php?theme=agm_zebra&image=core/two_columns&component=theme"/><figcaption><ul><li>top left: <code>region-pre</code></li><li>bottom left: <code>region-post</code></li><li>right: <code>region-main</code></li></ul></figcaption></figure><figure style="float: left;"><img src="../theme/image.php?theme=agm_zebra&image=core/three_columns&component=theme"/><figcaption><ul><li>left: <code>region-pre</code></li><li>center: <code>region-main</code></li><li>right: <code>region-post</code></li></ul></figcaption></figure><br style="clear: left;" />';

$string['twocolmin'] = 'Two column min width';
$string['twocolmindesc'] = '<p>Min width for two column layout.</p>';
$string['threecolmin'] = 'Three column min width';
$string['threecolmindesc'] = '<p>Min width for three column layout.  Display order is:</p>';
$string['pagemaxwidth'] = 'Page max width';
$string['pagemaxwidthdesc'] = '<p>Max width for page content.</p>';
$string['colwidth'] = 'Column width';
$string['colwidthdesc'] = '<p>Width of columns.  This is <code>region-pre</code> and <code>region-post</code>.</p>';

$string['simplelogin'] = 'Use a basic login form';
$string['simplelogindesc'] = '<p>Enabling this option will simply the login page layout by not displaying the header, footer, navbar, lang menu, or custommenu.  This option can be use for sites that require authentication before access to those items is granted.</p>';

$string['compatinfo'] = 'Browser compatibility settings';
$string['compatinfodesc'] = '<p>Various settings to attempt to improve browser compatibility with this theme for a more consistent user experience.</p>';

$string['userespond'] = 'Include respond.js in footer';
$string['useresponddesc'] = '<p><a href="https://github.com/scottjehl/Respond#readme">Respond.js</a> will attempt to parse the <code>@media</code> queries in the CSS and serve the proper one to browsers that do not natively support them (like IE8 and below).</p>';

$string['usecf'] = 'Prompt users to install Google Chrome Frame';
$string['usecfdesc'] = '<p>Google <a href="http://code.google.com/chrome/chromeframe/">Chrome Frame</a> is an Internet Explorer plugin that installs the Chromium Rendering engine on older browsers and enables them to use modern web technologies.</p>';

$string['cfmaxversion'] = 'Maximum IE version';
$string['cfmaxversiondesc'] = '<p>Note: <a href="#admin-usecf"><code>usecf</code></a> must be enabled for this to work.</p><p>This is the maximum version of Internet Explorer to prompt users to install Chrome Frame.  Versions above this will not be prompted.</p>';

$string['miscinfo'] = 'Misc. settings';
$string['miscinfodesc'] = '<p>Change the settings for miscellaneous things.</p>';

$string['useautohide'] = 'Include Autohide CSS';
$string['useautohidedesc'] = '<p>Include the Autohide rules for users in Edit Mode.</p><p>Read more about this feature <a href="http://moodle.org/mod/forum/discuss.php?d=197470">here</a> or <a href="http://www.moodlenews.com/2012/a-moodle-administrators-dream-come-true-autohide-for-moodle-2-2/">here</a>.</p>';

$string['editingnotify'] = 'Include Editing Mode CSS';
$string['editingnotifydesc'] = '<p>This is a complementary series of rules for <a href="#admin-useautohide"><code>Autohide</code></a> that provides a visual indicator that the user is in Edit Mode.</p>';

$string['customcss'] = 'Custom CSS';
$string['customcssdesc'] = '<p>Input any custom CSS here.</p><p>CSS input here is the very last thing called on the page and should not be overwritten by any other rules.  If your rules are not displaying please try the following:<ol><li>check your syntax</li><li>add <code>!important</code> to your rule</li><li>manually append the rule to extra.css</li></ol></p>';

$string['enablezoom'] = 'Enable page zoom';
$string['enablezoomdesc'] = '<p>Enable page zooming for mobile devices.</p>';

$string['branding'] = 'Hide footer logos';
$string['brandingdesc'] = '<p>Hide the branded logos in the footer.</p><p>These links are to sites that either sponsored or contributed directly to development of this theme.  Full credits can be found in the readme when selecting this theme.</p>';

$string['menuhome'] = 'Home';
$string['menumyhome'] = 'My Home';
$string['menutoday'] = 'Today\'s date';