<?php

namespace Drupal\loremipsuma\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class LoremIpsumaForm extends ConfigFormBase
{

	/**
	 * {@inheritdoc}
	 */
    public function getFormId()
    //saber cual formulario es el que se esta utilizando
	{
		return 'loremipsuma_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state){
        //Construimos el formulario con buildForm

        // Form constructor.
		$form = parent::buildForm($form, $form_state);
		// Default settings.
        $config = $this->config('loremipsuma.settings');


        //#############Campos para el form
        // Page title field.

		$form['page_title'] = [
            //TYPE OF FIELD
            '#type' => 'textfield',
            //#
			'#title' => $this->t('Lorem ipsum generator page title:'),
			'#default_value' => $config->get('loremipsuma.page_title'),
			'#description' => $this->t('Give your lorem ipsum generator page a title.'),
        ];

        // Source text field.
		$form['source_text'] = array(
			'#type' => 'textarea',
			'#title' => $this->t('Source text for lorem ipsum generation:'),
			'#default_value' => $config->get('loremipsuma.source_text'),
			'#description' => $this->t('Write one sentence per line. Those sentences will be used to generate random text.'),
		);

        return $form;
    }

    /**
	 * {@inheritdoc}
	 */
	public function validateForm(array &$form, FormStateInterface $form_state)
	{
		//
	}

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $config = $this->config('loremipsuma.settings');
        $config->set('loremipsuma.source_text', $form_state->getValue('source_text'));
        $config->set('loremipsuma.page_title', $form_state->getValue('page_title'));
        $config->save();
        return parent::submitForm($form, $form_state);
    }

    /**
	 * {@inheritdoc}
	 */
	protected function getEditableConfigNames()
	{
		return [
			'loremipsuma.settings',
		];
	}
}
//







