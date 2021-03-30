<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWord implements Rule
{
	private $length;

	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct($length)
	{
		$this->length = $length;
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		return str_word_count(trim(html_entity_decode(strip_tags($value)))) <= $this->length;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return ':Attribute minimal ' . $this->length . ' kata.';
	}
}
