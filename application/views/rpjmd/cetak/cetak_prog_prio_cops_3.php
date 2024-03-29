<style type="text/css">
	table td{
		vertical-align: top;
	}
</style>

<div align="center">Tabel 7.1 Program Prioritas</div>
<table border="1" style="border-collapse: collapse;" width="100%">
	<thead>
		<tr>
			<th>NO.</th>
			<th>SASARAN</th>
			<th>STRATEGI</th>			
			<th>ARAH KEBIJAKAN</th>
			<th>INDIKATOR SASARAN</th>
			<th width="15px">KONDISI AWAL</th>
			<th width="15px">KONDISI AKHIR</th>
			<th>PROGRAM PRIORITAS</th>
			<th>PROGRAM SKPD</th>
			<th>SKPD PENANGGUNG JAWAB</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$no = 1;
			foreach ($rpjmd as $row_rpjmd) {
				$sasaran = $this->m_rpjmd_trx->get_all_sasaran($row_rpjmd->id);
				foreach ($sasaran as $key_sasaran => $row_sasaran) {
					$program = $this->m_rpjmd_trx->get_all_program_ng_row($row_sasaran->id);

					$indikator_sasaran = $this->m_rpjmd_trx->get_indikator_program_per_sasaran($row_sasaran->id)->result();
					$tot_indikator_sasaran = count($indikator_sasaran);

					$program_skpd = $this->m_rpjmd_trx->get_program_skpd_from_renstra($program->id);
					$tot_prog_skpd = count($program_skpd);

					$strategi = $this->m_rpjmd_trx->get_all_strategi($row_sasaran->id);
					$tot_kebijakan_p_sasaran = $this->m_rpjmd_trx->get_total_kebijakan_strategi_cetak($row_sasaran->id);
					$tot_kebijakan_p_sasaran = $tot_kebijakan_p_strategi->jumlah;
					$tot_strategi = count($strategi);

					$kebijakan = $this->m_rpjmd_trx->get_all_kebijakan($strategi[0]->id);
					$tot_kebijakan = count($kebijakan);

					$tot_for_rowspan = count($program_skpd);
					if ($tot_prog_skpd < $tot_kebijakan_p_sasaran) {
						for ($i=$tot_prog_skpd; $i < $tot_kebijakan_p_sasaran; $i++) { 
							$program_skpd[$i] = (object) array('nama_prog_or_keg' => '');
						}
						$tot_for_rowspan = $tot_kebijakan_p_sasaran;
					}

					$key_kebijakan = 0;
					$key_strategi = 0;
					foreach ($program_skpd as $key_prog_skpd => $row_prog_skpd) {
						$nama_skpd = $this->db->query("SELECT nama_skpd FROM m_skpd WHERE id_skpd IN (SELECT id_skpd FROM t_renstra_prog_keg WHERE id_prog_rpjmd = '".$row_prog_skpd->id_prog_rpjmd."')")->result();



		 ?>
		 	<tr>
		 		<?php if ($key_prog_skpd == 0): ?>
		 			<td rowspan="<?php echo $tot_for_rowspan; ?>"><?php echo $no; ?></td>
		 			<td rowspan="<?php echo $tot_for_rowspan; ?>"><?php echo $row_sasaran->sasaran; ?></td>
		 		<?php endif ?>

		 		<?php 
		 			if ($key_kebijakan == 0 && $tot_strategi == ($key_strategi+1) && $key_prog_skpd == 0) {
		 				echo "<td rowspan='".$tot_for_rowspan."'>".$strategi[$key_strategi]->strategi." [STR1]</td>";
		 				$key_strategi++;
		 			}elseif ($key_kebijakan == 0 && $tot_for_rowspan == ($key_prog_skpd+1) && $tot_strategi == ($key_strategi+1)) {
		 				echo "<td rowspan='".($tot_for_rowspan-$key_prog_skpd)."'>".$strategi[$key_strategi]->strategi." [STR2]</td>";
		 				$key_strategi++;
		 			}elseif ($key_kebijakan == 0 && $tot_strategi == ($key_strategi+1)) {
		 				echo "<td rowspan='".$tot_kebijakan."'>".$strategi[$key_strategi]->strategi." [STR3]</td>";
		 				$key_strategi++;
		 			}elseif ($key_kebijakan == 0 && $tot_strategi > ($key_strategi+1)) {
		 				echo "<td rowspan='".$tot_kebijakan."'>".$strategi[$key_strategi]->strategi." [STR4]</td>";
		 				$key_strategi++;
		 			}

		 		?>

		 		<?php 
		 			if ($key_kebijakan == 0 && $tot_strategi == ($key_strategi+1) && $key_prog_skpd == 0) {
		 				echo "<td rowspan='".$tot_for_rowspan."'>".$strategi[$key_strategi]->strategi." [STR1]</td>";
		 				$key_strategi++;
		 			}elseif ($key_kebijakan == 0 && $tot_strategi == ($key_strategi+1) ) {
		 				echo "<td rowspan='".($tot_for_rowspan-$key_prog_skpd)."'>".$strategi[$key_strategi]->strategi." [STR2]</td>";
		 				$key_strategi++;
		 			}elseif ($key_kebijakan == 0 && $tot_strategi == ($key_strategi+1)) {
		 				echo "<td rowspan='".$tot_kebijakan."'>".$strategi[$key_strategi]->strategi." [STR3]</td>";
		 				$key_strategi++;
		 			}elseif ($key_kebijakan == 0 && ($key_kebijakan+1) != $tot_kebijakan) {
		 				echo "<td rowspan='".$tot_kebijakan."'>".$strategi[$key_strategi]->strategi." ".$strategi[$key_strategi+1]->strategi." [STR4]</td>";
		 				$key_strategi++;
		 			}

		 		?>



		 		<?php if ($key_prog_skpd == 0): ?>
		 			<td rowspan="<?php echo $tot_for_rowspan; ?>">T</td>
					<td rowspan="<?php echo $tot_for_rowspan; ?>">T</td>
					<td rowspan="<?php echo $tot_for_rowspan; ?>">T</td>
					<td rowspan="<?php echo $tot_for_rowspan; ?>">T</td>
					<td rowspan="<?php echo $tot_for_rowspan; ?>">T</td>
					<td rowspan="<?php echo $tot_for_rowspan; ?>">T</td>
					<td rowspan="<?php echo $tot_for_rowspan; ?>">T</td>		 			
		 		<?php endif ?>

			 		
		 	</tr>

		 <?php 
		 	}
		 	$no++;
			}}
		  ?>
	</tbody>

</table>
