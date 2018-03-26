<?php

class PeThemeFormElementSidebars extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.sidebars.js",array("pe_theme_utils","jquery-ui-sortable","json2"),"pe_theme_field_sidebars");
		wp_enqueue_script("pe_theme_field_sidebars");

		// prototype.js alters JSON2 behaviour, it shouldn't be loaded in our admin page anyway but
		// if other plugins are forcing it in all wordpress admin pages, we get rid of it here.
		wp_deregister_script("prototype");
	}
	
	protected function template() {
		$html = <<<EOT
<div class="option option-input pe_field_sidebar [AUTO_CLASS]" id="[ID]" data-auto="[AUTO]" data-name="[NAME]" data-id="[ID]">
    <h4>[LABEL]</h4>
    <div class="section">
        <div class="element">
            <input type="text" class="upload pe_sidebar_title" />
			<input type="button" class="ob_button pe_sidebar_new" value="[BUTTON_LABEL]"/>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
    <table cellspacing="0">
        <thead>
            <tr>
				<th class="col-title" colspan="4">Title</th>
            </tr>
        </thead>
		<tbody class="[SORTABLE] [EDITABLE]" data-items="[TBODY]">
		</tbody>
	</table>

	</div>
<script>
	jQuery("#[ID]").peFieldSidebars();
</script>
EOT;

		return $html;
	}

	protected function addTemplateValues(&$data) {
		$sidebars = isset($this->data["value"]) ? $this->data["value"] : false;
		$data["[SORTABLE]"] = isset($this->data["sortable"]) && $this->data["sortable"] ? "ui-sortable" : "";
		$data["[EDITABLE]"] = isset($this->data["editable"]) && $this->data["editable"] ? "ui-editable" : "";
		if (isset($this->data["auto"]) && $this->data["auto"]) {
			$data["[AUTO_CLASS]"] = "pe_auto_values";
			$data["[AUTO]"] = $this->data["auto"];
		} else {
			$data["[AUTO_CLASS]"] = $data["[AUTO]"] = "";
		}
		$data["[BUTTON_LABEL]"] = isset($this->data["button_label"]) ? $this->data["button_label"] : __pe("Add new");

		$name = $data["[NAME]"];
		$buffer =& $data["[TBODY]"];
		$buffer = "";
		if ($sidebars && is_array($sidebars) && count($sidebars) > 0) {
			$buffer = esc_attr(json_encode($sidebars));
		}

	}

}

?>
