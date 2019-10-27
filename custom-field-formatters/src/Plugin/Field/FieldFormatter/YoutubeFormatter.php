<?php

/**
 * @file
 * Contains Drupal\custom_field_formatters\Plugin\Field\FieldFormatter\YoutubeFormatter.
 */

namespace Drupal\custom_field_formatters\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Url;
use Drupal\link\LinkItemInterface;

/**
 * Plugin implementation of the 'youtube_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "youtube_formatter",
 *   label = @Translation("Youtube"),
 *   weight = "10",
 *   field_types = {
 *     "link",
 *   }
 * )
 */

class YoutubeFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      // Render each element as markup.
	  $url = $this->buildUrl($item);
      $link_title = $url->toString();
      $element[$delta] = [
        /*'#type' => 'markup',
        '#markup' => '<p>' . $link_title . '</p>', */
		'#theme' => 'youtube_link_formatter',
		'#url' => $link_title,
      ];
    }

    return $element;
  }
  
    protected function buildUrl(LinkItemInterface $item) {
    $url = $item->getUrl() ?: Url::fromRoute('<none>');

    $settings = $this->getSettings();
    $options = $item->options;
    $options += $url->getOptions();

    // Add optional 'rel' attribute to link options.
    if (!empty($settings['rel'])) {
      $options['attributes']['rel'] = $settings['rel'];
    }
    // Add optional 'target' attribute to link options.
    if (!empty($settings['target'])) {
      $options['attributes']['target'] = $settings['target'];
    }
    $url->setOptions($options);

    return $url;
  }

}