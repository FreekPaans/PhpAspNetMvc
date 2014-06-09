<?php

namespace PhpAspNetMvc\Mvc;

interface IModelBinder {
	public function BindModel(ControllerContext $controllerContext, ModelBindingContext $bindingContext);
}
