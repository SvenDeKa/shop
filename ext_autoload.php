<?php
$extensionPath = t3lib_extMgm::extPath('z3_shop');
$extensionClassesPath = $extensionPath . 'Classes/';
return array(
	'Tx_Z3Shop_Finisher_DeleteCart' => $extensionClassesPath.'Finisher/Tx_Z3Shop_Finisher_DeleteCart.php',
	'Tx_Z3Shop_Interceptor_SaveOrder' => $extensionClassesPath.'Interceptor/Tx_Z3Shop_Interceptor_SaveOrder.php',
);
?>