
<!DOCTYPE html>
<html>
<head>
	<title>Tramites - F.D.E.</title>
</head>
<body>
 
 
<h3 align="center">GOBIERNO AUTONOMO MUNICIPAL DE </h3>

<h4 align="center">FORMULARIO PARA ACTUALIZACIÓN DE DATOS TÉCNICOS</h4>
<h4 align="center">DECLARACIÓN JURADA</h4>
<h3 align="left"><?php echo 'Código catastral: '.$infoPredio['codigocatastral']; ?></h3>
<table style="border:1px solid black;width:100%;">
	<tr>
		<th style="border:1px solid black" COLSPAN=2 >1. Información de propietario</th>
		<th style="border:1px solid black" COLSPAN=2>2. Información legal</th>
		<th style="border:1px solid black">
			<?php
				echo 'Formulario No.: '.$infoPredio['idpredio'].'<br>'; 
			?>			
		</th>
	</tr>
	<tr>
		<td style="border:1px solid black" COLSPAN=2>
			<?php 
				echo $persona['nombreCompleto'].'<br>';
				echo 'CI: '.$persona['ci']; 
			?>
		</td>
		<td style="border:1px solid black" COLSPAN=2>
			<?php 
				echo 'Matricula: '.$infoPredio['matricula'].'<br>';
				echo 'Asiento: '.$infoPredio['asiento'].'<br>'; 
				echo 'Fecha: DDRR:'.$infoPredio['fechaddrr'].'<br>'; 
			?>
		</td>
		<td style="border:1px solid black">
			<?php 
				echo 'Fecha: '.$infoPredio['fechaimpresion'].'<br>'; 
				echo 'Código:'.$infoPredio['codigoform'].'<br>';
			?>		
		</td>
	</tr>
	<tr>
		<td style="border:1px solid black" ROWSPAN=2 align="center">
			Croquis del predio
			<br>
			<img src="<?php echo './fotos/datostecnicos/'.$infoPredio['croquis']; ?>">
		</td>
		<td style="border:1px solid black" COLSPAN=2>
			Fachada 1
			<br>
			<img src="<?php echo './fotos/datostecnicos/'.$infoPredio['fachadauno']; ?>">
		</td>
		<td style="border:1px solid black" COLSPAN=2>
			Fachada 2
			<br>
			<img src="<?php echo './fotos/datostecnicos/'.$infoPredio['fachadados']; ?>">
		</td>
	</tr>
	<tr>
		<td style="border:1px solid black" COLSPAN=2>
			Interior
			<br>
			<img src="<?php echo './fotos/datostecnicos/'.$infoPredio['interior']; ?>">
		</td>
		<td style="border:1px solid black" COLSPAN=2>
			Croquis de la ubicación
			<br>
			<img src="<?php echo './fotos/datostecnicos/'.$infoPredio['croquisubicacion']; ?>">
		</td>

	</tr>
	<tr>
		<td style="border:1px solid black" >
			<?php 
				echo $persona['nombreCompleto'].'<br>';
				echo 'CI: '.$persona['ci']; 
			?>
		</td>
		<td style="border:1px solid black" >
			<?php 
				echo 'Matricula: '.$infoPredio['matricula'].'<br>';
				echo 'Asiento: '.$infoPredio['asiento'].'<br>'; 
				echo 'Fecha: DDRR:'.$infoPredio['fechaddrr'].'<br>'; 
			?>	
		</td>

		<td style="border:1px solid black" >
			<?php
				echo 'Formulario Mo.: '.$infoPredio['idpredio'].'<br>';
				echo 'Fecha: '.$infoPredio['fechaimpresion'].'<br>'; 
				echo 'Código:'.$infoPredio['codigoform'].'<br>';
			?>		
		</td>
		<td style="border:1px solid black" >
			<?php
				echo 'Formulario Mo.: '.$infoPredio['idpredio'].'<br>';
				echo 'Fecha: '.$infoPredio['fechaimpresion'].'<br>'; 
				echo 'Código:'.$infoPredio['codigoform'].'<br>';
			?>		
		</td>
	</tr>
	<tr>
		<td style="border:1px solid black" colspan="3">
			6. Características de la(s) construcciones
			<br>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr style="color: blue;">
							<th FONT SIZE=5>No.</th>
							<th>Año Modif.</th>
							<th>Año Const.</th>
							<th>Bloque</th>
							<th>Sup. cons.</th>
							<th>Pisos</th>
							<th>Tipología</th>
							<th>Puntaje</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;
						foreach ($caracteristica  as $row) {
							?>
							<tr>
								<td align="center"><?php echo $i; ?></td>
								<td align="center"><?php echo $row['modificado'];?></td>
								<td align="center"><?php echo $row['construccion'];?></td>
								<td align="center"><?php echo $row['bloque'];?></td>
								<td align="center"><?php echo $row['superficieconstruida'];?></td>
								<td align="center"><?php echo $row['pisos'];?></td>
								<td align="center"><?php echo $row['tipologia'];?></td>
								<td align="center"><?php echo $row['puntaje'];?></td>
						</tr>
						<?php $i++; } ?>
					</tbody>
				</table>
			</div>
			<?php
 
			?>
		</td>

		<td style="border:1px solid black" colspan="3">
			<h6 align="center">En mi calidad de sujeto pasivo y/o tercero responsable, declaro que la información<br>proporcionada en la determinación del IPBI, fiel y exactamente representa la verdad, por lo que<br>juro a la exactitud de la presente declaración (Art. 78i, ley 2492).</h6>
			<br><br><br><br>
			<?php
				echo '<h6 >';
				echo 'Firma del propietario';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo 'Firma del profesional';
				echo '<br>'.$persona['nombreCompleto'];
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo $this->session->userdata('nomUser'). ' '.$this->session->userdata('apUser');
				echo '<br>'.$persona['ci'];
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo $this->session->userdata('ci');
				echo '</h6>';
			?>		
		</td>

	</tr>
	<tr>
		<td style="border:1px solid black" colspan="5">
			7. Observaciones
			<br>
			<?php 
				echo $infoPredio['observaciones'].'<br>';
			?>
		</td>
		
	</tr>
</table>
 

</body>
</html>
