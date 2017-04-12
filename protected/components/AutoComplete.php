<?php
Yii::import('zii.widgets.jui.CJuiAutoComplete');

class AutoComplete extends CJuiAutoComplete
{
	public function run()
	{
		list($name,$id)=$this->resolveNameID();
 
		$attr_id = get_class($this->model).'_Id'.$this->attribute;

		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;

		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];

		if($this->hasModel())
			echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
		else
			echo CHtml::textField($name,$this->value,$this->htmlOptions);

		if($this->sourceUrl!==null)
			$this->options['source']=CHtml::normalizeUrl($this->sourceUrl); 
		else
			$this->options['source']=$this->source;

		if (!isset($this->options['focus'])) {
			$this->options['focus'] = 'js:function(event, ui) {
				return false;
			}';    
		}

		if (!isset($this->options['select'])) {
			$this->options['select'] = 'js:function(event, ui) {
				$("#'.$id.'").val(ui.item.label);
				$("#'.$attr_id.'").val(ui.item.id);
			}';
		}
 
		$options=CJavaScript::encode($this->options);
		$param = isset($this->options['param']) ? $this->options['param'] : "";
        $js = "jQuery('#{$id}').
			autocomplete($options).
			click(function(){
				$(this).data('autocomplete').search(".$param.");
			});";
        $cs = Yii::app()->getClientScript();
        $cs->registerScript(__CLASS__.'#'.$id, $js);
	}
}