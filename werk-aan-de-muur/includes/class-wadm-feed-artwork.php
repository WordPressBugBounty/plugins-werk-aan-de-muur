<?php

class Wadm_Feed_Artwork extends Wadm_Feed_Abstract
{
	/**
	 * Wadm_Feed_Artwork constructor. Make sure to add url parameters in the right order,
	 * call parent constructor after adding action and artId parameters.
	 *
	 * @param $artId
	 */
	public function __construct($artId)
	{
		$this->addUrlParameter('action', 'artwork');
		$this->addUrlParameter('artId', $artId);
	}

	/**
	 * Create a piece of HTML wrapped in wadm container
	 *
	 * @param bool $html
	 * @return bool|string
	 */
	public function getHtml($html = false)
	{
		$data = $this->getData();

		if (!$data)
			return false;

		$artwork = $data->artwork;

		$output = sprintf(
			'<div class="wadm-single-artwork">
				<a href="%s" target="_blank" title="%s" rel="nofollow">
					<img src="%s" alt="%s" style="-webkit-touch-callout: none; -webkit-user-select: none;" oncontextmenu="return false;" ondragstart="return false;" draggable="false" onmousedown="return false;" />
				</a>
				<p class="wadm-artwork-price">
					<a href="%1$s" class="wadm-artwork-link" title="%2$s" target="_blank" rel="nofollow">
						<span class="wadm-artwork-price-secondary-line">%s</span><br />
						<span class="wadm-artwork-price-primary-line">%s</span>
					</a>
				</p>
			</div>',
			esc_url($artwork->link),
			esc_attr(sprintf(__('Koop "%s" op Werk aan de Muur', Wadm::TEXT_DOMAIN), $artwork->title)),
			esc_url($this->getImageUrl($artwork, '950x600')),
			esc_attr($artwork->title),
			esc_html(__('Te koop op meerdere materialen in een zelfgekozen formaat', Wadm::TEXT_DOMAIN)),
			sprintf(__('%s <strong>%s</strong> voor <strong>%s</strong>', Wadm::TEXT_DOMAIN), esc_html($artwork->medium), esc_html($artwork->dimensions), wp_kses_post($artwork->pricing[0]))
		);

		return parent::getHtml($output);
	}
}