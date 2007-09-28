<h3>Recommend <span class="title">'<?php echo $this->event->title; ?>'</span> for other calendars:</h3>
<form action="<?php echo $this->manager->uri; ?>?action=recommend&amp;event_id=<?php echo $this->event->id; ?>" method="post">
<?php
ini_set('display_errors',true);
require_once 'HTML/Table.php';
require_once 'UNL/UCBCN/Calendar_has_event.php';
$t = new HTML_Table(array('id'=>'recommend_cals'));
$t->addRow(array('Calendar','Pending','Posted'), null, 'TH');
foreach ($this->calendars as $calendar_id=>$permissions) {
    $calendar = $this->manager->factory('calendar');
    $calendar->get($calendar_id);
    $elid    = 'cal'.$calendar->id;
    $posted  = '';
    $pending = '';
    $curr_status = UNL_UCBCN_Calendar_has_event::calendarHasEvent($calendar, $this->event);
    if ($curr_status === false) {
        if (isset($permissions['Event Post'])) {
            $posted  = HTML_QuickForm::createElement('radio',$elid,null,null,'Event Post');
            $posted = $posted->toHtml();
        }
        if (isset($permissions['Event Send Event to Pending Queue'])) {
            $pending = HTML_QuickForm::createElement('radio',$elid,null,null,'Event Send Event to Pending Queue');
            $pending = $pending->toHtml();
        }
    } else {
        if ($curr_status == 'pending') {
            $pending = 'X';
        } else {
            $posted = 'X';
        }
    }
    $t->addRow(array("<label for='{$elid}'>".$calendar->name.'</label>', $pending, $posted));
}
echo $t->toHtml();
?>
<input type="submit" value="Go" />
</form>
<script type="text/javascript">
try {stripe('recommend_cals');} catch(e) {}
</script>