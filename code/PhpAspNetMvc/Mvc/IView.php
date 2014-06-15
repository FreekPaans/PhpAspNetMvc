<?php

namespace PhpAspNetMvc\Mvc;
use PhpAspNetMvc\IO\TextWriter;

interface IView {
	public function Render(ViewContext $context, TextWriter $writer);
}