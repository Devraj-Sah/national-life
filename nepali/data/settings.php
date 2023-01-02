<?php
class Settings
{
	function update($pageTitle, $pageKeyword, $pageDescription, $siteName, $siteEmail, $noReplyEmail, $siteDomain, $baseLocation)
	{
		global $conn;
		
		$pageTitle = cleanQuery($pageTitle);
		$pageKeyword = cleanQuery($pageKeyword);
		$pageDescription = cleanQuery($pageDescription);
		$sietName = cleanQuery($siteName);
		$siteEmail = cleanQuery($siteEmail);
		$noReplyEmail = cleanQuery($noReplyEmail);
		$siteDomain = cleanQuery($siteDomain);
		$baseLocation = cleanQuery($baseLocation);
				
		$sql = "UPDATE settings
						SET
							pageTitle = '$pageTitle',
							pageKeyword = '$pageKeyword',
							pageDescription = '$pageDescription',
							siteName = '$siteName',
							siteEmail = '$siteEmail',
							noReplyEmail = '$noReplyEmail',
							siteDomain = '$siteDomain',
							baseLocation = '$baseLocation'
						";
		$result = $conn->exec($sql);
		
		return $conn->insertId();
	}
	
	function getSettings()
	{
		global $conn;
				
		$sql = "SELECT * FROM settings";
		$result = $conn->exec($sql);
		
		return $conn->fetchArray($result);
	}
}

$settings = new Settings();
