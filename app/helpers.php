<?php
/**
 * @copyright Sharapov A. <alexander@sharapov.biz>
 * @link      http://www.sharapov.biz/
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License
 * Date: 17.01.2022
 * Time: 23:33
 */

if (! function_exists('static_url')) {
    function static_url($url)
    {
        return env('JERSEY_STATIC_URL').'/'.$url;
    }
}