<?php

/**
 * Container of static function
 * NB! NOT USE DATABASE
 *
 */
namespace app\components\utility;

abstract class Common
{

	/**
	 * @inheritdoc
	 */
	public static function validatePersonalCode($id)
	{
		$checknr = substr($id, 10, 1);

		$nr = ' ' . $id;

		$checksum = ($nr[1] + $nr[2] * 2 + $nr[3] * 3 + $nr[4] * 4 + $nr[5] * 5 + $nr[6] * 6 + $nr[7] * 7 + $nr[8] * 8 + $nr[9] * 9 + $nr[10]) % 11;

		if ($checksum == 10)
		{
			$checksum = ($nr[1] * 3 + $nr[2] * 4 + $nr[3] * 5 + $nr[4] * 6 + $nr[5] * 7 + $nr[6] * 8 + $nr[7] * 9 + $nr[8] + $nr[9] * 2 + $nr[10] * 3) % 11;
		}

		$aPersonalCodeData = self::getPersonalCodeData($id);

		if (strlen(ltrim($nr)) == 11
			&& $nr[1] != 0
			&& $checksum == $checknr
			&& $aPersonalCodeData['birthdate_correct'] === true
		)
		{
			return true;
		}
	}

	/**
	 * @inheritdoc
	 */
	public static function getPersonalCodeData($iPersonalCode)
	{
		$idp = unpack("a1gender/a2year/a2month/a2day/a3ord/a1chk", $iPersonalCode); // split $id into chunks (id parts)

		$aData['gender'] = ($idp['gender']%2) ? "M" : "F"; //gender
		$aData['b_year'] = (17 + (int)(($idp['gender'] +1 ) /2 )) . $idp['year']; // year of birth
		$aData['b_month'] = (int)$idp['month']; // month of birth
		$aData['b_day'] = (int)$idp['day']; // day of birth

		$aData['birthdate'] =
			$aData['b_year'] . '-'
			. str_pad($aData['b_month'], 2, '0', STR_PAD_LEFT)
			. '-' . str_pad($aData['b_day'], 2, '0', STR_PAD_LEFT);

		$aData['birthdate_correct'] = checkdate ($aData['b_month'], $aData['b_day'], $aData['b_year']);

		$date1 = new \DateTime($aData['birthdate']);
		$date2 = new \DateTime();
		$interval = $date1->diff($date2);
		$aData['age'] = $interval->y;

		return $aData;
	}

	/**
	 * @inheritdoc
	 */
	public static function getAgeByPersonalCode($iPersonalCode)
	{
		$aPersonalCodeData = self::getPersonalCodeData($iPersonalCode);
		return $aPersonalCodeData['age'];
	}

}