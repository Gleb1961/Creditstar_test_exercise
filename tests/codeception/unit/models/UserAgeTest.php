<?php

namespace tests\codeception\unit\models;

use yii\codeception\TestCase;
use \app\classes\utility;

class UserAgeTest extends TestCase
{

	public function testAgeCalculationByPersonalCode()
	{
		$aTestData = [
			50010113144 => 15,
			60001167463 => 16,
			39710196826 => 18,
			48712263960 => 28,
			29901014820 => 116
		];

		$this->specify('user age should be calculated correctly', function () use ($aTestData) {
			foreach ($aTestData as $iPersonalCode => $iAge)
			{
				expect("age should be calculates as $iAge", utility\Common::getAgeByPersonalCode($iPersonalCode) == $iAge)->true;
			}
		});
	}

}
