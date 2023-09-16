CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarPago`()
SELECT pagoId, pagoNombre, 
date_format(pagoFechaCreacion,"%d-%m-%y") as pagoFechaCreacion
FROM 
	pago
WHERE  
	pagoEstado = 1