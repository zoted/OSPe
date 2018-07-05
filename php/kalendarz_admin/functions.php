<?php

/*
 * Function requested by Ajax
 */
if(isset($_POST['func']) && !empty($_POST['func'])){
	switch($_POST['func']){
		case 'getCalender':
			getCalender($_POST['year'],$_POST['month']);
			break;
		case 'getEvents':
			getEvents($_POST['date']);
			break;
		default:
			break;
	}
}

/*
 * Get calendar full HTML
 */
function getCalender($year = '',$month = '')
{
	$dateYear = ( $year != '' ) ? $year : date("Y");
	$dateMonth = ( $month != '' ) ? $month : date("m");
	$date = $dateYear.'-'.$dateMonth.'-01';
	$currentMonthFirstDay = date("N",strtotime($date));
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
?>
	<div id="calender_section">
		<h2>
        	<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&lt;&lt;</a>
            <select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonths($dateMonth); ?></select>
			<select name="year_dropdown" class="year_dropdown dropdown"><?php echo getYearList($dateYear); ?></select>
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&gt;&gt;</a>
        </h2>
		<div id="event_list" class="none"></div>
		<div id="calender_section_top">
			<ul>
				<li><font color = "red">ND </font></li>
				<li>PN</li>
				<li>WT</li>
				<li>ŚR</li>
				<li>CZW</li>
				<li>PT</li>
				<li><font color = "blue">SO </font></li>
			</ul>
		</div>
		<div id="calender_section_bot">
			<ul>
			<?php 
				$dayCount = 1; 
				for($cb=1;$cb<=$boxDisplay;$cb++){
					if(($cb >= $currentMonthFirstDay + 1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
						//Current date
						$currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;
						$status = 1;
						//#łącznie z baza
						$db = new mysqli("localhost", "root", "", "users") or die($connection->error);
						//Get number of events based on the current date
						
						$result = $db->query("SELECT name,last_name FROM users as u INNER JOIN events as e ON u.id=e.id AND e.date = '".$currentDate."' AND e.status = '".$status."'");
						$eventNum = $result->num_rows;
						$row = $result->fetch_assoc();
						//Define date cell color
						if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
							echo '<li date="'.$currentDate.'" class="grey date_cell">';
						}elseif($eventNum > 0){
							echo '<li date="'.$currentDate.'" class="light_sky date_cell">';
						}else{
							echo '<li date="'.$currentDate.'" class="date_cell">';
						}
						//Date cell
						echo '<span>';
						echo $dayCount;
						for( $i=0; $i < $eventNum; $i++ ){   //pentla dla wyswietlania w kwadraciku osob 
						echo "<br>".$row['name'];
						
						}
						echo '</span>';
						
						//Hover event popup
						echo '<div id="date_popup_'.$currentDate.'" class="date_popup_wrap none">';
						echo '<div class="date_window">';
						echo '</div></div>';
				
						echo '</li>';
						$dayCount++;
			?>
			<?php }else{ ?>
				<li><span>&nbsp;</span></li>
			<?php } } ?>
			</ul>
		</div>
	</div>

<?php
}

/*
 * Get months options list.
 */
function getAllMonths($selected = ''){
	$options = '';
	for($i=1;$i<=12;$i++)
	{
		
		$value = ($i < 10)?'0'.$i:$i;
		$selectedOpt = ($value == $selected)?'selected':'';
		$options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
	}
	return $options;
}

/*
 * Get years options list.
 */
function getYearList($selected = ''){
	$options = '';
	for($i=2017;$i<=2025;$i++)
	{
		$selectedOpt = ($i == $selected)?'selected':'';
		$options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
	}
	return $options;
}

/*
 * Get events by date
 */
 
function getEvents($date = ''){
	//Include db configuration file
	$db = new mysqli("localhost", "root", "", "users") or die($connection->error);
	$eventListHTML = '';
	$date = $date?$date:date("Y-m-d");

	//Get events based on the current date
	$result = $db->query("SELECT id FROM events WHERE date = '".$date."' AND status = 1");
	
	$eventNum = $result->num_rows;
	$row = $result->fetch_assoc();
	$miesiac = date('n');
	if($result->num_rows > 0){
		$eventListHTML = '<h1 class="test">'.'Wydarzenie  :'.date("l, d M Y",strtotime($date)).'</h1>';
		$eventListHTML .= '<ul>';
		while($row = $result->fetch_assoc()){ 
            $eventListHTML .= '<li class="test">'.'Osoby wypisane :TUTAJ BYM CHCIAŁ IMIE I NAZIWKSO TRZBEA ZMIENIC num_rows na cos innego'.$row['id'].$row['name'].'</li>';
        }
		$eventListHTML .= '</ul>';
	}
echo $eventListHTML;
}




?>




