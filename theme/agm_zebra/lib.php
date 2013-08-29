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
 * agm_zebra theme library functions
 *
 * Based on Zebra theme, modified for Agri-Moodle --tkout
 *
 * @package    theme_agm_zebra
 * @copyright  2012 Agro-Know Technologies
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * This is the postprocess function for the theme
 *
 * @param string $css Incoming CSS to process
 * @param stdClass $theme The theme object
 * @return string The processed CSS
 */
function agm_zebra_process_css($css, $theme) {

    //Get the path to the background url from settings
    if (!empty($theme->settings->backgroundurl)) {
        $backgroundurl = $theme->settings->backgroundurl;
    } else {
        $backgroundurl = null;
    }
    $css = agm_zebra_set_backgroundurl($css, $backgroundurl);

    //Get color scheme type from settings
    if (!empty($theme->settings->colorscheme)) {
        $colorscheme = $theme->settings->colorscheme;
    } else {
        $colorscheme = null;
    }
    $css = agm_zebra_set_colorscheme($css, $colorscheme);

    //Get menu color scheme type from settings
    if (!empty($theme->settings->menucolorscheme)) {
        $menucolorscheme = $theme->settings->menucolorscheme;
    } else {
        $menucolorscheme = null;
    }
    $css = agm_zebra_set_menucolorscheme($css, $menucolorscheme);

    //Get the homeiconcolor from menucolorscheme
    if (!empty($theme->settings->menucolorscheme)) {
        $menucolorscheme = $theme->settings->menucolorscheme;
    } else {
        $menucolorscheme = null;
    }
    $css = agm_zebra_set_homeiconcolor($css, $menucolorscheme);

    //Get the hmenuiconcolor from menucolorscheme
    if (!empty($theme->settings->menucolorscheme)) {
        $menucolorscheme = $theme->settings->menucolorscheme;
    } else {
        $menucolorscheme = null;
    }
    $css = agm_zebra_set_hmenuiconcolor($css, $menucolorscheme);

    //Get the vmenuiconcolor from menucolorscheme
    if (!empty($theme->settings->menucolorscheme)) {
        $menucolorscheme = $theme->settings->menucolorscheme;
    } else {
        $menucolorscheme = null;
    }
    $css = agm_zebra_set_vmenuiconcolor($css, $menucolorscheme);

    //Get the body background color from settings
    if (!empty($theme->settings->bodybgcolor)) {
        $bodybgcolor = $theme->settings->bodybgcolor;
    } else {
        $bodybgcolor = null;
    }
    $css = agm_zebra_set_bodybgcolor($css, $bodybgcolor);

    //Get the link color value from settings
    if (!empty($theme->settings->linkcolor)) {
        $linkcolor = $theme->settings->linkcolor;
    } else {
        $linkcolor = null;
    }
    $css = agm_zebra_set_linkcolor($css, $linkcolor);

    //Get the hover color value from settings
    if (!empty($theme->settings->hovercolor)) {
        $hovercolor = $theme->settings->hovercolor;
    } else {
        $hovercolor = null;
    }
    $css = agm_zebra_set_hovercolor($css, $hovercolor);

    //Get the font color value from settings
    if (!empty($theme->settings->fontcolor)) {
        $fontcolor = $theme->settings->fontcolor;
    } else {
        $fontcolor = null;
    }
    $css = agm_zebra_set_fontcolor($css, $fontcolor);

    //Get the content background color value from settings
    if (!empty($theme->settings->contentbgcolor)) {
        $contentbgcolor = $theme->settings->contentbgcolor;
    } else {
        $contentbgcolor = null;
    }
    $css = agm_zebra_set_contentbgcolor($css, $contentbgcolor);

    //Get the column background color value from settings
    if (!empty($theme->settings->columnbgcolor)) {
        $columnbgcolor = $theme->settings->columnbgcolor;
    } else {
        $columnbgcolor = null;
    }
    $css = agm_zebra_set_columnbgcolor($css, $columnbgcolor);

    //Get the header background color value from settings
    if (!empty($theme->settings->headerbgcolor)) {
        $headerbgcolor = $theme->settings->headerbgcolor;
    } else {
        $headerbgcolor = null;
    }
    $css = agm_zebra_set_headerbgcolor($css, $headerbgcolor);

    //Get the footer background color value from settings
    if (!empty($theme->settings->footerbgcolor)) {
        $footerbgcolor = $theme->settings->footerbgcolor;
    } else {
        $footerbgcolor = null;
    }
    $css = agm_zebra_set_footerbgcolor($css, $footerbgcolor);

    //Get the calendar course events color
    if (!empty($theme->settings->calcourse)) {
        $calcourse = $theme->settings->calcourse;
    } else {
        $calcourse = null;
    }
    $css = agm_zebra_set_calcourse($css, $calcourse);

    //Get the calendar global events color
    if (!empty($theme->settings->calglobal)) {
        $calglobal = $theme->settings->calglobal;
    } else {
        $calglobal = null;
    }
    $css = agm_zebra_set_calglobal($css, $calglobal);

    //Get the calendar group events color
    if (!empty($theme->settings->calgroup)) {
        $calgroup = $theme->settings->calgroup;
    } else {
        $calgroup = null;
    }
    $css = agm_zebra_set_calgroup($css, $calgroup);

    //Get the calendar user events color
    if (!empty($theme->settings->caluser)) {
        $caluser = $theme->settings->caluser;
    } else {
        $caluser = null;
    }
    $css = agm_zebra_set_caluser($css, $caluser);

    //Get the calendar weekend font color
    if (!empty($theme->settings->calweekend)) {
        $calweekend = $theme->settings->calweekend;
    } else {
        $calweekend = null;
    }
    $css = agm_zebra_set_calweekend($css, $calweekend);

    //Get the ok font color
    if (!empty($theme->settings->okfontcolor)) {
        $okfontcolor = $theme->settings->okfontcolor;
    } else {
        $okfontcolor = null;
    }
    $css = agm_zebra_set_okfontcolor($css, $okfontcolor);

    //Get the warning font color
    if (!empty($theme->settings->warningfontcolor)) {
        $warningfontcolor = $theme->settings->warningfontcolor;
    } else {
        $warningfontcolor = null;
    }
    $css = agm_zebra_set_warningfontcolor($css, $warningfontcolor);

    //Get the serious font color
    if (!empty($theme->settings->seriousfontcolor)) {
        $seriousfontcolor = $theme->settings->seriousfontcolor;
    } else {
        $seriousfontcolor = null;
    }
    $css = agm_zebra_set_seriousfontcolor($css, $seriousfontcolor);

    //Get the critical font color
    if (!empty($theme->settings->criticalfontcolor)) {
        $criticalfontcolor = $theme->settings->criticalfontcolor;
    } else {
        $criticalfontcolor = null;
    }
    $css = agm_zebra_set_criticalfontcolor($css, $criticalfontcolor);

    //Get the min width for two column page layout from settings
    if (!empty($theme->settings->twocolmin)) {
        $twocolmin = $theme->settings->twocolmin;
    } else {
        $twocolmin = null;
    }
    $css = agm_zebra_set_twocolmin($css, $twocolmin);

    //Get the min width for three column page layout from settings
    if (!empty($theme->settings->threecolmin)) {
        $threecolmin = $theme->settings->threecolmin;
    } else {
        $threecolmin = null;
    }
    $css = agm_zebra_set_threecolmin($css, $threecolmin);

    //Get the max width for page content from settings
    if (!empty($theme->settings->pagemaxwidth)) {
        $pagemaxwidth = $theme->settings->pagemaxwidth;
    } else {
        $pagemaxwidth = null;
    }
    $css = agm_zebra_set_pagemaxwidth($css, $pagemaxwidth);

    //Get the width of the columns from settings
    if (!empty($theme->settings->colwidth)) {
        $colwidth = $theme->settings->colwidth;
    } else {
        $colwidth = null;
    }
    $css = agm_zebra_set_colwidth($css, $colwidth);

    //Get double the width of the colums from colwidth
    if (!empty($theme->settings->colwidth)) {
        $colwidth = $theme->settings->colwidth; //Integrate colwidth in this function
    } else {
        $colwidth = null;
    }
    $css = agm_zebra_set_doublecolwidth($css, $colwidth);

    //Get the autohide value from settings
    if (!empty($theme->settings->useautohide)) {
        $useautohide = $theme->settings->useautohide;
    } else {
        $useautohide = null;
    }
    if (!empty($theme->settings->hovercolor)) { //Integrate hovercolor in this function
        $hovercolor = $theme->settings->hovercolor;
    } else {
        $hovercolor = null;
    }
    $css = agm_zebra_set_useautohide($css, $useautohide, $hovercolor);

    //Get any extra css the user adds from settings
    if(!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = agm_zebra_set_customcss($css, $customcss);

    return $css;
};

/**

 * Sets the body background image url
 *
 * @param string $css
 * @param mixed $backgroundurl
 * @return string
 */
function agm_zebra_set_backgroundurl($css, $backgroundurl) {
    global $OUTPUT;
    $tag = '[[setting:backgroundurl]]';
    if (is_null($backgroundurl)) {
        $replacement = $OUTPUT->pix_url('core/background', 'theme'); //Default image
    }
    else {
        $protocol = '://';
        $ntp = strpos($backgroundurl, $protocol); // Check to see if a networking protocol is used
        if($ntp === false) { // No networking protocol used
            $relative = '/';
            $rel = strpos($backgroundurl, $relative); // Check to see if a relative path is used
            if($rel !== 0) { // Doesn't start with a slash
                $replacement = $OUTPUT->pix_url("$backgroundurl", 'theme'); // Using Moodle output
            } else {
                $replacement = $backgroundurl;
            }
        } else {
            $replacement = $backgroundurl;
        }
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the primary background color used for body
 *
 * @param string $css
 * @param mixed $bodybgcolor
 * @return string
 */
function agm_zebra_set_bodybgcolor($css, $bodybgcolor) {
    $tag = '[[setting:bodybgcolor]]';
    if (is_null($bodybgcolor)) {
        $replacement = '#DDD'; //Default color
    } else {
        $replacement = $bodybgcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for custommenu and links
 *
 * @param string $css
 * @param mixed $linkcolor
 * @return string
 */
function agm_zebra_set_linkcolor($css, $linkcolor) {
    $tag = '[[setting:linkcolor]]';
    if (is_null($linkcolor)) {
        $replacement = '#234B6F'; //Default color
    } else {
        $replacement = $linkcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for hovering
 *
 * @param string $css
 * @param mixed $hovercolor
 * @return string
 */
function agm_zebra_set_hovercolor($css, $hovercolor) {
    $tag = '[[setting:hovercolor]]';
    if (is_null($hovercolor)) {
        $replacement = '#4E7BAE'; //Default color
    } else {
        $replacement = $hovercolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for font color
 *
 * @param string $css
 * @param mixed $fontcolor
 * @return string
 */
function agm_zebra_set_fontcolor($css, $fontcolor) {
    $tag = '[[setting:fontcolor]]';
    if (is_null($fontcolor)) {
        $replacement = '#2F2F2F'; //Default color
    } else {
        $replacement = $fontcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for main content background
 *
 * @param string $css
 * @param mixed $contentbgcolor
 * @return string
 */
function agm_zebra_set_contentbgcolor($css, $contentbgcolor) {
    $tag = '[[setting:contentbgcolor]]';
    if (is_null($contentbgcolor)) {
        $replacement = '#F4F6F8'; //Default color
    } else {
        $replacement = $contentbgcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for columns (region-pre, region-post) background
 *
 * @param string $css
 * @param mixed $columnbgcolor
 * @return string
 */
function agm_zebra_set_columnbgcolor($css, $columnbgcolor) {
    $tag = '[[setting:columnbgcolor]]';
    if (is_null($columnbgcolor)) {
        $replacement = '#F4F6F8'; //Default color
    } else {
        $replacement = $columnbgcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for the page-header background
 *
 * @param string $css
 * @param mixed $headerbgcolor
 * @return string
 */
function agm_zebra_set_headerbgcolor($css, $headerbgcolor) {
    $tag = '[[setting:headerbgcolor]]';
    if (is_null($headerbgcolor)) {
        $replacement = 'transparent'; //Default color
    } else {
        $replacement = $headerbgcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for the page-footer background
 *
 * @param string $css
 * @param mixed $footerbgcolor
 * @return string
 */
function agm_zebra_set_footerbgcolor($css, $footerbgcolor) {
    $tag = '[[setting:footerbgcolor]]';
    if (is_null($footerbgcolor)) {
        $replacement = '#DDD'; //Default color
    } else {
        $replacement = $footerbgcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for course calendar events
 *
 * @param string $css
 * @param mixed $calcourse
 * @return string
 */
function agm_zebra_set_calcourse($css, $calcourse) {
    $tag = '[[setting:calcourse]]';
    if (is_null($calcourse)) {
        $replacement = '#FFD3BD'; //Default color
    } else {
        $replacement = $calcourse; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for global calendar events
 *
 * @param string $css
 * @param mixed $calglobal
 * @return string
 */
function agm_zebra_set_calglobal($css, $calglobal) {
    $tag = '[[setting:calglobal]]';
    if (is_null($calglobal)) {
        $replacement = '#D6F8CD'; //Default color
    } else {
        $replacement = $calglobal; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for group calendar events
 *
 * @param string $css
 * @param mixed $calgroup
 * @return string
 */
function agm_zebra_set_calgroup($css, $calgroup) {
    $tag = '[[setting:calgroup]]';
    if (is_null($calgroup)) {
        $replacement = '#FEE7AE'; //Default color
    } else {
        $replacement = $calgroup; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for user calendar events
 *
 * @param string $css
 * @param mixed $caluser
 * @return string
 */
function agm_zebra_set_caluser($css, $caluser) {
    $tag = '[[setting:caluser]]';
    if (is_null($caluser)) {
        $replacement = '#DCE7EC'; //Default Color
    } else {
        $replacement = $caluser; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for weekends on the calendar
 *
 * @param string $css
 * @param mixed $calweekend
 * @return string
 */
function agm_zebra_set_calweekend($css, $calweekend) {
    $tag = '[[setting:calweekend]]';
    if (is_null($calweekend)) {
        $replacement = '#A00'; //Default color
    } else {
        $replacement = $calweekend; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for ok/good scenarios
 *
 * @param string $css
 * @param mixed $okfontcolor
 * @return string
 */
function agm_zebra_set_okfontcolor($css, $okfontcolor) {
    $tag = '[[setting:okfontcolor]]';
    if (is_null($okfontcolor)) {
        $replacement = '#060'; //Default color
    } else {
        $replacement = $okfontcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for warning scenarios
 *
 * @param string $css
 * @param mixed $warningfontcolor
 * @return string
 */
function agm_zebra_set_warningfontcolor($css, $warningfontcolor) {
    $tag = '[[setting:warningfontcolor]]';
    if (is_null($warningfontcolor)) {
        $replacement = '#F0E000'; //Default color
    } else {
        $replacement = $warningfontcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for serious scenarios
 *
 * @param string $css
 * @param mixed $seriousfontcolor
 * @return string
 */
function agm_zebra_set_seriousfontcolor($css, $seriousfontcolor) {
    $tag = '[[setting:seriousfontcolor]]';
    if (is_null($seriousfontcolor)) {
        $replacement = '#F07000'; //Default color
    } else {
        $replacement = $seriousfontcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color used for critical scenarios
 *
 * @param string $css
 * @param mixed $criticalfontcolor
 * @return string
 */
function agm_zebra_set_criticalfontcolor($css, $criticalfontcolor) {
    $tag = '[[setting:criticalfontcolor]]';
    if (is_null($criticalfontcolor)) {
        $replacement = '#F00000'; //Default color
    } else {
        $replacement = $criticalfontcolor; //Color from settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the gradient background color for blocks, navbar, etc.
 *
 * @param string $css
 * @param mixed $colorscheme
 * @return string
 */
function agm_zebra_set_colorscheme($css, $colorscheme) {
    $tag = '[[setting:colorscheme]]';
    switch($colorscheme) { //Get value from Settings Page
        default:
            $replacement = 'transparent'; //Default value
            break;

        case 'none':
            $replacement = 'transparent';
            break;

        case 'dark':
            $replacement = 'rgba(0, 0, 0, 0.08)'; //Black
            break;

        case 'light':
            $replacement = 'rgba(255, 255, 255, 0.2)'; //White
            break;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the gradient background color for custommenu
 *
 * @param string $css
 * @param mixed $menucolorscheme
 * @return string
 */
function agm_zebra_set_menucolorscheme($css, $menucolorscheme) {
    $tag = '[[setting:menucolorscheme]]';
    switch($menucolorscheme) { //Get value from settings page
        default:
            $replacement = 'transparent'; //Default value
            break;

        case 'none':
            $replacement = 'transparent';
            break;

        case 'dark':
            $replacement = 'rgba(0, 0, 0, 0.4)'; //Black
            break;

        case 'light':
            $replacement = 'rgba(255, 255, 255, 0.3)'; //White
            break;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color of the homeicon in the custommenu based on the
 * settings value of menucolorscheme
 *
 * @param string $css
 * @param mixed $menucolorscheme
 * @return string
 */
function agm_zebra_set_homeiconcolor($css, $menucolorscheme) {
    global $OUTPUT;
    $tag = '[[setting:homeiconcolor]]';
    switch($menucolorscheme) { //Get value from settings page
        default:
            $replacement = $OUTPUT->pix_url('menu/home-icon-light', 'theme'); //Default value
            break;

        case 'none':
            $replacement = $OUTPUT->pix_url('menu/home-icon-light', 'theme');
            break;

        case 'dark':
            $replacement = $OUTPUT->pix_url('menu/home-icon', 'theme'); //Black
            break;

        case 'light':
            $replacement = $OUTPUT->pix_url('menu/home-icon-light', 'theme'); //White
            break;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}


/**
 * Sets the color of the horizontal menu indicator in the custommenu based on the
 * settings value of menucolorscheme
 *
 * @param string $css
 * @param mixed $menucolorscheme
 * @return string
 */
function agm_zebra_set_hmenuiconcolor($css, $menucolorscheme) {
    global $OUTPUT;
    $tag = '[[setting:hmenuiconcolor]]';
    switch($menucolorscheme) { //Get value from settings page
        default:
            $replacement = $OUTPUT->pix_url('menu/horizontal-menu-submenu-indicator-light', 'theme'); //Default value
            break;

        case 'none':
            $replacement = $OUTPUT->pix_url('menu/horizontal-menu-submenu-indicator-light', 'theme');
            break;

        case 'dark':
            $replacement = $OUTPUT->pix_url('menu/horizontal-menu-submenu-indicator', 'theme'); //Black
            break;

        case 'light':
            $replacement = $OUTPUT->pix_url('menu/horizontal-menu-submenu-indicator-light', 'theme'); //White
            break;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the color of the vertical menu indicator in the custommenu based on the
 * settings value of menucolorscheme
 *
 * @param string $css
 * @param mixed $menucolorscheme
 * @return string
 */
function agm_zebra_set_vmenuiconcolor($css, $menucolorscheme) {
    global $OUTPUT;
    $tag = '[[setting:vmenuiconcolor]]';
    switch($menucolorscheme) { //Get value from settings page
        default:
            $replacement = $OUTPUT->pix_url('menu/vertical-menu-submenu-indicator-light', 'theme'); //Default value
            break;

        case 'none':
            $replacement = $OUTPUT->pix_url('menu/vertical-menu-submenu-indicator-light', 'theme');
            break;

        case 'dark':
            $replacement = $OUTPUT->pix_url('menu/vertical-menu-submenu-indicator', 'theme'); //Black
            break;

        case 'light':
            $replacement = $OUTPUT->pix_url('menu/vertical-menu-submenu-indicator-light', 'theme'); //White
            break;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets the minimum width for two column page layout.
 * Should be the returned value of {@link agm_zebra_set_onecolmax()}
 * plus 1. Default value should fit:
 * Smartphone landscape
 * Tablet portrait
 * SDTV
 *
 * @param string $css
 * @param mixed $twocolmin
 * @return string
 */
function agm_zebra_set_twocolmin($css, $twocolmin) {
    $tag = '[[setting:twocolmin]]';
    if (is_null($twocolmin)) {
        $replacement = '481px'; //Default width: 1px wider than a "smart phone" in portrait (generally)
    } else {
        $replacement = $twocolmin; //Get the value from the settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
};

/**
 * Sets the minimum width for three column page layout.
 * Should be the returned value of {@link agm_zebra_set_twocolmax()}
 * plus 1. Default value should fit:
 * Tablet landscape
 * HDTV
 * Monitor
 *
 * @param string $css
 * @param mixed $threecolmin
 * @return string
 */
function agm_zebra_set_threecolmin($css, $threecolmin) {
    $tag = '[[setting:threecolmin]]';
    if (is_null($threecolmin)) {
        $replacement = '769px'; //Default width: 1px wider than a "tablet" in portrait (generally)
    } else {
        $replacement = $threecolmin; //Get the value from the settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
};

/**
 * Sets the maximum width for three column page layout.
 * This is the max-width of #page, not body
 *
 * @param string $css
 * @param mixed $pagemaxwidth
 * @return string
 */
function agm_zebra_set_pagemaxwidth($css, $pagemaxwidth) {
    $tag = '[[setting:pagemaxwidth]]';
    if (is_null($pagemaxwidth)) {
        $replacement = '100%'; //Default width
    } else {
        $replacement = $pagemaxwidth; //Get the value from the settings page
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
};

/**
 * Sets the width of the columns.
 * This affects region-pre and region-post
 *
 * @param string $css
 * @param mixed $colwidth
 * @return string
 */
function agm_zebra_set_colwidth($css, $colwidth) {
    $tag = '[[setting:colwidth]]';
    if (is_null($colwidth)) {
        $replacement = '200px'; //Default width
    } else {
        $replacement = $colwidth; //Settings page value
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Calculates double the column width based on $colwidth
 *
 * @param string $css
 * @param mixed $colwidth
 * @return string
 */
function agm_zebra_set_doublecolwidth($css, $colwidth) {
    $tag = '[[setting:doublecolwidth]]';
    if (is_null($colwidth)) { //Get the value from the settings page
        $colwidth = '200px'; //Default width
    }
    preg_match('/(?P<int>\d+)(?P<type>\w+)/', $colwidth, $matches); //Divide the value from the type
    $replacement = $matches['int'] * 2 . $matches['type']; //Multiply it by two
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Displays the Autohide CSS based on settings value
 *
 * @param string $css
 * @param mixed $useautohide
 * @return string
 */
function agm_zebra_set_useautohide($css, $useautohide, $hovercolor) {
	global $CFG;
	if (!empty($CFG->themedir)) {
		$autohide = $CFG->themedir . '/' . current_theme() . '/style/autohide.css'; //Pull the full path for autohide css
	} else {
		$autohide = $CFG->dirroot . '/theme/' . current_theme() . '/style/autohide.css'; //MDL-36065
	}
    $tag = '[[setting:useautohide]]';
    if ($useautohide) { //Setting is "YES"
        if (is_null($hovercolor)) { //Get the value from the settings page
            $hovercolor = '#91979F';
        }
        $rules = file_get_contents($autohide);
        $replacement = $rules;
    } else { //Setting is "NO"
        $replacement = null; //NULL so we don't actually output anything to the stylesheet
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Sets any extra css the user wants to display
 * This is the absolutely last piece of CSS loaded
 *
 * @param string $css
 * @param mixed $customcss
 * @return string
 */
function agm_zebra_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss; //All the rules in the CSS box on the settings page
    $css = str_replace($tag, $replacement, $css);
    return $css;
}


/** END CSS POST PROCESSOR FUNCTIONS **/

/**
 * outputs the logo url for the header
 *
 * @param mixed $logourl
 * @return string
 */
function agm_zebra_print_logourl($logourl) {
    global $OUTPUT;
    $protocol = '://';
    $ntp = strpos($logourl, $protocol); // Check to see if a networking protocol is used
    if($ntp === false) { // No networking protocol used
        $relative = '/';
        $rel = strpos($logourl, $relative); // Check to see if a relative path is used
        if($rel !== 0) { // Doesn't start with a slash
            $replacement = $OUTPUT->pix_url("$logourl", 'theme'); // Using Moodle output
        } else {
            $replacement = $logourl;
        }
    } else {
        $replacement = $logourl;
    }
    return $replacement;
}