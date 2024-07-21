<?php

/**
 * @var \tobimori\DreamForm\Models\Submission|null $submission
 *
 * @var \Kirby\Cms\Block $block
 * @var \tobimori\DreamForm\Fields\RadioField $field
 * @var \tobimori\DreamForm\Models\FormPage $form
 * @var array $attr
 */

snippet('dreamform/fields/checkbox', [
	'block' => $block,
	'field' => $field,
	'form' => $form,
	'attr' => $attr,
	'type' => 'radio'
]);
