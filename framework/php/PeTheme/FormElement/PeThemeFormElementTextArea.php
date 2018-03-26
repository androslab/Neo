<?php

class PeThemeFormElementTextArea extends PeThemeFormElement {

	protected function template() {
		$html = <<<EOT
<div class="option option-textarea">
    <h4>[LABEL]</h4>
    <div class="section">
        <div class="element">
            <textarea id="[ID]" name="[NAME]" rows="5" data-name="[DATA_NAME]">[VALUE]</textarea>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>
EOT;
		return $html;
	}

}

?>
