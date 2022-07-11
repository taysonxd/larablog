<?php

function setActiveRoute($route) {
	return request()->routeIs($route) ? 'active' : '';
}