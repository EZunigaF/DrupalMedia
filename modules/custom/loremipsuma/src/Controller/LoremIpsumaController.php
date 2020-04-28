<?php

namespace Drupal\loremipsuma\Controller;

use Drupal\Component\Utility\Html;

class LoremIpsumaController
{
    public function generate($paragraphs, $phrases)
    {
        //Configs los obtenemos de module config folder -> lorem ipsuma . settings . yml
        $config = \Drupal::config('loremipsuma.settings');

        //Page title
        $page_title = $config->get('loremipsuma.page_title');
        //Source_text
        $source_text = $config->get('loremipsuma.source_text');

        //Arra
        $repertory = explode(PHP_EOL, $source_text);

		$element['#source_text'] = [];

		// Generate X paragraphs with up to Y phrases each.
		for ($i = 1; $i <= $paragraphs; $i++) {
			$this_paragraph = '';
			// When we say "up to Y phrases each", we can't mean "from 1 to Y".
			// So we go from halfway up.
			$random_phrases = mt_rand(round($phrases / 2), $phrases);
			// Also don't repeat the last phrase.
			$last_number = 0;
			$next_number = 0;
			for ($j = 1; $j <= $random_phrases; $j++) {
				do {
					$next_number = floor(mt_rand(0, count($repertory) - 1));
				} while ($next_number === $last_number && count($repertory) > 1);
				$this_paragraph .= $repertory[$next_number] . ' ';
				$last_number = $next_number;
			}
			//$element['#source_text'][] = SafeMarkup::checkPlain($this_paragraph);
			$element['#source_text'][] = Html::escape($this_paragraph);

			//$element['#title'] = SafeMarkup::checkPlain($page_title);
			$element['#title'] = Html::escape($page_title);

			// Theme function.
			$element['#theme'] = 'loremipsuma';

			return $element;
		}
    }
}