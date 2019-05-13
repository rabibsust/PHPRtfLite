<?php
/*
    PHPRtfLite
    Copyright 2019-2020  Ahmad Jamaly Rabib <rabib.sust@gmail.com>

    This file is added seperately with PHPRtfLite.

    PHPRtfLite is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    PHPRtfLite is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Lesser General Public License for more details.

    You should have received a copy of the GNU Lesser General Public License
    along with PHPRtfLite.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * class for creating elements used in containers like sections, footers and headers.
 * @version     1.2
 * @author      Ahmad Jamaly Rabib <rabib.sust@gmail.com>
 * @copyright   2019-2020 Ahmad Jamaly Rabib
 * @package     PHPRtfLite
 * @subpackage  PHPRtfLite_Element
 */
class PHPRtfLite_Element_Bookmark extends PHPRtfLite_Element
{

    /**
     * @var string
     */
    protected $_bookmark = '';


    /**
     * sets bookmark
     *
     * @param string $bookmark
     */
    public function setBookmark($bookmark)
    {
        $this->_bookmark = $bookmark;
    }


    /**
     * gets opening token
     *
     * @return string
     */
    protected function getOpeningToken()
    {
        $bookmark = PHPRtfLite::quoteRtfCode($this->_bookmark);
        return '{\*\bkmkstart "' . $bookmark . '"}';
    }


    /**
     * gets closing token
     *
     * @return string
     */
    protected function getClosingToken()
    {
        $bookmark = PHPRtfLite::quoteRtfCode($this->_bookmark);
        return '{\*\bkmkend "' . $bookmark . '"}';
    }

}