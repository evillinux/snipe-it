<?php

parse_str($_SERVER['QUERY_STRING']);

			$DELL_URL = "http://xserv.dell.com/services/assetservice.asmx?WSDL";
			$soap = new SoapClient($DELL_URL,array('soap_version'   => SOAP_1_2));
			//$tag = "$serial";
			$response = $soap->GetAssetInformation( 
				array(
					"guid" => "11111111-1111-1111-1111-111111111111", 
					"applicationName" => "AssetService", 
					"serviceTags" => $tag
					) 
									);

?>
			
<?php
echo "Service tag: ".$response->GetAssetInformationResult->Asset->AssetHeaderData->ServiceTag;
?>
<br>
<?php
echo "System ID: ".$response->GetAssetInformationResult->Asset->AssetHeaderData->SystemID;
?>
<br>
<?php
echo "System Type: ".$response->GetAssetInformationResult->Asset->AssetHeaderData->SystemType;
?>
<br>
<?php
echo "System Model: ".$response->GetAssetInformationResult->Asset->AssetHeaderData->SystemModel;
?>
<br>
<?php
echo "Ship date: ". $response->GetAssetInformationResult->Asset->AssetHeaderData->SystemShipDate;
?>
<br>
<?php
echo "Warranty start: ".$response->GetAssetInformationResult->Asset->Entitlements->EntitlementData[0]->StartDate;
?>
<br>
<?php
echo "Warranty end: ".$response->GetAssetInformationResult->Asset->Entitlements->EntitlementData[0]->EndDate;
?>
<br>
<?php
echo "Warranty days left: ".$response->GetAssetInformationResult->Asset->Entitlements->EntitlementData[0]->DaysLeft;
?>
<br>
<?php
echo "Warranty status: ".$response->GetAssetInformationResult->Asset->Entitlements->EntitlementData[0]->EntitlementType;
?>