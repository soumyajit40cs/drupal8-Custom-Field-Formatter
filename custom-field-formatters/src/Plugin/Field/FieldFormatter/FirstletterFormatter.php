<?php

/**
 * @file
 * Contains Drupal\custom_field_formatters\Plugin\Field\FieldFormatter\FirstletterFormatter.
 */
namespace Drupal\custom_field_formatters\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'first_letter_selector_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "first_letter_selector_formatter",
 *   label = @Translation("First Letter Selector"),
 *   weight = "11",
 *   field_types = {
 *     "string",
 *     "text",
 *   },
 *   quickedit = {
 *     "editor" = "plain_text"
 *   }
 * )
 */

class FirstletterFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      // Render each element as markup.
      $element[$delta] = [
        '#type' => 'markup',
        '#markup' => '<p class="headingfirstletter">' . $item->value . '</p>',
		'#attached' => array('library'=> array('custom_field_formatters/custom_field_formatters.firstletter')),
      ];
    }

    return $element;
  }

}