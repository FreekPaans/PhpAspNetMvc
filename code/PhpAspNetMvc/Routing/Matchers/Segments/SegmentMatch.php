<?php

namespace PhpAspNetMvc\Routing\Matchers\Segments;

interface SegmentMatch {
	public function IsMatch();
	public function HasParamValue();
	public function GetParamKey();
	public function GetParamValue();
}