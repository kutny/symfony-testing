<?php

namespace Collabim\Claass;

class NameParser
{
	public function getNamespace($fullClassName) {
		$lastSlashPosition = $this->getLastSlashPosition($fullClassName);

		if ($lastSlashPosition !== null) {
			return substr($fullClassName, 0, $this->getLastSlashPosition($fullClassName));
		}
		else {
			return null;
		}
	}

	public function getClassWithoutNamespace($fullClassName) {
		$lastSlashPosition = $this->getLastSlashPosition($fullClassName);

		if ($lastSlashPosition !== null) {
			return substr($fullClassName, $this->getLastSlashPosition($fullClassName) + 1);
		}
		else {
			return $fullClassName;
		}
	}

	private function getLastSlashPosition($fullClassName) {
		$lastSlashPosition = strrpos($fullClassName, '\\');

		if ($lastSlashPosition === false) {
			return null;
		}

		return $lastSlashPosition;
	}

}
