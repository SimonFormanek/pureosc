<?php
/*
  $Id: category_tree_extended.php, v1.0 20160220 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License
 */

class category_tree_extended extends category_tree
{
    public $root_group_start_string         = '<ul>';
    public $root_group_end_string           = '</ul>';
    public $child_with_subcats_start_string = '<li>';
    public $child_with_subcats_end_string   = '</li>';

    /*
     * Sets strings that wrap all of the subcategories under a top-level category
     * 
     * @param str $root_group_start_string The string to pot before the first subcategory string (usually <ul>)
     * @param str $root_group_end_string The string to pot after the last subcategory string (usually </ul>)
     */

    function set_root_group_string($root_group_start_string,
                                   $root_group_end_string)
    {
        $this->root_group_start_string = $root_group_start_string;
        $this->root_group_end_string   = $root_group_end_string.PHP_EOL;
    }
    /*
     * Sets strings that wrap each individual category link when there are subcategories
     * 
     * @param str $child_with_subcats_start_string The string to put before the category link (usually <li>)
     * @param str $child_with_subcats_end_string The string to put after the category link (usually </li>)
     */

    function set_child_with_subcats_string($child_with_subcats_start_string,
                                           $child_with_subcats_end_string)
    {
        $this->child_with_subcats_start_string = $child_with_subcats_start_string;
        $this->child_with_subcats_end_string   = $child_with_subcats_end_string.PHP_EOL;
    }
    /*
     * Replaces buildBranch in the parent with a method that uses the extended parameters.
     *   All other parts of this method are the same.
     */

    protected function build_branch_extended($parent_id, $level = 0)
    {
        $result = ((($level === 0) && ($this->parent_group_apply_to_root === true))
            || ($level > 0)) ? $this->parent_group_start_string : null;
        $result .= (($level === 0) && ($this->parent_group_apply_to_root === false))
                ? $this->root_group_start_string : null;

        if (isset($this->_data[$parent_id])) {
            foreach ($this->_data[$parent_id] as $category_id => $category) {
                if ($this->breadcrumb_usage === true) {
                    $category_link = $this->buildBreadcrumb($category_id);
                } else {
                    $category_link = $category_id;
                }

                if (tep_has_category_subcategories($category_id) === true) {
                    $result .= PHP_EOL.$this->child_with_subcats_start_string;
                } else {
                    $result .= PHP_EOL.$this->child_start_string;
                }

                if (isset($this->_data[$category_id])) {
                    $result .= PHP_EOL.$this->parent_start_string;
                }

                if ($level === 0) {
                    $result .= PHP_EOL.$this->root_start_string;
                }

                if (($this->follow_cpath === true) && in_array($category_id,
                        $this->cpath_array)) {
                    $link_title = $this->cpath_start_string.$category['name'].$this->cpath_end_string;
                } else {
                    $link_title = $category['name'];
                }

                $result .= '<a href="'.tep_href_link(FILENAME_DEFAULT,
                        'cPath='.$category_link).'">';
                $result .= str_repeat($this->spacer_string,
                    $this->spacer_multiplier * $level);
                $result .= $link_title.'</a>'.PHP_EOL;

                if ($level === 0) {
                    $result .= $this->root_end_string;
                }

                if (isset($this->_data[$category_id])) {
                    $result .= $this->parent_end_string;
                }

                if (isset($this->_data[$category_id]) && (($this->max_level == '0')
                    || ($this->max_level > $level + 1))) {
                    if ($this->follow_cpath === true) {
                        if (in_array($category_id, $this->cpath_array)) {
                            $result .= $this->build_branch_extended($category_id,
                                $level + 1);
                        }
                    } else {
                        $result .= $this->build_branch_extended($category_id,
                            $level + 1);
                    }
                }

                if (tep_has_category_subcategories($category_id) === true && in_array($category_id,
                        $this->cpath_array)) {
                    $result .= PHP_EOL.$this->child_with_subcats_end_string;
                } else {
                    $result .= PHP_EOL.$this->child_end_string;
                }
            }
        }

        $result .= ((($level === 0) && ($this->parent_group_apply_to_root === true))
            || ($level > 0)) ? $this->parent_group_end_string : null;
        $result .= (($level === 0) && ($this->parent_group_apply_to_root === false))
                ? $this->root_group_end_string : null;

        return $result;
    }

    /**
     * Return a formated string representation of the category structure relationship data
     *
     * @access public
     * @return string
     */
    public function get_tree_extended()
    {
        return $this->build_branch_extended($this->root_category_id);
    }
}
