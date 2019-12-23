<?php

function generateTokenAPI($appName) {
	return hash("fnv1a64", time() . $appName) . hash("fnv1a64", random_int(0, microtime()));
}
