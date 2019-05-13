<?php
/*
    PHPRtfLite
    Copyright 2007-2008 Denis Slaveckij <sinedas@gmail.com>
    Copyright 2010-2012 Steffen Zeidler <sigma_z@sigma-scripts.de>

    This file is part of PHPRtfLite.

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
 * Abstract class for creating containers like sections, footers and headers.
 * @version     1.2
 * @author      Denis Slaveckij <sinedas@gmail.com>
 * @author      Steffen Zeidler <sigma_z@sigma-scripts.de>
 * @copyright   2007-2008 Denis Slaveckij, 2010-2012 Steffen Zeidler
 * @package     PHPRtfLite
 * @subpackage  PHPRtfLite_Container
 */
abstract class PHPRtfLite_Container extends PHPRtfLite_Container_Base
{

    /**
     * adds a footnote
     *
     * @param string                $noteText
     * @param PHPRtfLite_Font       $font
     * @param PHPRtfLite_ParFormat  $parFormat
     *
     * @return PHPRtfLite_Footnote
     */
    public function addFootnote($noteText, PHPRtfLite_Font $font = null, PHPRtfLite_ParFormat $parFormat = null)
    {
        $footnote = new PHPRtfLite_Footnote($this->_rtf, $noteText, $font, $parFormat);
        $this->_elements[] = $footnote;
        return $footnote;
    }


    /**
     * adds an endnote
     *
     * @param string                $noteText
     * @param PHPRtfLite_Font       $font
     * @param PHPRtfLite_ParFormat  $parFormat
     *
     * @return PHPRtfLite_Endnote
     */
    public function addEndnote($noteText, PHPRtfLite_Font $font = null, PHPRtfLite_ParFormat $parFormat = null)
    {
        $endnote = new PHPRtfLite_Endnote($this->_rtf, $noteText, $font, $parFormat);
        $this->_elements[] = $endnote;
        return $endnote;
    }


    /**
     * adds list (enumeration/numbering)
     *
     * @param PHPRtfLite_List $list
     */
    public function addList(PHPRtfLite_List $list)
    {
        $this->_elements[] = $list;
    }


    /**
     * adds enumeration
     *
     * @param PHPRtfLite_List_Enumeration $enum
     */
    public function addEnumeration(PHPRtfLite_List_Enumeration $enum)
    {
        $this->_elements[] = $enum;
    }


    /**
     * adds numbering
     *
     * @param PHPRtfLite_List_Numbering $numList
     */
    public function addNumbering(PHPRtfLite_List_Numbering $numList)
    {
        $this->_elements[] = $numList;
    }


    /**
     * adds checkbox field
     *
     * @param   PHPRtfLite_Font         $font
     * @param   PHPRtfLite_ParFormat    $parFormat
     * @return  PHPRtfLite_FormField_Checkbox
     */
    public function addCheckbox(PHPRtfLite_Font $font = null, PHPRtfLite_ParFormat $parFormat = null)
    {
        $checkBox = new PHPRtfLite_FormField_Checkbox($this->_rtf, $font, $parFormat);
        $this->_elements[] = $checkBox;
        return $checkBox;
    }


    /**
     * adds dropdown field
     *
     * @param   PHPRtfLite_Font         $font
     * @param   PHPRtfLite_ParFormat    $parFormat
     * @return  PHPRtfLite_FormField_Dropdown
     */
    public function addDropdown(PHPRtfLite_Font $font = null, PHPRtfLite_ParFormat $parFormat = null)
    {
        $dropdown = new PHPRtfLite_FormField_Dropdown($this->_rtf, $font, $parFormat);
        $this->_elements[] = $dropdown;
        return $dropdown;
    }


    /**
     * adds text field
     *
     * @param   PHPRtfLite_Font         $font
     * @param   PHPRtfLite_ParFormat    $parFormat
     * @return  PHPRtfLite_FormField_Text
     */
    public function addTextField(PHPRtfLite_Font $font = null, PHPRtfLite_ParFormat $parFormat = null)
    {
        $textField = new PHPRtfLite_FormField_Text($this->_rtf, $font, $parFormat);
        $this->_elements[] = $textField;
        return $textField;
    }


    /**
     * @deprecated will be removed soon, use addEmptyParagraph instead
     * @see     PHPRtfLite_Container::addEmptyParagraph
     *
     * @param   PHPRtfLite_Font         $font
     * @param   PHPRtfLite_ParFormat    $parFormat
     */
    public function emptyParagraph(PHPRtfLite_Font $font, PHPRtfLite_ParFormat $parFormat)
    {
        $this->addEmptyParagraph($font, $parFormat);
    }

    /**
     * Writes a bookmark to container
     * @param string $bookmark Bookmark name. Support only alphanuméric and underscore scre characters.
     * @param string $text Bookmark text If false, bookmark is writen in previous paragraph format.
     * @param Font $font Font
     * @param mix $parFormat Paragraph format or null object. If null object hyperlink is written in the same paragraph.
     * @access public
     */
    public function writeBookmark($bookmark, $text, PHPRtfLite_Font $font, PHPRtfLite_ParFormat $parFormat, $convertTagsToRtf = true)
    { 
            $element = new PHPRtfLite_Element_Bookmark($this->_rtf, $text, $font, $parFormat);
            $element->setBookmark($bookmark);
            if ($convertTagsToRtf) {
                $element->setConvertTagsToRtf();
            }
            $this->_elements[] = $element;

            return $element;
    }

    /**
     * Writes a toc to container
     * @param string $bookmark Bookmark name. Support only alphanuméric and underscore scre characters.
     * @param string $text Bookmark text If false, bookmark is writen in previous paragraph format.
     * @param Font $font Font
     * @param mix $parFormat Paragraph format or null object. If null object hyperlink is written in the same paragraph.
     * @access public
     */
    public function writeToc($entry, $level , PHPRtfLite_Font $font, PHPRtfLite_ParFormat $parFormat, $convertTagsToRtf = true)
    {
        $this->writeRtfCode( '\tc \tcl'. $level . ' ' . $entry, $font, $parFormat);
    }

    /**
     * Writes a generate toc to container
     * @param string $bookmark Bookmark name. Support only alphanuméric and underscore scre characters.
     * @param string $text Bookmark text If false, bookmark is writen in previous paragraph format.
     * @param Font $font Font
     * @param mix $parFormat Paragraph format or null object. If null object hyperlink is written in the same paragraph.
     * @access public
     */
    public function generateToc(PHPRtfLite_Font $font, PHPRtfLite_ParFormat $parFormat)
    {
        $this->writeRtfCode( '\field{\*\fldinst {\\\TOC \\\f \\\h}}', $font, $parFormat);
    }
}