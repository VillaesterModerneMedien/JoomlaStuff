<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Osmap
 *
 * @copyright   Copyright (C) 2017 NAME. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;

defined('_JEXEC') or die;

JFormHelper::loadFieldClass('text');

class JFormFieldImageschoose extends JFormFieldText
{
    public $type = 'Whylink';




    public function getInput()
    {

        $field       = '<div class="linkFieldContainer">';
        $field      .= '<ul class="imagesPreviewList" id="previewList-' . $this->id . '"></ul>';
        $field      .= $this->_setModalMedia($this->id);
        $field      .=   '<input type="hidden" name="' .  $this->name . '" id="' . $this->id . '" value="' . $this->value. '" />';
        $field      .=  '<a href="#mediaModal" role="button" class="btn btn-info btnWhylink" id="articlesModalBtn" data-bs-toggle="modal" data-bs-target="#mediaModal"><span class="icon-list large-icon"> </span></a>';
        $field      .=   '</div>';

        return $field;
    }

    protected function _setModalMedia($dataAttribute){
        $token = Session::getFormToken();
        $css = '<style>
                    .imagesPreviewList{
                        list-style-type: none;
                        display: grid;
                        grid-template-columns: 1fr 1fr 1fr;
                        grid-column-gap: 10px;
                        grid-row-gap: 10px;
                    }
                    .imagesPreviewList li{
                        border: 1px solid black;
                        padding: 10px;
                    }
                    .imagesPreviewList img{
                        width: 100%;
                    }
                </style>';
        $script = '
           <script type="text/javascript">
                jQuery( document ).ready(function() {

          // Media Modal

          const types = ["media"];

          function checkIframeLoaded(type) {
            // Get a handle to the iframe element
            var iframe = document.getElementById(type + "Frame");
            if(iframe != null){
              var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

              // Check if loading is complete
              if (  iframeDoc.readyState  == "complete" ) {
                //iframe.contentWindow.alert("Hello");
                iframe.contentWindow.onload = function(){
                  alert("I am loaded");
                };
                // The loading is complete, call the function we want executed once the iframe is loaded
                var afterload = afterLoading();
                if(afterload){
                  return true;
                }
                else{
                  return false;
                }
            }

            }

            // If we are here, it is not loaded. Set things up so we check   the status again in 100 milliseconds
            window.setTimeout(checkIframeLoaded, 100);
          }

          function afterLoading(){
            return true;
          }

          function setPreview(){
            var imagesLi = "";
            var previewImages = jQuery("#' . $this->id . '").val()
            previewImages = previewImages.slice(0, -1)
            previewImages = previewImages.split(",");
            previewImages.map(function(data, index) {
                console.log(index,data)
              imagesLi += "<li><img src=\"/" + data + "\"</li>";
            });

            console.log(previewImages);
            jQuery("#previewList-' . $this->id . '").html(imagesLi);
          }

          setPreview();

            jQuery(".closeImagesModal").on("click", function(e){
                e.preventDefault(e);
                var modal = jQuery("#mediaModal");
                modal.hide();
                jQuery("body").removeClass("modal-open");
                jQuery(".modal-backdrop").remove();
            })

            jQuery("#mediaModal").on("shown.bs.modal", function (e) {
              var iframe = jQuery("#mediaFrame");
              var iframeLoaded = checkIframeLoaded("media");
              console.log(iframeLoaded);
              if(iframeLoaded){
                  console.log("loaded");
                  console.log("links", jQuery(iframe).contents().find(".select-link"));
                  jQuery(iframe).contents().find(".select-link").removeAttr("href");
                  jQuery(iframe).contents().find(".select-link").css("pointer-events", "none");
                  jQuery(iframe).contents().find("form").removeAttr("action");

                  var dataAttribute = jQuery("#mediaModal .modal-body").data("fieldid");
                  var tableRow =  jQuery(iframe).contents().find("tr");

                  jQuery("#addImages").on("click", function(e){
                    e.preventDefault();
                    var selectedImages = jQuery(iframe).contents().find("li.selected");

                    var imagesLi = "";
                    var images = "";

                    selectedImages.map(function(index, image) {
                      var data = jQuery(image).data("url")
                      //console.log("selected",index, image, data);
                      images += data + ",";
                      imagesLi += "<li><img src=\"/" + data + "\"</li>";
                    });

                    jQuery("#' . $this->id . '").val(images);
                    jQuery("#previewList-' . $this->id . '").html(imagesLi);

                    var modal = jQuery("#mediaModal");
                    modal.hide();
                    jQuery("body").removeClass("modal-open");
                    jQuery(".modal-backdrop").remove();
                  })
              }

            })
        });
        </script>
        ';
        $html = $script;
        $html .= $css;
        $html .= '<div id="mediaModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="articlesModalLabel" aria-hidden="true">';
        $html .= '<div class="modal-dialog modal-lg jviewport-width80">';
        $html .= '<div class="modal-content">';
        $html .= '<div class="modal-header">';
        $html .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
        $html .= '<h3 id="articlesModalLabel">' . Text::_('IMAGESCHOOSE_HEADLINE') . '</h3>';
        $html .= '</div>';
        $html .= '<div class="modal-body">';
        //TODO STartpfad mitgeben
        $html .= '<iframe id="mediaFrame" src="/administrator/index.php?option=com_jce&task=plugin.display&plugin=browser&standalone=1&'. $token . '=1&path=local-images:/"></iframe>';
        $html .= '</div>';
        $html .= '<div class="modal-footer">';
        $html .= '<button class="btn" id="addImages">' . Text::_('ADD') . '</button>';
        $html .= '<button class="btn closeImagesModal">' . Text::_('CLOSE') . '</button>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }



}
