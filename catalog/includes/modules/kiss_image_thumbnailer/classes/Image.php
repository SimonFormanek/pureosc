<?php

/**
 * KISS Image Thumbnailer
 * Creates image thumbnails where the image size requested differs from the actual image size.
 * Ensures that the browser does not have to resize images resulting in far greater loading speeds.
 * Once thumbnails have been created the system has been designed to use very minimal resources.
 * 
 * This is based on the code of S. Mohammed Alsharaf, http://www.zfsnippets.com/snippets/view/id/44.
 * The class has been modified but remains in the most part unchanged,. 
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU Public License)
 * @package KISS Image Thumbnailer
 * @link http://www.fwrmedia.co.uk
 * @copyright Copyright 2008-2009 FWR Media ( Robert Fisher )
 * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
 * @lastdev $Author:: @raiwa  info@sarplataygemas.com       $:  Author of last commit
 * @lastmod $Date:: 2016-03-17       			     						 $:  Date of last commit
 * @version $Rev:: 24                                       $:  Revision of last commit
 * @Id $Id:: Image.php 14 2015-06-25 @raiwa                 $:  Full Details

 * $Rev:: 14 Added Watermark support in line 277 + function in 320 by @oboy
 *
 */
class Image
{
    /**
     * put your comment there...
     * 
     * @var mixed
     */
    protected $_filename = '';

    /**
     * put your comment there...
     * 
     * @var mixed
     */
    protected $_image = '';

    /**
     * put your comment there...
     * 
     * @var mixed
     */
    protected $_width = '';

    /**
     * put your comment there...
     * 
     * @var mixed
     */
    protected $_height = '';

    /**
     * put your comment there...
     * 
     * @var mixed
     */
    protected $_mime_type = '';

    /**
     * put your comment there...
     * 
     * @var mixed
     */
    protected $_view = null;

    /**
     * put your comment there...
     * 
     * @var integer
     */
    protected $_requested_thumbnail_width = '';

    /**
     * put your comment there...
     * 
     * @var integer
     */
    protected $_requested_thumbnail_height = '';

    /**
     * The resize parameters are given as $max_, setting this to bool true will set them as absolute and not a max.
     * A thumbnail will be created of the exact width and height placing the new resized image within it
     * 
     * @var mixed
     */
    protected $_take_resize_dimensions_as_absolute = true;

    /**
     * put your comment there...
     * 
     * @var mixed
     */
    protected $_thumb_background_rgb = array('red' => 255, 'green' => 255,
        'blue' => 255);

    /**
     * 
     */
    const IMAGETYPE_SVG = 'image/svg';

    /**
     * 
     */
    const IMAGETYPE_GIF = 'image/gif';

    /**
     * 
     */
    const IMAGETYPE_JPEG = 'image/jpeg';

    /**
     * 
     */
    const IMAGETYPE_PNG = 'image/png';

    /**
     * 
     */
    const IMAGETYPE_JPG = 'image/jpg';

    /**
     * put your comment there...
     * 
     * @param mixed $filename
     */
    public function open($filename, array $_thumb_background_rgb = array())
    {
        if (count(array_intersect_key($this->_thumb_background_rgb,
                    $_thumb_background_rgb)) == 3) {
            $this->_thumb_background_rgb = $_thumb_background_rgb;
        }
        $this->_filename = $filename;
        $this->_setInfo();
        switch ($this->_mime_type) {
            case self::IMAGETYPE_SVG :
                $this->_image = @imagecreatefromgif($this->_filename);
                break;
            case self::IMAGETYPE_GIF :
                $this->_image = @imagecreatefromgif($this->_filename);
                break;
            case self::IMAGETYPE_JPEG :
            case self::IMAGETYPE_JPG :
                $this->_image = @imagecreatefromjpeg($this->_filename);
                break;
            case self::IMAGETYPE_PNG :
                $this->_image = @imagecreatefrompng($this->_filename);
                break;
            default :
                trigger_error('Image extension is invalid or not supported.',
                    E_USER_NOTICE);
                break;
        } // end switch
        return $this;
    }
// end method

    /**
     * put your comment there...
     * 
     * @param mixed $save_in
     * @param mixed $quality
     * @param mixed $filters
     */
    protected function _output($save_in = null, $quality, $filters = null)
    {
        switch ($this->_mime_type) {
            case self::IMAGETYPE_SVG :
                return file_get_contents($this->_filename);
                break;
            case self::IMAGETYPE_GIF :
                return imagegif($this->_image, $save_in);
                break;
            case self::IMAGETYPE_JPEG :
            case self::IMAGETYPE_JPG :
                $quality = is_null($quality) ? 75 : $quality;
                return imagejpeg($this->_image, $save_in, $quality);
                break;
            case self::IMAGETYPE_PNG :
                $quality = 9;
                $filters = is_null($filters) ? null : $filters;
                return imagepng($this->_image, $save_in, $quality, $filters);
                break;
            default :
                trigger_error('Image cannot be created.', E_USER_NOTICE);
                break;
        } // end switch
    }
// end method

    /**
     * put your comment there...
     * 
     * @param mixed $save_in
     * @param mixed $quality
     * @param mixed $filters
     */
    public function save($save_in = null, $quality = null, $filters = null)
    {
        return $this->_output($save_in, $quality, $filters);
    }
// end method

    /**
     * put your comment there...
     * 
     */
    public function __destruct()
    {
        @imagedestroy($this->_image);
    }
// end method

    /**
     * put your comment there...
     * 
     */
    protected function _setInfo()
    {
        if (strstr($this->_filename, '.svg')) {
            $this->_width     = 200;
            $this->_height    = 200;
            $this->_mime_type = 'image/svg';
        } else {

            $img_size = @getimagesize($this->_filename);
            if (!$img_size) {
                trigger_error('Could not extract image size.', E_USER_NOTICE);
            } elseif ($img_size[0] == 0 || $img_size[1] == 0) {
                trigger_error('Image has dimension of zero.', E_USER_NOTICE);
            }
            $this->_width     = $img_size[0];
            $this->_height    = $img_size[1];
            $this->_mime_type = $img_size['mime'];
        }
    }
// end method

    /**
     * put your comment there...
     * 
     */
    public function getWidth()
    {
        return $this->_width;
    }
// end method

    /**
     * put your comment there...
     * 
     */
    public function getHeight()
    {
        return $this->_height;
    }
// end method

    /**
     * put your comment there...
     * 
     */
    protected function _refreshDimensions()
    {
        $this->_height = imagesy($this->_image);
        $this->_width  = imagesx($this->_image);
    }
// end method

    /**
     * If image is GIF or PNG keep transparent colors
     * 
     * @credit http://github.com/maxim/smart_resize_image/tree/master
     * @param $image src of the image
     * @return the modified image
     */
    protected function _handleTransparentColor($image = null)
    {
        $image = is_null($image) ? $this->_image : $image;
        if (($this->_mime_type == self::IMAGETYPE_GIF) || ($this->_mime_type == self::IMAGETYPE_PNG)) {
            $trnprt_indx = @imagecolortransparent($this->_image);
            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {
                // Get the original image's transparent color's RGB values
                $trnprt_color = @imagecolorsforindex($this->_image, $trnprt_indx);
                // Allocate the same color in the new image resource
                $trnprt_indx  = @imagecolorallocate($image,
                        $this->_thumb_background_rgb['red'],
                        $this->_thumb_background_rgb['green'],
                        $this->_thumb_background_rgb['blue']);
                // Completely fill the background of the new image with allocated color.
                imagefill($image, 0, 0, $trnprt_indx);
                // Set the background color for new image to transparent
                imagecolortransparent($image, $trnprt_indx);
            } elseif ($this->_mime_type == self::IMAGETYPE_PNG) {
                // Always make a transparent background color for PNGs that don't have one allocated already
                // Turn off transparency blending (temporarily)
                imagealphablending($image, false);
                // Create a new transparent color for image
                $color = imagecolorallocatealpha($image, 0, 0, 0, 127);
                // Completely fill the background of the new image with allocated color.
                imagefill($image, 0, 0, $color);
                // Restore transparency blending
                imagesavealpha($image, true);
            }
            return $image;
        }
    }
// end method

    /**
     * Resize image based on max width and height
     * 
     * @param integer $maxWidth
     * @param integer $maxHeight
     * @return resized image
     */
    public function resize($max_width, $max_height)
    {
        $this->_requested_thumbnail_width  = $max_width;
        $this->_requested_thumbnail_height = $max_height;
        if (!$this->_take_resize_dimensions_as_absolute) {
            if ($this->_width < $max_width && $this->_height < $max_height) {
                $this->_handleTransparentColor();
                return $this;
            }
        }
        //maintain the aspect ratio of the image. 
        $ratio_orig = $this->_width / $this->_height;
        if ($max_width / $max_height > $ratio_orig) {
            $max_width = $max_height * $ratio_orig;
        } else {
            $max_height = $max_width / $ratio_orig;
        }
        //$this->debugIndividualImage( 'logo_goodridgeSuz.gif', $max_width . ' :: ' .  $max_height );
        $new_image = imagecreatetruecolor($max_width, $max_height);
        $this->_handleTransparentColor($new_image);
        if (KISS_DISABLE_UPSIZE == 'true' && ($this->_width < $max_width || $this->_height
            < $max_height)) {
            $new_image = $this->_image;
        } else {
            if ($this->_mime_type != 'image/svg') {
                imagecopyresampled($new_image, $this->_image, 0, 0, 0, 0,
                    $max_width, $max_height, $this->_width, $this->_height);
            }
        }
        // BOF added for watermark support
        if (($max_width > KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH || $max_height
            > KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT) && KISSIT_MAIN_PRODUCT_WATERMARK_SIZE
            != 0) {
            $info       = pathinfo($this->_filename);
            $image_name = $info['basename'];
            if (strpos($image_name, 'no_image') === false) {
                $new_image = $this->_watermark($new_image, $max_width,
                    $max_height);
            }
        }
        // EOF added for watermark support
        // BOF sharpen filter
        if (KISSIT_SHARPEN_THUMBNAIL != 'none') {
            $info       = pathinfo($this->_filename);
            $image_name = $info['basename'];
            if (strpos($image_name, 'no_image') === false) {
                $new_image = $this->_sharpen($new_image, $max_width);
            }
        }
        // EOF sharpen filter

        $this->_image = $new_image;
        if (KISSIT_APPLY_BACKGROUND == 'true' && $this->_take_resize_dimensions_as_absolute) {
            // the image has scaled badly we need to add a background
            $info       = pathinfo($this->_filename);
            $image_name = $info['basename'];
            if (($max_width < $this->_requested_thumbnail_width || $max_height < $this->_requested_thumbnail_height)
                || (KISS_DISABLE_UPSIZE == 'true' && ($this->_width < $max_width
                || $this->_height < $max_height))) {
                $thumb_background = imagecreatetruecolor($this->_requested_thumbnail_width,
                    $this->_requested_thumbnail_height);
                // transparent background for GIF and PNG images
                if (($this->_mime_type == self::IMAGETYPE_GIF)) {
                    $trnprt_indx = @imagecolortransparent($this->_image);
                    // If we have a specific transparent color
                    if ($trnprt_indx >= 0) {
                        // Get the original image's transparent color's RGB values
                        // Allocate the same color in the new image resource
                        $trnprt_indx = @imagecolorallocate($thumb_background,
                                $this->_thumb_background_rgb['red'],
                                $this->_thumb_background_rgb['green'],
                                $this->_thumb_background_rgb['blue']);
                    } else {
                        // use transparent background for all other GIFs and PNGs 
                        $trnprt_indx = 127;
                    }
                    $trnprt_color     = @imagecolorsforindex($this->_image,
                            $trnprt_indx);
                    // Completely fill the background of the new image with allocated color.
                    imagefill($thumb_background, 0, 0, $trnprt_indx);
                    $dst_x            = 0;
                    $dst_y            = 0;
                    $new_image_width  = imagesx($new_image);
                    $new_image_height = imagesy($new_image);
                    $dst_x            = floor(( $this->_requested_thumbnail_width
                        - $new_image_width ) / 2);
                    $dst_y            = floor(( $this->_requested_thumbnail_height
                        - $new_image_height ) / 2);
                    // Set the background color for new image to transparent
                    imagecolortransparent($thumb_background, $trnprt_indx);
                    imagecopyresampled($thumb_background, $new_image, $dst_x,
                        $dst_y, 0, 0, $new_image_width, $new_image_height,
                        $new_image_width, $new_image_height);
                    $this->_image     = $thumb_background;
                } elseif ($this->_mime_type == self::IMAGETYPE_PNG) {
                    // Always make a transparent background color for PNGs that don't have one allocated already
                    // Turn off transparency blending (temporarily)
                    imagealphablending($thumb_background, false);
                    // Create a new transparent color for image
                    $color            = imagecolorallocatealpha($thumb_background,
                        0, 0, 0, 127);
                    // Completely fill the background of the new image with allocated color.
                    imagefill($thumb_background, 0, 0, $color);
                    $dst_x            = 0;
                    $dst_y            = 0;
                    $new_image_width  = imagesx($new_image);
                    $new_image_height = imagesy($new_image);
                    $dst_x            = floor(( $this->_requested_thumbnail_width
                        - $new_image_width ) / 2);
                    $dst_y            = floor(( $this->_requested_thumbnail_height
                        - $new_image_height ) / 2);
                    // Restore transparency blending
                    imagesavealpha($thumb_background, true);
                    imagecopyresampled($thumb_background, $new_image, $dst_x,
                        $dst_y, 0, 0, $new_image_width, $new_image_height,
                        $new_image_width, $new_image_height);
                    $this->_image     = $thumb_background;
                } else {
                    // jpg images have no transparency
                    $background_color = imagecolorallocate($thumb_background,
                        $this->_thumb_background_rgb['red'],
                        $this->_thumb_background_rgb['green'],
                        $this->_thumb_background_rgb['blue']);
                    imagefill($thumb_background, 0, 0, $background_color);
                    $dst_x            = 0;
                    $dst_y            = 0;
                    $new_image_width  = imagesx($new_image);
                    $new_image_height = imagesy($new_image);
                    $dst_x            = floor(( $this->_requested_thumbnail_width
                        - $new_image_width ) / 2);
                    $dst_y            = floor(( $this->_requested_thumbnail_height
                        - $new_image_height ) / 2);
                    imagecopyresampled($thumb_background, $new_image, $dst_x,
                        $dst_y, 0, 0, $new_image_width, $new_image_height,
                        $new_image_width, $new_image_height);
                    $this->_image     = $thumb_background;
                }
            }
        } // end need a background
        $this->_refreshDimensions();
        return $this;
    }
// end method

    /**
     * put your comment there...
     *  // end method
     */
    protected function debugIndividualImage($image_target, $message)
    {
        $info       = pathinfo($this->_filename);
        $image_name = $info['basename'];
        if ($image_name == $image_target) {
            die('Image target was: '.$image_target.'<br />Message: '.$message);
        }
    }

// end method
    // BOF added for watermark support
    protected function _watermark($new_image, $new_width, $new_height)
    {
        $stamp = imagecreatefrompng('./images/'.KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE);
        $sx    = imagesx($stamp);
        $sy    = imagesy($stamp);

        $ratio_stamp = $sx / $sy;
        $new_sx      = $new_width * KISSIT_MAIN_PRODUCT_WATERMARK_SIZE;
        $new_sy      = $new_height * KISSIT_MAIN_PRODUCT_WATERMARK_SIZE;
        if ($new_sx / $new_sy > $ratio_stamp) {
            $new_sx = $new_sy * $ratio_stamp;
        } else {
            $new_sy = $new_sx / $ratio_stamp;
        }
        $new_stamp   = imagecreatetruecolor($new_sx, $new_sy);
        imagealphablending($new_stamp, false);
        imagesavealpha($new_stamp, true);
        $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
        imagefilledrectangle($new_stamp, 0, 0, $new_sx, $new_sy, $transparent);
        imagecopyresampled($new_stamp, $stamp, 0, 0, 0, 0, $new_sx, $new_sy,
            $sx, $sy);
        $stamp       = $new_stamp;
        $sx          = imagesx($stamp);
        $sy          = imagesy($stamp);
        switch (KISSIT_MAIN_PRODUCT_WATERMARK_PLACEMENT) {
            case 'top-right' :
                $xoffset = (imagesx($new_image) - $sx);
                $yoffset = 0;
                break;
            case 'top-left' :
                $xoffset = 0;
                $yoffset = 0;
                break;
            case 'bottom-right' :
                $xoffset = (imagesx($new_image) - $sx);
                $yoffset = (imagesy($new_image) - $sy);
                break;
            case 'bottom-left' :
                $xoffset = 0;
                $yoffset = (imagesy($new_image) - $sy);
                break;
            default :
                $xoffset = (imagesx($new_image) - $sx) * 0.5;
                $yoffset = (imagesy($new_image) - $sy) * 0.5;
        }
        imagecopy($new_image, $stamp, $xoffset, $yoffset, 0, 0, $sx, $sy);
        return $new_image;
    }

    // EOF added for watermark support
    // BOF  sharpen filter
    protected function _sharpen($new_image, $max_width)
    {

        // function from Ryan Rud (http://adryrun.com)
        $final = $max_width * (750.0 / $this->_width);
        $a     = 52;
        $b     = -0.27810650887573124;
        $c     = .00047337278106508946;

        $result = $a + $b * $final + $c * $final * $final;

        $sharpness = max(round($result), 0);
        // findSharp()

        switch (KISSIT_SHARPEN_THUMBNAIL) {
            case 'soft' :
                $sharpenMatrix = array
                    (
                    array(-1, -2, -1),
                    array(-2, $sharpness + 36, -2),
                    array(-1, -2, -1)
                );
                break;
            case 'medium' :
                $sharpenMatrix = array
                    (
                    array(-1, -2, -1),
                    array(-2, $sharpness + 24, -2),
                    array(-1, -2, -1)
                );
                break;
            case 'strong' :
                $sharpenMatrix = array
                    (
                    array(-1, -2, -1),
                    array(-2, $sharpness + 12, -2),
                    array(-1, -2, -1)
                );
                break;
            default :
                $sharpenMatrix = array
                    (
                    array(-1, -2, -1),
                    array(-2, $sharpness + 36, -2),
                    array(-1, -2, -1)
                );
                break;
        } // end switch

        $divisor = array_sum(array_map('array_sum', $sharpenMatrix));
        $offset  = 0;
        // apply the matrix
        imageconvolution($new_image, $sharpenMatrix, $divisor, $offset);

        return $new_image;
    }
}

// end class