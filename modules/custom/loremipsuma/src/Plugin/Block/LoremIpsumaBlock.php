<?php

namespace Drupal\loremipsuma\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a Lorem ipsum block with which you can generate dummy text anywhere.
 *
 * @Block(
 *   id = "loremipsuma_block",
 *   admin_label = @Translation("Lorem ipsum block"),
 * )
 */

class LoremIpsumaBlock extends BlockBase
{

    /**
	 * {@inheritdoc}
	 */
	public function blockAccess(AccountInterface $account)
	{
		return AccessResult::allowedIfHasPermission($account, 'generate lorem ipsum');
    }

    /**
	 * {@inheritdoc}
	 */
	public function build()
	{
		return \Drupal::formBuilder()->getForm('Drupal\loremipsuma\Form\LoremIpsumaBlockForm');
    }

    /**
	 * {@inheritdoc}
	 */
    public function blockForm($form, FormStateInterface $form_state)
    //ADD MORE CONFIG TO YOUR CONFIG FILE :D, by nick?
	{
		$form = parent::blockForm($form, $form_state);

		$config = $this->getConfiguration();

		return $form;
    }

    /**
	 * {@inheritdoc}
	 */
	public function blockSubmit($form, FormStateInterface $form_state)
	{
		$this->setConfigurationValue('loremipsuma_block_settings', $form_state->getValue('loremipsuma_block_settings'));
	}


}

